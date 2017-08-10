<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Departamento {

    private $id;
    private $nome;
    private $nrfuncionarios;
    private $planta;
    private $temp_planta;
    private $ct;
    private $con;

    public function __construct($id = "", $nome = "", $nrfuncionarios = "", $planta = "", $temp_planta = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->nrfuncionarios = $nrfuncionarios;
        $this->planta = $planta;
        $this->temp_planta = $temp_planta;
        $this->ct = new Controles();
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

    public function getNrfuncionarios() {
        return $this->nrfuncionarios;
    }

    public function setNrfuncionarios($nrfuncionarios) {
        $this->nrfuncionarios = $nrfuncionarios;
    }

    public function getPlanta() {
        return $this->planta;
    }

    public function setPlanta($planta) {
        $this->planta = $planta;
    }

    public function getTemp_planta() {
        return $this->temp_planta;
    }

    public function setTemp_planta($temp_planta) {
        $this->temp_planta = $temp_planta;
    }

    public function mostrar() {
        echo "Nome de Depto: " . $this->getNome()
        . "<br>Nr Funcionários: "
        . $this->getNrfuncionarios();
    }

    public function salvar() {
        try {
            //envio do arquivo
            $this->ct->enviarArquivo($this->getTemp_planta(), "../planta/" . $this->getPlanta());

            $sql = "INSERT INTO departamento 
                VALUES (null,?,?,?)";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getNrfuncionarios(), PDO::PARAM_INT);
            @$sqlprep->bindParam(3, $this->getPlanta(), PDO::PARAM_STR);
            if ($sqlprep->execute() == 1) {
                echo "Cadastro efetuado com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar depto "
            . $exc->getMessage();
        }
    }

    public function consultar() {
        try {
            $sql = "SELECT * FROM departamento";

            $sqlprep = $this->con->query($sql);

            while ($vetor = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='depto'>
                    $vetor[0]<br>
                    Departamento: $vetor[1]<br>
                    Número de Funcionários: $vetor[2]<br>
                    <a href='../planta/$vetor[3]' title='Baixe a planta' target='_blank'>
                        Confira a planta do Departamento
                    </a><br><br>
                    <a href='?p=departamento/excluir&id=$vetor[0]' 
                        title='Exclusão de Departamento'>
                        <img src='../imagem/remove.png' alt='Excluir'>
                    </a>
                    <a href='?p=departamento/editar&id=$vetor[0]' 
                        title='Edição de Departamento'>
                        <img src='../imagem/application_edit.png' alt='Editar'>
                    </a>
                    <a href='?p=departamento/editarArquivo&id=$vetor[0]' 
                        title='Edição de Departamento'>
                        <img src='../imagem/application_edit.png' alt='Editar'>
                    </a>
                </div>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar depto "
            . $exc->getMessage();
        }
    }

    public function excluir() {
        try {

            $registro = $this->carregar();

            @$this->ct->excluirArquivo("../planta/" . $registro[3]);

            $sql = "DELETE FROM departamento WHERE id = ?";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute() == 1) {
                echo "Exclusão efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao excluir depto "
            . $exc->getMessage();
        }
    }

    public function carregar() {
        try {
            $sql = "SELECT * FROM departamento "
                    . "WHERE id = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId(), PDO::PARAM_INT);
            $sqlprep->execute();

            if ($registro = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $registro;
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar depto "
            . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE departamento SET nome = ?, "
                    . "nrfuncionarios = ? WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getNrfuncionarios(), PDO::PARAM_INT);
            $sqlprep->bindParam(3, $this->getId(), PDO::PARAM_INT);
            if ($sqlprep->execute() == 1) {
                echo "Alteração efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao editar depto "
            . $exc->getMessage();
        }
    }

    public function editarArquivo() {
        try {
            $registro = $this->carregar();
            @$this->ct->excluirArquivo("../planta/" . $registro[3]);
        
            //envio do arquivo
            $this->ct->enviarArquivo($this->getTemp_planta(), 
                    "../planta/" . $this->getPlanta());
            
            $sql = "UPDATE departamento SET planta = ? "
                    . "WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getPlanta(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId(), PDO::PARAM_INT);
            if ($sqlprep->execute() == 1) {
                echo "Alteração efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao editar arquivo "
            . $exc->getMessage();
        }
    }
    
    public function carregarSelect() {
        try {
            $sql = "SELECT * FROM departamento ORDER BY nome";

           $sqlprep = $this->con->query($sql);

            while ($registro = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$registro[0]'>$registro[1]</option>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar depto "
            . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->nrfuncionarios = null;
        $this->con = null;
    }

}

?>