<?php

include_once 'Cliente.php';
include_once 'Conectar.php';

class ClientePF extends Cliente {

    private $cpf;
    private $conn;

    public function __construct($id = "", $nome = "", 
            $email = "", $cpf = "") {
        $this->cpf = $cpf;
        $this->conn = new Conectar();
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
    
    public function salvar(){
        try {
            $sql = "INSERT INTO clientepf VALUES (null,?,?,?)";
            $sqlprep = $this->conn->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getEmail(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getCpf(), PDO::PARAM_STR);
            if($sqlprep->execute()){
                echo "Cliente Pessoa Física cadastrado";
            }else{
                echo "Erro ao cadastrar Cliente Pessoa Física";
            }
        } catch (PDOException $exc) {
            echo "Erro ao salvar clientepf "
            .$exc->getMessage();
        }
    }

    public function __destruct() {
        $this->cpf = "";
        $this->conn = null;
        parent::__destruct();
    }

}
