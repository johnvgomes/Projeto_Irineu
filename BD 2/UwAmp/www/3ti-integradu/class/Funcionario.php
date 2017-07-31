<?php

include_once 'Conectar.php';

class Funcionario {

    private $id;
    private $nome;
    private $salario;
    private $id_depto;
    private $con;

    public function __construct() {
        $this->con = new Conectar();
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

    public function getId_depto() {
        return $this->id_depto;
    }

    public function setId_depto($id_depto) {
        $this->id_depto = $id_depto;
    }

    public function salvar() {
        try {
            $sql = "INSERT INTO funcionario VALUES (null,?,?,?)";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getSalario(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getId_depto(), PDO::PARAM_INT);
            if ($sqlprep->execute() == 1) {
                echo "Cadastro efetuado com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar funcionário "
            . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->salario = null;
        $this->id_depto = null;
        $this->con = null;
    }

}

?>
