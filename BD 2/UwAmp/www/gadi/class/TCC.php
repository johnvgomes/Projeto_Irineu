<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class TCC {

    private $id;
    private $id_curso;
    private $titulo;
    private $url;
    private $descricao;
    private $ano;
    private $arquivo;
    private $tparquivo;
    private $con;
    private $ct;

    public function __construct($id = "", $id_curso = "", $titulo = "", $url = "", $descricao = "", $ano = "", $arquivo = "", $tparquivo = "") {
        $this->id = $id;
        $this->id_curso = $id_curso;
        $this->titulo = $titulo;
        $this->url = $url;
        $this->descricao = $descricao;
        $this->ano = $ano;
        $this->arquivo = $arquivo;
        $this->tparquivo = $tparquivo;
        $this->con = new Conectar();
        $this->ct = new Controles();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId_curso() {
        return $this->id_curso;
    }

    public function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }
    
    public function getAno() {
        return $this->ano;
    }

    public function setAno($ano) {
        $this->ano = $ano;
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

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function salvar() {
        try {

            //gravar arquivo por aqui
            $this->ct->enviarArquivo($this->getTparquivo(), "../tcc/" .
                    $this->getArquivo());

            $sql = "INSERT INTO tcc VALUES (null,?,?,?,?,?,?)";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getId_curso(), PDO::PARAM_INT);
            $prepsql->bindParam(2, $this->getTitulo(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getDescricao(), PDO::PARAM_STR);
            $prepsql->bindParam(5, $this->getAno(), PDO::PARAM_INT);
            $prepsql->bindParam(6, $this->getArquivo(), PDO::PARAM_STR);

            $prepsql->execute();

            //aqui dispara o cadastro de imagens
        } catch (PDOException $e) {
            echo "Erro no salvar tcc " . $e->getMessage();
        }
    }

    public function consultar($curso, $ano) {
        try {
            //[calendario]id, id_unidade, ano, arquivo, [unidade]id, nome
            $sql = "SELECT t.*, c.* FROM curso as c, tcc as t 
                    WHERE c.id = t.id_curso 
                    AND t.ano = ? 
                    AND t.id_curso = ?
                    ORDER BY t.titulo ";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $ano, PDO::PARAM_INT);
            $sqlprep->bindParam(2, $curso, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='noticia'>
                    <h3>$linha[2] <br> $linha[5] - $linha[9]</h3>
                        <a href='?p=tcc/excluir&id=$linha[0]' title='excluir'>
                        <img src='../imagem/icone/remove.png'>    
                        </a>
                        <a href='?p=tcc/editar&id=$linha[0]' title='editar'>
                        <img src='../imagem/icone/accept.png'>
                        </a>
                        <a href='?p=tcc/editarArquivo&id=$linha[0]' title='editar tcc'>
                        <img src='../imagem/icone/folder_up.png'>
                        </a>
                    <br><br><hr>
                    </div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar tcc " . $exc->getMessage();
        }
    }

    public function mostrar($curso, $ano, $caminho) {
        try {
            //[calendario]id, id_unidade, ano, arquivo, [unidade]id, nome
            $sql = "SELECT t.*, c.*  FROM tcc as t, curso as c
                    WHERE t.id_curso = c.id 
                    AND t.ano = ?  
                    AND t.id_curso = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $ano, PDO::PARAM_INT);
            $sqlprep->bindParam(2, $curso, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo
                "<div class='pgtcc'>
                    <img src='" . $caminho . "imagem/icone/attachment.png' title='$linha[2]'>
                
                    <span>$linha[2] - ANO: $linha[5] - $linha[9]<br><br></span>
                    <a href='" . $caminho . "tcc/" . $linha[6] . "' target='_blank'>
                    Para visualizar o projeto, clique aqui!</a>
                </div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar tcc " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT t.*, c.*
                FROM curso as c, tcc as t
                WHERE t.id=? AND c.id = t.id_curso";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar tcc " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE tcc SET id_curso=?,titulo=?,url=?,descricao=?"
                    . "ano=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_curso(), PDO::PARAM_INT);
            $sqlprep->bindParam(2, $this->getTitulo(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getUrl(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getDescricao(), PDO::PARAM_STR);
            $sqlprep->bindParam(5, $this->getAno(), PDO::PARAM_INT);
            $sqlprep->bindParam(6, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo 'Calendário atualizado com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar registros de tcc  " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {

            $vetor = $this->carregar($id);
            $this->ct->excluirArquivo("../tcc/" . $vetor[6]);

            $sql = "DELETE FROM tcc WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editarArquivo($id, $novo, $temporario, $anterior) {
        try {
            //excluir arquivo anterior na pasta
            $this->ct->excluirArquivo("../tcc/" . $anterior);

            //inserir novo arquivo na pasta
            $this->ct->enviarArquivo($temporario, "../tcc/" . $novo);

            //atualizar registro na table MySQL
            $sql = "UPDATE tcc SET arquivo=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $novo, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->id_curso = "";
        $this->titulo = "";
        $this->url = "";
        $this->descricao = "";
        $this->ano = "";
        $this->arquivo = "";
        $this->tparquivo = "";
        $this->con = "";
        $this->ct = "";
    }

}

?>
