<?php

/*
 * create table noticia(
 * id int primary key auto_increment,
 * titulo varchar(100) not null,
 * url varchar(100) not null,
 * conteudo text,
 * data date,
 * id_eixo int,
 * foreign key (id_eixo) references eixo(id)
 * );
 */

include_once 'Conectar.php';
include_once 'Controles.php';

class Calendario {

    private $id;
    private $id_unidade;
    private $ano;
    private $arquivo;
    private $tparquivo;
    private $con;
    private $ct;

    public function __construct($id="", $id_unidade="", $ano="", $arquivo="", 
            $tparquivo="") {
        $this->id = $id;
        $this->id_unidade = $id_unidade;
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

    public function getId_unidade() {
        return $this->id_unidade;
    }

    public function setId_unidade($id_unidade) {
        $this->id_unidade = $id_unidade;
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

    public function salvar() {
        try {

            //gravar arquivo por aqui
            $this->ct->enviarArquivo($this->getTparquivo(), "../calendario/" .
                    $this->getArquivo());

            $sql = "INSERT INTO calendario VALUES (null,?,?,?)";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getId_unidade(), PDO::PARAM_INT);
            $prepsql->bindParam(2, $this->getAno(), PDO::PARAM_INT);
            $prepsql->bindParam(3, $this->getArquivo(), PDO::PARAM_STR);

            $prepsql->execute();

            //aqui dispara o cadastro de imagens
        } catch (PDOException $e) {
            echo "Erro no salvar calendario " . $e->getMessage();
        }
    }

    ///tem que mexer neste método
    public function visualizar($caminho, $url) {
        try {
            $sql = "SELECT n.* FROM 
            noticia as n WHERE n.url = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $url, PDO::PARAM_STR);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='noticia'>
                    <h3>$linha[1] - " . @date("d/m/Y", strtotime($linha[4])) . "</h3>
                    $linha[3]
                    " . $this->in->visualizar($caminho, $linha[0]) . "
                </div>";
            }
        } catch (PDOException $e) {
            echo "Erro no visualizar notícia " . $e->getMessage();
        }
    }

    public function consultar($inicial, $final) {
        try {
            //[calendario]id, id_unidade, ano, arquivo, [unidade]id, nome
            $sql = "SELECT c.*, u.* FROM calendario as c, unidade as u 
                    WHERE c.id_unidade = u.id AND c.ano BETWEEN ? AND ?                 
                    ORDER BY c.ano ";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $inicial, PDO::PARAM_INT);
            $sqlprep->bindParam(2, $final, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='noticia'>
                    <h3>$linha[2] - $linha[5]</h3>
                        <a href='?p=calendario/excluir&id=$linha[0]' title='excluir'>
                        <img src='../imagem/icone/remove.png'>    
                        </a>
                        <a href='?p=calendario/editar&id=$linha[0]' title='editar'>
                        <img src='../imagem/icone/accept.png'>
                        </a>
                        <a href='?p=calendario/editarArquivo&id=$linha[0]' title='editar calendário'>
                        <img src='../imagem/icone/folder_up.png'>
                        </a>
                    <br><br><hr>
                    </div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar calendário " . $exc->getMessage();
        }
    }

    public function mostrar($ano,$caminho) {
        try {
            //[calendario]id, id_unidade, ano, arquivo, [unidade]id, nome
            $sql = "SELECT c.*, u.* FROM calendario as c, unidade as u 
                    WHERE c.id_unidade = u.id AND c.ano = ?                 
                    ORDER BY u.nome ";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $ano, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo
                "<div class='pgnoticia'>
                    <img src='".$caminho."imagem/calendario.png' title='$linha[5] - $linha[2]'>
                
                    <span>$linha[5] - $linha[2]<br><br><br>
                    <a href='" . $caminho . "calendario/" . $linha[3] . "' target='_blank'>
                    Para visualizar, clique aqui!</a>
                </div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar calendário " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT c.*, u.*
                FROM calendario as c, unidade as u
                WHERE c.id=? AND c.id_unidade = u.id";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar calendário " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE calendario SET id_unidade=?,ano=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_unidade(), PDO::PARAM_INT);
            $sqlprep->bindParam(2, $this->getAno(), PDO::PARAM_INT);
            $sqlprep->bindParam(3, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo 'Calendário atualizado com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar registros de calendario  " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {

            $vetor = $this->carregar($id);

            $this->ct->excluirArquivo("../calendario/" . $vetor[3]);

            $sql = "DELETE FROM calendario WHERE id=?";
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
            $this->ct->excluirArquivo("../calendario/" . $anterior);

            //inserir novo arquivo na pasta
            $this->ct->enviarArquivo($temporario, "../calendario/" . $novo);

            //atualizar registro na table MySQL
            $sql = "UPDATE calendario SET arquivo=? WHERE id=?";
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
        $this->titulo = "";
        $this->url = "";
        $this->conteudo = "";
        $this->data = "";
        $this->id_eixo = "";
        $this->con = "";
    }

}

?>
