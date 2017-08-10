<?php

/*
 * create table curso(
  id int primary key auto_increment,
  nome varchar(50),
  tipo varchar(20),
  grade varchar(100),
  plano_curso varchar(100),
  id_eixo int
  );
 */

include_once 'Conectar.php';

class Curso {

    private $id;
    private $nome;
    private $tipo; //técnico ou superior
    private $grade;
    private $temp_grade;
    private $planocurso;
    private $temp_planocurso;
    private $id_eixo;
    private $con;

    public function __construct($id = "", $nome = "", $tipo = "", $grade = "", $temp_grade = "", $planocurso = "", $temp_planocurso = "", $id_eixo = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->grade = $grade;
        $this->temp_grade = $temp_grade;
        $this->planocurso = $planocurso;
        $this->temp_planocurso = $temp_planocurso;
        $this->id_eixo = $id_eixo;
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

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getGrade() {
        return $this->grade;
    }

    public function setGrade($grade) {
        $this->grade = $grade;
    }

    public function getTemp_grade() {
        return $this->temp_grade;
    }

    public function setTemp_grade($temp_grade) {
        $this->temp_grade = $temp_grade;
    }

    public function getPlanocurso() {
        return $this->planocurso;
    }

    public function setPlanocurso($planocurso) {
        $this->planocurso = $planocurso;
    }

    public function getTemp_planocurso() {
        return $this->temp_planocurso;
    }

    public function setTemp_planocurso($temp_planocurso) {
        $this->temp_planocurso = $temp_planocurso;
    }

    public function getId_eixo() {
        return $this->id_eixo;
    }

    public function setId_eixo($id_eixo) {
        $this->id_eixo = $id_eixo;
    }

    public function cadastrar() {
        try {
            //correto
            $sql = "INSERT INTO curso VALUES (null,?,?,null,null,?);";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getTipo(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getId_eixo(), PDO::PARAM_INT);

            if ($sqlprep->execute() == 1) {
                echo "Curso cadastrado com sucesso!";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar curso " . $exc->getMessage();
        }
    }

    public function consultar() {
        try {
            $sql = "SELECT c.id, c.nome, c.tipo, e.nome
                FROM curso as c, eixo as e 
                WHERE c.id_eixo = e.id
                ORDER BY c.nome";
            //executando o comando sql
            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo "
                    <div class='mostrar'>
                        $linha[1] - $linha[2] - $linha[3]
                        <br>
                        <a href='?p=curso/editar&id=$linha[0]'>
                            [editar]
                        </a>
                        <a href='?p=curso/excluir&id=$linha[0]'>
                            [excluir]
                        </a>
                    </div>
                ";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar eixo tecnol. " .
            $exc->getMessage();
        }
    }

//fim consultar

    public function excluir() {
        try {
            $sql = "DELETE FROM curso WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId(), PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo "Erro ao EXCLUIR curso " . $exc->getMessage();
        }
    }

    //carregar dados no form antes de editar
    public function carregar($id) {
        try {
            $sql = "SELECT c.*, e.* FROM curso as c, 
                eixo as e WHERE c.id_eixo = e.id AND 
                c.id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
        } catch (PDOException $exc) {
            echo "Erro ao CARREGAR curso "
            . $exc->getMessage();
        }
    }//fim carregar
}

?>
