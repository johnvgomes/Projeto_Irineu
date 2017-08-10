<?php

include_once 'Conectar.php';

class Tags {

    private $id;
    private $nome;
    private $id_produto;
    private $con;

    public function __construct($id = "", $nome = "", $id_produto = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->id_produto = $id_produto;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getId_produto() {
        return $this->id_produto;
    }

    public function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function inserir() {
        try {
            $sql = "INSERT INTO tags VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId_produto(), PDO::PARAM_INT);

            if ($sqlprep->execute()) {
                echo $this->con->lastInsertId();
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM tags WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);

            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function mostrarTags() {
        try {
            $sql = "SELECT DISTINCT t.nome FROM tags as t, produtos as p "
                    . "WHERE t.id_produto=p.id GROUP BY t.nome ORDER BY t.nome ";
            $result = $this->con->query($sql);

            $first = true;
            $str = "";
            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                $str .= "; " . $linhas[0];

                if ($first) {
                    $str = str_replace("; ", "", $str);
                    $first = false;
                }
            }

            echo $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregar($idProduto) {
        $sql = "SELECT t.* FROM tags as t, produtos as p "
                . "WHERE p.id=? AND t.id_produto = p.id ORDER BY t.id";
        $sqlprep = $this->con->prepare($sql);
        $sqlprep->bindParam(1, $idProduto, PDO::PARAM_INT);
        $sqlprep->execute();

        echo "<div id='tagCont'>";

        while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
            echo "<div id='" . $linhas[0] . "'"
            . "class='tag'"
            . "contenteditable='false'>"
            . $linhas[1]
            . "<img src='../img/delTag.png' class='delTag' width='20' height='20'"
            . "onclick='excluirTag(" . $linhas[0] . ");' />"
            . "</div>";
        }

        if ($sqlprep->rowCount() < 3) {
            echo "<div id='inputTags' contenteditable='true' onblur='insereTag();'></div>";
        }

        echo "</div>";
    }

    public function exibirTags($idProduto) {
        try {
            $sql = "SELECT t.* FROM tags as t, produtos as p "
                    . "WHERE p.id=? AND t.id_produto = p.id ORDER BY t.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $idProduto, PDO::PARAM_INT);
            $sqlprep->execute();

            $str = '';
            $first = true;

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if (!$first) {
                    $str .= "&";
                } else {
                    $first = false;
                }

                $str .= "/^tag=$linhas[1]$/";
            }

            echo $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->id_produto = "";
        $this->con = "";
    }

}

?>
