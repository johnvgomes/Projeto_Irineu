<?php

class Departamento {

    private $id;
    private $nome;
    private $nrfuncionarios;

    public function __construct($id="", $nome="", 
            $nrfuncionarios="") {
        $this->id = $id;
        $this->nome = $nome;
        $this->nrfuncionarios = $nrfuncionarios;
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

    public function getNrfuncionarios() {
        return $this->nrfuncionarios;
    }

    public function setNrfuncionarios($nrfuncionarios) {
        $this->nrfuncionarios = $nrfuncionarios;
    }

    public function mostrar(){
        echo "Nome do Depto: " . $this->getNome()
                ."<br>Nr Funcionários: "
                .$this->getNrfuncionarios();
    }

}

?>
