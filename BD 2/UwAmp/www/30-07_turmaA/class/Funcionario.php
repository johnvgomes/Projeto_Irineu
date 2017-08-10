<?php

class Funcionario {

    private $id;
    private $nome;
    private $salario;
    private $id_depto;
    private $con;

    public function __construct() {
        $this->con = new Conectar();
    }

    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->salario = null;
        $this->id_deptod = null;
        $this->con = null;
    }

}

?>
