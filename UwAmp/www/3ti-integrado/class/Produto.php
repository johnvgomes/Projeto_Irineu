<?php

include_once 'Conectar.php';
include_once 'PaginarProduto.php';
include_once 'ImagemProduto.php';

class Produto {

//ATRIBUTOS, CONSTRUTOR, DESTRUTOR, GETS, SETS E SALVAR

    private $id;
    private $nome;
    private $valorunit;
    private $estoque;
    private $url;
    private $id_fabricante;
    private $con;
    private $p;
    private $ip;

    public function __construct() {
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getValorunit() {
        return $this->valorunit;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getId_fabricante() {
        return $this->id_fabricante;
    }

    public function getCon() {
        return $this->con;
    }

    public function getP() {
        return $this->p;
    }

    public function getIp() {
        return $this->ip;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setValorunit($valorunit) {
        $this->valorunit = $valorunit;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setId_fabricante($id_fabricante) {
        $this->id_fabricante = $id_fabricante;
    }

    public function setCon($con) {
        $this->con = $con;
    }

    public function setP($p) {
        $this->p = $p;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function salvar() {
        try {
            $sql = "INSERT INTO produto VALUES (null,?,?,?,?,?)";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getValorunit(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getEstoque(), PDO::PARAM_INT);
            @$sqlprep->bindParam(4, $this->getId_fabricante(), PDO::PARAM_INT);
            @$sqlprep->bindParam(5, $this->getUrl(), PDO::PARAM_STR);
            if ($sqlprep->execute() == 1) {
                echo "<br><br>Cadastro efetuado com sucesso<br><br>";
            }
        } catch (PDOException $exc) {
            echo "<br><br>Erro ao cadastrar Produto<br><br>"
            . $exc->getMessage();
        }
    }

    public function paginar($pg, $table1, $table2, $pasta, $link) {
        try {
            $this->p = new Paginar();
            //$pg = página em que se encontra
            //$pasta = pasta das imagens
            //nome -> 2
            //url -> 4
            //salario -> 3

            $this->p->paginacao(2, $pg, $table1, $table2, $pasta, $link, "4em", 1, 5, 2, 3, "paginacao");
        } catch (PDOException $exc) {
            echo "Erro ao paginar "
            . $exc->getTraceAsString();
        }
    }

   public function visualizar($base, $url) {
        try {
            $ip = new ImagemProduto();
            $sql = "SELECT p.*, fb.* "
                    . "FROM produto as p, "
                    . "fabricante as fb "
                    . "WHERE p.url = ? AND "
                    . "p.id_fabricante = fb.id";
            $ps = $this->con->prepare($sql);
            $ps->bindParam(1, $url, PDO::PARAM_STR);
            $ps->execute();

            if ($vetor = $ps->fetch(PDO::FETCH_NUM)) {
                echo "<article class='func'>"
                . "<h3>$vetor[1]</h3>"
                . "<span>Valor Unidade: R$ "
                . number_format($vetor[2], 2, ',', '.')
                . "</span>"
                . "<span>Fabricante: $vetor[7]</span>"
                . "</article>";
                $ip->visualizar($base, $vetor[0]);
            }
        } catch (PDOException $exc) {
            echo "Erro ao visualizar "
            . $exc->getMessage();
        }
    }

    public function consultar() {
        try {
            $sql = "SELECT * FROM produto";

            $sqlprep = $this->con->query($sql);

            while ($vetor = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<article>
                    $vetor[0]<br>
                    Produto: $vetor[1]<br>
                    Valor Unidade: $vetor[2]<br>
                    Estoque: $vetor[3]<br>   
                     <a href='?p=produto/excluir&id=$vetor[0]' title='Exclusão produto'>
                        <img src='../imagem/icone_deletar.jpg' alt='Excluir'>
                    </a> 
                    <a href='?p=produto/editar&id=$vetor[0]'
                        title='Editar Produto'>
                        <img src='../imagem/icone_editar.png' alt='Edição'>
                        </a>
                </article>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar produto "
            . $exc->getMessage();
        }
    }

    public function excluir() {
        try {
            $registro = $this->carregar();
            $this->ct->excluirArquivo("../foto_produto/" . $registro[3]);


            $sql = "DELETE FROM produto WHERE id = ?";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute() == 1) {
                echo "Exclusão efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao excluir produto"
            . $exc->getMessage();
        }
    }

    public function carregar() {
        try {

            $sql = "SELECT * FROM produto WHERE id =?";

            $ps = $this->con->prepare($sql);
            $ps->bindParam(1, $this->getId(), PDO::PARAM_STR);
            $ps->execute();

            if ($registro = $ps->fetch(PDO::FETCH_NUM)) {
                return $registro;
            }
        } catch (PDOException $exc) {
            echo "Erro ao carregar produto" . $exc->getTraceAsString();
        }
    }

    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->valorunit = null;
        $this->estoque = null;
        $this->id_fabricante = null;
        $this->con = null;
    }

}

?>
