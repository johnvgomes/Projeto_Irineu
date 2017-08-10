<?php

include_once 'Conectar.php';
include_once 'Url.php';

class Carrinho {

    private $con;
    private $url;

    public function __construct() {
        $this->con = new Conectar();
        $this->url = new Url();
    }

    public function comprar($id) {
        if (isset($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $i => $item) {
                if ($item[0] == $id) {
                    return count($_SESSION['carrinho']);
                }
            }

            $_SESSION['carrinho'][count($_SESSION['carrinho'])][0] = $id;
            $_SESSION['carrinho'][(count($_SESSION['carrinho']) - 1)][1] = 1;
        } else {
            $_SESSION['carrinho'][0][0] = $id;
            $_SESSION['carrinho'][0][1] = 1;
        }

        return count($_SESSION['carrinho']);
    }

    public function listarCarrinho() {
        
        
        if (!empty($_SESSION['carrinho'])) {
            echo "<div id='carrinho'>
                <div id='limparCarrinho' onclick='limpaCarrinho();'>Limpar carrinho</div>
                <div id='topoCarrinho'>Carrinho</div>
                <div id='contCarrinho'><table>";

            echo "<thead><tr>"
            . "<td>Produto</td>"
            . "<td>Quantidade</td>"
            . "<td>Preço</td>"
            . "<td>Peso</td>"
            . "<td>&#9679;</td>"
            . "<td>&#9679;</td>"
            . "<td>&#9679;</td>"
            . "</tr></thead>";

            foreach ($_SESSION['carrinho'] as $item) {
                echo "<tr id='$item[0]'>"
                . $this->listarInfoEdit($item[0], $item[1])
                . "<td class='btnTd'><button class='addBtn btnCart' onclick='addItem($item[0]);'></button></td>"
                . "<td class='btnTd'><button class='remBtn btnCart' onclick='removeItem($item[0]);'></button></td>"
                . "<td class='btnTd'><button class='delBtn btnCart' onclick='deleteItem($item[0]);'></button></td>"
                . "</tr>";
            }

            echo "</table></div>"
            . "<a href='".$this->url->getBase()."confirmarPedido'><div id='confPedido'>Confirmar pedido</div></a>"
            . "</div>";
        } else {
            echo "<div id='semCarrinho'>Não há nada no carrinho...<br /><br />"
            . "Clique em <button class='botoes'>Comprar</button> para comprar o produto diretamente ou<br />"
            . "clique em <button class='botoes'>Carrinho</button> para inseir o produto no carrinho!</div>";
        }
    }

    public function listarInfoEdit($id, $qtd) {
        try {
            

            $sql = "SELECT p.*, m.*, s.*
                FROM produtos as p, marcas as m, subcategorias as s
                WHERE p.id=? AND p.id_marca = m.id AND p.id_subcatego = s.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return "<td><a href='" . $this->readableUrl($this->url->getBase() . "produto/$linha[0]/$linha[1]") . "'>"
                        . "<h3>" . $this->nomeProduto($linha[1]) . "</h3>"
                        . "<div class='imgProdCar'>"
                        . $this->imgProduto($linha[0])
                        . "</div>"
                        . "</a></td>"
                        . "<td><input type='text' value='$qtd' /></td>"
                        . "<td>" . $this->mudaPreco($qtd * $linha[2]) . "</td>"
                        . "<td>" . $this->mudaPeso($qtd * $linha[3]) . "</td>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function nomeProduto($str) {
        $len = 30;

        if (strlen($str) < $len) {
            return $str;
        } else {
            return substr($str, 0, $len) . "...";
        }
    }

    public function imgProduto($produto) {
        try {
            

            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id_produto=? AND f.id_produto = p.id ORDER BY f.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $produto, PDO::PARAM_INT);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();

            $str = '';
            $first = true;

            if ($num <= 0) {
                return $str = "<img src='" . $this->url->getBase() . "img/indisponivel.png' alt='Imagem indisponível' />";
            }

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if ($first || $linhas[3] == 1) {
                    $str = "<img src='"
                            . $this->url->getBase()
                            . "img/img_fotos/$linhas[1]' alt='$linhas[2]' title='$linhas[2]' />";

                    $first = false;
                }
            }

            return $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function mudaPreco($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function mudaPeso($valor) {
        return number_format($valor, 3, ',', '.') . ' kg';
    }

    public function readableUrl($url) {
        return str_replace(" ", "-", $url);
    }

}
