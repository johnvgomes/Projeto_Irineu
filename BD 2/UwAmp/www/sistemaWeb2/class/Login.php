<?php

include_once 'Conectar.php';

class Login {

    private $id;
    private $email;
    private $senha;
    private $con;

    public function __construct($id = "", $email = "", $senha = "") {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function salvar() {
        try {//tente executar o código
            $sql = "INSERT INTO login VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getEmail(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, sha1($this->getSenha()), PDO::PARAM_STR);
            if ($sqlprep->execute()) {
                echo "Gravado com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao salvar usuário " .
            $exc->getMessage();
        }
    }

    public function consultarEmail() {
        try {
            $sql = "SELECT email FROM login WHERE email = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getEmail(), PDO::PARAM_STR);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                //caso exista o email retorna 1
                return 1;
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar email de usuário "
            . $exc->getMessage();
        }
    }

    public function editarSenha() {
        try {
            $sql = "UPDATE login SET senha = ? WHERE email = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, sha1($this->getSenha()), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getEmail(), PDO::PARAM_STR);
            if ($sqlprep->execute()) {
                echo "senha alterada com sucesso";
            }else{
                echo "erro ao alterar senha";
            }
        } catch (PDOException $exc) {
            echo "Erro ao editar senha de usuário "
            . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->email = "";
        $this->senha = "";
        $this->con = "";
    }

}

?>
