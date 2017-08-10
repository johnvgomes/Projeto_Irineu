<?php

class Carrinho extends PDO {

    private $erro;

    public function __construct($database = DB_STRING, $username = DB_USER, $password = DB_PASS) {
//		 session_register('carrinho');
        if (!isset($_SESSION['carrinho']))
            $_SESSION['carrinho'] = "";
        try {
//			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            parent::__construct('mysql:host=localhost;dbname=' . $database, $username, $password);
        } catch (PDOException $e) {
            echo 'Erro no banco de dados: ' . $e->getMessage() . "<br>";
            exit(1);
        }
    }

    public function getErro() {
        return $this->erro;
    }

    public function setErro($msg) {
        $this->erro = $msg;
    }

    function add($id, $quant) {
        if (isset($_SESSION['carrinho'][$id])) {
            if ($quant == '')
                $quant = 1;

            $sqlpro = "select * from pro_estoque where pro_id=" . $id;
            $rspro = $this->query($sqlpro);
            $tabpro = $rspro->fetchObject();
            if ($tabpro->pro_estoque >= ( $_SESSION['carrinho'][$id] + $quant )) {
                $_SESSION['carrinho'][$id] = $_SESSION['carrinho'][$id] + $quant;
            } else {
                $this->setErro("quantidade em estoque indisponível !");
                return false;
            }
        } else {
            if ($quant == '')
                $quant = 1;

            $sqlpro = "select * from pro_estoque where pro_id=" . $id;
            $rspro = $this->query($sqlpro);
            $tabpro = $rspro->fetchObject();
            if ($tabpro->pro_estoque >= ( $_SESSION['carrinho'][$id] + $quant )) {
                $_SESSION['carrinho'][$id] = $quant;
            } else {
                $this->setErro("quantidade em estoque indisponível !");
                return false;
            }
        }
//		  echo "Item inclu&iacute;do com sucesso<br>";
        return true;
    }

    function removeunidade($id) {
        if (isset($_SESSION['carrinho'][$id])) {
            if ($_SESSION['carrinho'][$id] > 1) {
                $_SESSION['carrinho'][$id] --;
            } else {
                unset($_SESSION['carrinho'][$id]);
            }
        } else {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    function removeitem($id) {
        unset($_SESSION['carrinho'][$id]);
    }

    function limpa() {
        unset($_SESSION['carrinho']);
    }

    function limpaloja($loja) {
        $vetor = array();
        $rsprod = new Produtos(DB_STRING, DB_USER, DB_PASS);
        $proEstoque = new Proestoque(DB_STRING, DB_USER, DB_PASS);

        foreach ($_SESSION['carrinho'] as $id => $qtd) {
            if ($id <> "") {

                $proEstoque->carregadados($id);
                $idpro = $proEstoque->getProd();

                $rsprod->carregadados($idpro);
                // echo "<br>id:".$id."loja:".$rsprod->getLoja()." compara:".$loja."<br>";			  
                if ($rsprod->getLoja() == $loja) {
                    $vetor[] = $id;
                }
            }
        }

        $qtd = 0;
        foreach ($vetor as $id) {
            unset($_SESSION['carrinho'][$id]);
            $qtd ++;
        }

        if ($qtd > 0)
            return true;
        else
            return false;
    }

    function listabyloja($loja) {
        $vetor = array();
        $rsprod = new Produtos(DB_STRING, DB_USER, DB_PASS);
        $proEstoque = new Proestoque(DB_STRING, DB_USER, DB_PASS);


        if (!isset($_SESSION['carrinho']))
            return false;


        if (count($_SESSION['carrinho']) > 0) {
            foreach ($_SESSION['carrinho'] as $id => $qtd) {

                if ($id <> "") {

                    $proEstoque->carregadados($id);
                    $idpro = $proEstoque->getProd();

                    $rsprod->carregadados($idpro);
//			  			 echo "<br>id:".$id."loja:".$rsprod->getLoja()." compara:".$loja."<br>";			  
                    if ($rsprod->getLoja() == $loja) {
                        $vtempo = array($id, $qtd);
                        $vetor[] = $vtempo;
                    }
                }
            }
        }

        return $vetor;
    }

    function contabyloja($loja) {
        $vetor = array();
        $rsprod = new Produtos(DB_STRING, DB_USER, DB_PASS);
        $proEstoque = new Proestoque(DB_STRING, DB_USER, DB_PASS);


        if (!isset($_SESSION['carrinho']))
            return 0;

        $quant = 0;
        if (count($_SESSION['carrinho']) > 0) {
            foreach ($_SESSION['carrinho'] as $id => $qtd) {

                if ($id <> "") {
                    $proEstoque->carregadados($id);
                    $idpro = $proEstoque->getProd();

                    $rsprod->carregadados($idpro);

                    if ($rsprod->getLoja() == $loja) {
                        $quant = $quant + $qtd;
                    }
                }
            }
        }

        return $quant;
    }

    function listaitem($id) {
        foreach ($_SESSION['carrinho'][$id] as $carro) {
            echo "<br>" . $carro;
        }
    }

    function lista() {
        $rsprod = new Produtos(DB_STRING, DB_USER, DB_PASS);

        foreach ($_SESSION['carrinho'] as $id => $qtd) {
            if ($id <> "") {
                $rsprod->carregadados($id);

                echo "<br>" . $rsprod->getDescricao() . " " . $qtd;
            }
        }
    }

}

?>