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
include_once 'ImagemNoticia.php';

class Noticia {

    private $id;
    private $titulo;
    private $url;
    private $conteudo;
    private $data;
    private $id_eixo;
    private $con;
    private $in;

    public function __construct($id = "", $titulo = "", $url = "", $conteudo = "", $data = "", $id_eixo = "") {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->url = $url;
        $this->conteudo = $conteudo;
        $this->data = $data;
        $this->id_eixo = $id_eixo;
        $this->con = new Conectar();
        $this->in = new ImagemNoticia();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return utf8_encode($this->titulo);
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getUrl() {
        return utf8_encode($this->url);
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getConteudo() {
        return utf8_encode($this->conteudo);
    }

    public function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getId_eixo() {
        return $this->id_eixo;
    }

    public function setId_eixo($id_eixo) {
        $this->id_eixo = $id_eixo;
    }

    public function salvar() {
        try {

            $sql = "INSERT INTO noticia VALUES (null,?,?,?,?,?)";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getTitulo(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getConteudo(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getData(), PDO::PARAM_STR);
            $prepsql->bindParam(5, $this->getId_eixo(), PDO::PARAM_INT);

            $prepsql->execute();

            //aqui dispara o cadastro de imagens
        } catch (PDOException $e) {
            echo "Erro no salvar notícia " . $e->getMessage();
        }
    }

    public function paginar($pg, $table1, $table2, $pasta, $link) {
        // $numreg determina quantos registros por página irão ser mostrados
        // $pg representa em que página está
        // $table1 - > tabela SQL
        // $table2 - > tabela SQL com FK
        // $pasta mostra o diretório da imagem e/ou arquivo
        // $px tamanho da imagem em px
        // $link armazena o endereço da página
        // $imagem - colocar a posição da imagem na table MySQL no caso o 3
        // $titulo - posição de campo da table MySQL que contenha titulo ou nome no caso o 1
        //conteudo
        //url da noticia
        //posição de data
        try {
            $this->p = new Paginar();
            $this->p->paginacao(4, $pg, $table1, $table2, $pasta, '75px', $link, 8, 1, 3, 2, 4);
        } catch (PDOException $e) {
            echo "Erro no paginar notícia " . $e->getMessage();
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
                echo
                "<br><br><br><br><br><br><br>"
                . "<div class='fb-like' data-href='$caminho/visualizar/$url' data-width='120' data-layout='standard' data-action='like' data-show-faces='true' data-share='true'></div>"
                . "<div class='noticia'>
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

            $sql = "SELECT * FROM noticia 
                    WHERE data BETWEEN ? AND ?                 
                    ORDER BY data ";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $inicial, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $final, PDO::PARAM_STR);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='noticia'>
                    <h3>$linha[1] - " . @date("d/m/Y", strtotime($linha[4])) . "</h3>
                        <a href='?p=noticia/excluir&id=$linha[0]' title='excluir'>
                        <img src='../imagem/icone/remove.png'>  
                        </a>
                        <a href='?p=noticia/editar&id=$linha[0]' title='editar'>
                        <img src='../imagem/icone/accept.png'>
                        </a>
                    <br><br><hr>
                    </div>
                
                    " . $this->in->visualizarAdmin($linha[0])
                . "";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar noticia " . $exc->getMessage();
        }
    }

    public function ultimasNoticias($caminho) {
        try {

            $sql = "SELECT * FROM noticia ORDER BY id DESC LIMIT 4";

            $sqlprep = $this->con->query($sql);
            echo "<h4>Últimas Notícias</h4>";
            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {

                echo "
                    <img src='imagem/seta.png'>
                    <a href='" . $caminho . "visualizar/" . $linha[2] . "'>
                    $linha[1] - " . @date("d/m/Y", strtotime($linha[4])) . "</a><br>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar últimas notícias " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT n.*, e.*
                FROM noticia as n, eixo as e
                WHERE n.id=? AND n.id_eixo = e.id";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar noticia " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE noticia SET titulo=?,url=?,conteudo=?,
                id_eixo=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getTitulo(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getUrl(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getConteudo(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getId_eixo(), PDO::PARAM_INT);
            $sqlprep->bindParam(5, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo 'Noticia atualizada com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar registros de noticia  " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {

            $this->in->excluir($id);

            $sql = "DELETE FROM noticia WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultarTitulo() {

        try {

            $sql = "select url from noticia";

            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo utf8_encode('"' . $linha[0] . '", ');
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar de noticia " . $exc->getMessage();
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
