<?php

include_once 'Conectar.php';

class Login {

    private $id;
    private $email;
    private $senha;
    private $con;

    public function __construct($id="", $email="", $senha="") {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
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

    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function cadastrar(){
        try {
            
            $sql = "INSERT INTO login VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getEmail(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, sha1($this->getSenha()), PDO::PARAM_STR);
            if($sqlprep->execute()){
                echo "Usuário gravado com sucesso!";
            }else{
                echo "Erro ao cadastrar usuário";
            }
            
        } catch (PDOException $exc) {
            echo "Erro no cadastrar login ".$exc->getMessage();
        }  
    }//fim cadastrar


    public function __destruct() {
        $this->id = "";
        $this->email = "";
        $this->senha = "";
        $this->con = "";
    }

}
