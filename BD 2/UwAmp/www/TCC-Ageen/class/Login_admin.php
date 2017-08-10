<?php

require_once 'Conectar.php';

class Login_admin {

    private $id;
    private $usuario;
    private $senha;
    private $nivel;
            
    public function __construct($i = "", $u = "", $s = "", $n = "") {
        $this->id = $i;
        $this->usuario = $u;
        $this->senha = $s;
        $this->nivel = $n;
        $this->con = new Conectar();
    }
    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

            public function salvar() {
        try {
            $sql = "INSERT INTO login_admin VALUES (null,?,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getUsuario(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, sha1($this->getSenha()), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getNivel(), PDO::PARAM_STR);
            if ($sqlprep->execute())
                echo 'Gravado com sucesso';
            $this->con = null; //desconectar
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function editarSenha() {
        try {
            $sql = "UPDATE login_admin SET senha=? WHERE user=?";
            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, sha1($this->getSenha()), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getUsuario(), PDO::PARAM_STR);
            
            if ($sqlprep->execute() == 1) {
                echo "senha atualizada com sucesso";
            } else {
                echo "Problemas ao editar senha";
            }
        } catch (Exception $exc) {
            echo "Erro no editar senha " . $exc->getMessage();
        }
    }
    
    public function consultarUsuario() {

        try {

            $sql = "select user from login_admin WHERE user = ?";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getUsuario(), PDO::PARAM_STR);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                //caso já exista no cadastro
                return 1;
            }
        } catch (PDOException $exc) {
            echo "Erro na consulta de usuario " . $exc->getMessage();
        }
    }
    
    

    public function __destruct() {
        $this->con = "";
        $this->id = "";
        $this->usuario = "";
        $this->senha = "";
    }

}
