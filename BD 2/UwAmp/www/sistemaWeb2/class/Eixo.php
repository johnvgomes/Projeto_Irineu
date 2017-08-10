<?php

include_once 'Conectar.php';

class Eixo {

    //put your code here
    private $id;
    private $nome;
    private $con;

    public function __construct($id = "", $nome = "") {
        $this->id = $id;
        $this->nome = $nome;
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

    public function cadastrar() {
        try {
            //correto
            $sql = "INSERT INTO eixo VALUES (null,?);";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);

            if ($sqlprep->execute() == 1) {
                echo "Eixo cadastrado com sucesso!";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar eixo " . $exc->getMessage();
        }
    }

    public function consultar() {
        try {
            $sql = "SELECT * FROM eixo ORDER BY nome";
            //executando o comando sql
            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo "
                    <div class='mostrar'>
                        $linha[0] - $linha[1]
                        <br>
                        <a href='?p=eixo/editar&id=$linha[0]'>
                            [editar]
                        </a>
                        <a href='?p=eixo/excluir&id=$linha[0]'>
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

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM eixo WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
        } catch (PDOException $exc) {
            echo "Erro ao carregar eixo " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE eixo SET nome = ? WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId(), PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo "Erro ao editar eixo " . $exc->getMessage();
        }
    }

    public function excluir() {
        try {
            $sql = "DELETE FROM eixo WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId(), PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo "Erro ao EXCLUIR eixo " . $exc->getMessage();
        }
    }

    public function carregarSelect() {
        try {
            $sql = "SELECT * FROM eixo ORDER BY nome";
            //executando o comando sql
            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$linha[0]'>
                        $linha[1]
                        </option>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar eixo tecnol. " .
            $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
    }

}

?>
