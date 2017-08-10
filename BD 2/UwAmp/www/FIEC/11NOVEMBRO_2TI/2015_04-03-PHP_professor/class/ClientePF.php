<?php

include_once 'Cliente.php';

class ClientePF extends Cliente {

    private $cpf;

    public function __construct($id = "", $nome = "", 
            $email = "", $cpf = "") {
        $this->cpf = $cpf;
        parent::__construct($id, $nome, $email);
    }
    
    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    
    public function mostrar(){
        parent::mostrar();
        echo "<br>CPF: "
        . $this->getCpf() . "</div>";
    }

    public function __destruct() {
        $this->cpf = "";
        parent::__destruct();
    }

}
