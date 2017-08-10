<?php

include_once 'Conectar.php';

class Departamento {

    private $id;
    private $nome;
    private $nrfuncionarios;
    private $con;

    public function __construct($id = "", $nome = "", $nrfuncionarios = "") {
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

    public function salvar() {
        try {//tente executar o código abaixo
            $sql = "INSERT INTO departamento VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getNrfuncionarios(), PDO::PARAM_INT);
            if ($sqlprep->execute()) {
                echo "Depto cadastrado com sucesso";
            } else {
                echo "Erro ao cadastrar Depto";
            }
        } catch (PDOException $exc) {//caso não consiga
            echo "Erro ao cadastrar "
            . "departamento " . $exc->getMessage();
            $this->con = null;
        }
    }

    public function consultar() {
        try {
            $sql = "SELECT * FROM departamento ORDER BY nome";

            $resultado = $this->con->query($sql);
            $i = 1;
            while ($linha = $resultado->fetch(PDO::FETCH_NUM)) {
                if ($i % 2 == 1) {
                    $class = "linhaimpar";
                } else {
                    $class = "linhapar";
                }
                echo "<tr class='$class'>"
                . "<td class='coluna1'>$linha[0]</td>"
                . "<td class='coluna2'>" . strtr($linha[1], "áéíóúâêôãõàèìòùç", "ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ") . "</td>"
                . "<td class='coluna3'>$linha[2]</td>"
                . "<td>"
                . "<a href='?p=departamento/excluir&id=$linha[0]'>"
                . "<img src='../imagem/remove.png' alt='excluir'>"
                . "</a>"
                . "</td>"
                . "<td>"
                . "<a href='?p=departamento/editar&id=$linha[0]'>"
                . "<img src='../imagem/page_edit.png' alt='editar'>"
                . "</a>"
                . "</td>"
                . "</tr>";
                $i++;
            }
        } catch (PDOException $exc) {//caso não consiga
            echo "Erro ao consultar "
            . "departamento " . $exc->getMessage();
            $this->con = null;
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * "
                    . "FROM departamento "
                    . "WHERE id = ? "
                    . "ORDER BY nome";
            
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
            
            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linha;
            }
        } catch (PDOException $exc) {//caso não consiga
            echo "Erro ao carregar "
            . "departamento " . $exc->getMessage();
            $this->con = null;
        }
    }
    
    public function editar() {
        try {//tente executar o código abaixo
            $sql = "UPDATE departamento SET nome = ?, nrfuncionarios = ? "
                    . "WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getNrfuncionarios(), PDO::PARAM_INT);
            $sqlprep->bindParam(3, $this->getId(), PDO::PARAM_INT);
            if ($sqlprep->execute()) {
                echo "Depto atualizado com sucesso";
            } else {
                echo "Erro ao atualizar Depto";
            }
        } catch (PDOException $exc) {//caso não consiga
            echo "Erro ao atualizar "
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
