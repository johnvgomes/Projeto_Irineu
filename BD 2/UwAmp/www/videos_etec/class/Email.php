<?php

include_once 'Conectar.php';

class Email {

    //put your code here
    private $id;
    private $email;
    private $con;

    public function __construct($id="", $email="") {
        $this->id = $id;
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCon() {
        return $this->con;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCon($con) {
        $this->con = $con;
    }

    public function cadastrar() {
        try {
            $sql = "INSERT INTO emails VALUES (null,?)";
            $this->con = new Conectar();
            $prepsql = $this->con->prepare($sql);
            @$prepsql->bindParam(1, $this->getEmail(), PDO::PARAM_STR);
            if ($prepsql->execute()) {
                echo "Email cadastrado com sucesso!";
            } else {
                echo "Falha ao cadastrar email!";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

//fim salvar

    public function __destruct() {
        $this->id = "";
        $this->email = "";
        $this->con = "";
    }

}

?>
