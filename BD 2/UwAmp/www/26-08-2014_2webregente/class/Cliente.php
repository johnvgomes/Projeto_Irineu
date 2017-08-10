<?php

class Cliente {
    //atributos - caracteristicas
    private $id;
    private $nome;
    private $salario;
    
    public function __construct($id="", $nome="", $salario="") {
        $this->id = $id;
        $this->nome = $nome;
        $this->salario = $salario;
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

    public function getSalario() {
        return $this->salario;
    }

    public function setSalario($salario) {
        $this->salario = $salario;
    }




    
}

?>
