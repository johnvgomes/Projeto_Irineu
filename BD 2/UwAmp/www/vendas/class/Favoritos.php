<?php

include_once 'Conectar.php';

class Favoritos {

    private $id;
    private $id_cliente;
    private $id_produto;
    private $con;

    public function __construct($id = "", $id_cliente = "", $id_produto = "") {
        $this->id = $id;
        $this->id_cliente = $id_cliente;
        $this->id_produto = $id_produto;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId_cliente() {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function getId_produto() {
        return $this->id_produto;
    }

    public function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function favoritar() {
        try {
            $sql = "SELECT f.* FROM favoritos as f, clientes as cl, produtos as p "
                    . "WHERE f.id_produto = ? AND f.id_cliente = ? AND f.id_produto=p.id AND f.id_cliente=cl.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_produto(), PDO::PARAM_INT);
            $sqlprep->bindParam(2, $this->getId_cliente(), PDO::PARAM_INT);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();
            $first = true;

            if ($num > 0) {
                return $this->excluir();
            } else {
                echo $this->inserir();
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function inserir() {
        try {
            $sql = "INSERT INTO favoritos VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_cliente(), PDO::PARAM_INT);
            $sqlprep->bindParam(2, $this->getId_produto(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 1;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir() {
        try {
            $sql = "DELETE FROM favoritos WHERE id_cliente = ? AND id_produto = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_cliente(), PDO::PARAM_INT);
            $sqlprep->bindParam(2, $this->getId_produto(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 0;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->id_cliente = "";
        $this->id_produto = "";
        $this->con = "";
    }

}

?>
