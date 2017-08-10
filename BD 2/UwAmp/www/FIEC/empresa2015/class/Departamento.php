<?php

include_once 'Conectar.php';

class Departamento {
    private $id;
    private $nome;
    private $nrfuncionarios;
    private $con;

    public function __construct($id="", 
            $nome="", $nrfuncionarios="") {
        $this->id = $id;
        $this->nome = $nome;
        $this->nrfuncionarios = $nrfuncionarios;
        $this->con = new Conectar();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getNrfuncionarios() {
        return $this->nrfuncionarios;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setNrfuncionarios($nrfuncionarios) {
        $this->nrfuncionarios = $nrfuncionarios;
    }

    public function salvar(){
        try {//tente executar o código abaixo
            $sql = "INSERT INTO departamento "
                    . "VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), 
                    PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getNrfuncionarios(), 
                    PDO::PARAM_INT);
            if($sqlprep->execute()){
                echo "Depto cadastrado com sucesso";
            }else{
                echo "Erro ao cadastrar Depto";
            }       
            
        } catch (PDOException $exc) {//caso não consiga
            echo "Erro ao cadastrar "
            . "departamento " . $exc->getMessage();
            $this->con = null;
        }
    }


    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->nrfuncionarios = null;
        $this->con = null;
    }
    

}
