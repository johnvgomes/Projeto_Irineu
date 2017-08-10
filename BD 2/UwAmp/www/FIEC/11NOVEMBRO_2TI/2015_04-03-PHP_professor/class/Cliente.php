<?php

class Cliente {

    //atributos - caracteristicas
    private $id;
    private $nome;
    private $email;

    public function __construct($id = "", $nome = "", $email = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function mostrar() {
        echo "<div class='mostrar'>Nome do Cliente: "
        . $this->getNome() . "<br>"
        . "E-mail do Cliente: "
        . $this->getEmail();
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->email = "";
    }
}
