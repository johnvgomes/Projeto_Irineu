<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Arquivo {

    private $id;
    private $descricao;
    private $arquivo;
    private $tparquivo;
    private $imagem;
    private $tpimagem;
    private $tipo;
    private $con;
    private $ct;

    public function __construct() {
        $this->con = new Conectar();
        $this->ct = new Controles();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getArquivo() {
        return $this->arquivo;
    }

    public function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    public function getTparquivo() {
        return $this->tparquivo;
    }

    public function setTparquivo($tparquivo) {
        $this->tparquivo = $tparquivo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function getTpimagem() {
        return $this->tpimagem;
    }

    public function setTpimagem($tpimagem) {
        $this->tpimagem = $tpimagem;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function salvar($tipo, $imagem, $arquivo) {
        try {
            //faremos o envio da imagem na linha abaixo
            $this->ct->enviarArquivo($this->getTpimagem(), $imagem . $this->getImagem());

            $sql = "";
            /*
             * Tipos
             * Aluno com arquivo
             * Aluno sem arquivo
             * Servidor com arquivo
             * Servidor sem arquivo
             * Plano Escolar
             */
            if ($tipo == "Aluno com arquivo" || $tipo == "Servidor com arquivo" ||
                    $tipo == "Plano Escolar") {
                $this->ct->enviarArquivo($this->getTparquivo(), $arquivo . $this->getArquivo());
            }

            //caso seja sem arquivo, mandaremos o link de acesso em setArquivo
            $sql = "INSERT INTO arquivo VALUES (null,?,?,?,?);";
            $prepsql = $this->con->prepare($sql);
            $prepsql->bindParam(1, $this->getDescricao(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getArquivo(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getImagem(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getTipo(), PDO::PARAM_STR);

            if ($prepsql->execute()) {
                echo "Cadastro de arquivo efetuado com sucesso";
            } else {
                echo "Falha ao cadastrar arquivo";
            }
        } catch (PDOException $exc) {
            echo "Erro no cadastrar arquivo " . $exc->getMessage();
        }
    }

    public function consultar($caminho, $tipo) {
        try {
            $sql = "SELECT * FROM arquivo WHERE tipo = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $tipo, PDO::PARAM_STR);
            $sqlprep->execute();

            //indica com arquivo
            if (!$caminho == "") {
                $link = $caminho . 'arquivo/';
            } else {
                $link = "";
            }

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<a href='$link$linha[2]' target='_blank'>"
                . "<img src='{$caminho}imagem-arquivo/{$linha[3]}' class='servidor'>"
                . "</a>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar arquivo " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM arquivo WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar arquivo " . $exc->getMessage();
        }
    }

    public function consultarAdm($tipo) {
        try {
            $sql = "SELECT * FROM arquivo WHERE tipo = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $tipo, PDO::PARAM_STR);
            $sqlprep->execute();

            if ($tipo == "Aluno com arquivo" || $tipo == "Servidor com arquivo" ||
                    $tipo == "Plano Escolar") {
                $link = "../arquivo/";
            }

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='posicionar'>"
                . "<table>"
                . "<tr><th colspan='2'>"
                . "<img src='../imagem-arquivo/{$linha[3]}' class='servidor' height='75px;'>"
                . "</th></tr>"
                . "<tr><td>"
                . "<a href='?p=arquivo/excluir&id=$linha[0]' title='Excluir Foto'>"
                . "<img src='../imagem/icone/remove.png' id='imagem'>"
                . "</a>"
                . "</td><td></tr>"
                . "</table>"
                . "</div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar arquivo " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $foto = $this->carregar($id);
            $this->ct->excluirArquivo("../imagem-arquivo/" . $foto[3]);
            $this->ct->excluirArquivo("../arquivo/" . $foto[2]);

            $sql = "DELETE FROM arquivo WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo "Erro ao excluir " . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->con = "";
        $this->ct = "";
    }

}
