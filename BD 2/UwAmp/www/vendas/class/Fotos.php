<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Fotos {

    private $id;
    private $local;
    private $tplocal;
    private $descricao;
    private $padrao;
    private $id_produto;
    private $con;
    private $ct;

    public function __construct($id = "", $local = "", $tplocal = "", $descricao = "", $padrao = "", $id_produto = "") {
        $this->id = $id;
        $this->local = $local;
        $this->tplocal = $tplocal;
        $this->descricao = $descricao;
        $this->padrao = $padrao;
        $this->id_produto = $id_produto;
        $this->con = new Conectar();
        $this->ct = new Controles();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLocal() {
        return $this->local;
    }

    public function setLocal($local) {
        $this->local = $local;
    }

    public function getTplocal() {
        return $this->tplocal;
    }

    public function setTplocal($tplocal) {
        $this->tplocal = $tplocal;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getPadrao() {
        return $this->padrao;
    }

    public function setPadrao($padrao) {
        $this->padrao = $padrao;
    }

    public function getId_produto() {
        return $this->id_produto;
    }

    public function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function inserir() {
        try {
            if ($this->getPadrao()) {
                $this->mudaPadrao();
            }

            $this->ct->enviarArquivo($this->getTplocal(), "../../../../img/img_fotos/" . $this->getLocal());

            $sql = "INSERT INTO fotos VALUES (null,?,?,?,?)";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getLocal(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getDescricao(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getPadrao(), PDO::PARAM_BOOL);
            $sqlprep->bindParam(4, $this->getId_produto(), PDO::PARAM_INT);

            if ($sqlprep->execute()) {
                echo $this->con->lastInsertId();
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function mudaPadrao() {
        try {
            $sql = "UPDATE fotos SET padrao=0 WHERE id_produto=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_produto(), PDO::PARAM_INT);

            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id=? AND f.id_produto = p.id";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo '/^txtDescImg=' . $linhas[2] . '$/&' .
                '/^chkPadrao=' . $linhas[3] . '$/';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editar() {
        try {
            if ($this->getPadrao()) {
                $this->mudaPadrao();
            }

            $sql = "UPDATE fotos SET descricao=?, padrao=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getDescricao(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getPadrao(), PDO::PARAM_BOOL);
            $sqlprep->bindParam(3, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editarImagem() {
        try {
            if ($this->getPadrao()) {
                $this->mudaPadrao();
            }

            $this->ct->enviarArquivo($this->getTplocal(), "../../../../img/img_fotos/" . $this->getLocal());

            $this->editarArquivo($this->getId());

            $sql = "UPDATE fotos SET local=?, descricao=?, padrao=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getLocal(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getDescricao(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getPadrao(), PDO::PARAM_BOOL);
            $sqlprep->bindParam(4, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editarArquivo($id) {
        $sql = "SELECT f.local FROM fotos as f, produtos as p "
                . "WHERE f.id=? AND f.id_produto = p.id";
        $sqlprep = $this->con->prepare($sql);
        $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
        $sqlprep->execute();

        $linhas = $sqlprep->fetch(PDO::FETCH_NUM);
        $anterior = $linhas[0];

        $sql = "SELECT f.* FROM fotos as f, produtos as p "
                . "WHERE local=? AND f.id_produto = p.id";
        $sqlprep = $this->con->prepare($sql);
        $sqlprep->bindParam(1, $anterior, PDO::PARAM_INT);
        $sqlprep->execute();

        $num = $sqlprep->rowCount();

        if ($num <= 1) {
            if (!$this->ct->excluirArquivo("../../../../img/img_fotos/" . $anterior)) {
                $this->ct->excluirArquivo("../img/img_fotos/" . $anterior);
            }
        }
    }

    public function excluir($id) {
        try {

            $this->editarArquivo($id);

            $sql = "DELETE FROM fotos WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultar($idProduto) {
        $sql = "SELECT f.* FROM fotos as f, produtos as p "
                . "WHERE p.id=? AND f.id_produto = p.id ORDER BY f.id";
        $sqlprep = $this->con->prepare($sql);
        $sqlprep->bindParam(1, $idProduto, PDO::PARAM_INT);
        $sqlprep->execute();

        while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
            echo "<div id='" . $linhas[0] . "'"
            . "class='imgBox'"
            . "style='background-image: url(\"../../../img/img_fotos/" . $linhas[1] . "\");'"
            . "onclick='$(\"#" . $linhas[0] . "\").addClass(\"selected\").siblings().removeClass(\"selected\");"
            . "formFoto();'>"
            . "<img src='../../../img/delBox.png' class='delBox' width='30' height='30'"
            . "onclick='excluirFoto(" . $linhas[0] . ");"
            . "event.stopPropagation();' />"
            . "</div>";
        }
    }

    public function excluirFotos($idProduto) {
        $sql = "SELECT f.id FROM fotos as f, produtos as p "
                . "WHERE f.id_produto=? AND f.id_produto = p.id";
        $sqlprep = $this->con->prepare($sql);
        $sqlprep->bindParam(1, $idProduto, PDO::PARAM_INT);
        $sqlprep->execute();

        while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
            $this->excluir($linhas[0]);
        }
    }

    public function exibirFotos($idProduto) {
        try {
            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id_produto=? AND f.id_produto = p.id ORDER BY f.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $idProduto, PDO::PARAM_INT);
            $sqlprep->execute();

            $str = '';
            $first = true;

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if (!$first) {
                    $str .= "&&";
                } else {
                    $first = false;
                }

                $str .= utf8_encode("/^^img==/^local=$linhas[1]$/&/^descricao=$linhas[2]$/&/^padrao=$linhas[3]$/$$/");
            }

            echo $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->local = "";
        $this->tplocal = "";
        $this->descricao = "";
        $this->padrao = "";
        $this->id_produto = "";
        $this->con = "";
        $this->ct = "";
    }

}

?>
