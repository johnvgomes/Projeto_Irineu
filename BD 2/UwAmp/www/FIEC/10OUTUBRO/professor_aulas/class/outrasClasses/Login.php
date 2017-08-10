<?php

require_once 'Conectar.php';

class Login {

    private $id;
    private $email;
    private $senha;

    public function __construct($i = "", $e = "", $s = "") {
        $this->id = $i;
        $this->email = $e;
        $this->senha = $s;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function salvar() {
        try {
            $sql = "INSERT INTO login VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getEmail(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, sha1($this->getSenha()), PDO::PARAM_STR);
            if ($sqlprep->execute())
                echo 'Gravado com sucesso';
            $this->con = null; //desconectar
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->con = "";
        $this->id = "";
        $this->usuario = "";
        $this->senha = "";
    }

}
