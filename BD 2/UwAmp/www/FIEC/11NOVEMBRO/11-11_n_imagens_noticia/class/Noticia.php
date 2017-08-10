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
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getConteudo() {
        return $this->conteudo;
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

            $prepsql->bindParam(2, $this->getTitulo(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getConteudo(), PDO::PARAM_STR);
            $prepsql->bindParam(5, $this->getData(), PDO::PARAM_STR);
            $prepsql->bindParam(1, $this->getId_eixo(), PDO::PARAM_INT);

            $prepsql->execute();

            //aqui dispara o cadastro de imagens
        } catch (PDOException $e) {
            echo "Erro no salvar notícia " . $e->getMessage();
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
                echo "<div class='noticia'>"
                . "<h3>$linha[2] - "
                . @date("d/m/Y", strtotime($linha[5]))
                . "<a href='?p=noticia/excluir&id=$linha[0]' title='excluir'>"
                . "<img src='../imagem/icone/remove.png'> "
                . "</a>"
                . "<a href='?p=noticia/editar&id=$linha[0]' title='editar'>"
                . "<img src='../imagem/icone/accept.png'>"
                . "</a>"
                . "</h3>"
                . "</div>"
                . "<br><br><br>"
                . $this->in->consultar($linha[0])
                . "<br><br><br><br><br><br><br><br><br>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar noticia " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $this->in->excluir($id);

            $sql = "DELETE FROM noticia WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (Exception $exc) {
            echo "erro ao excluir notícia " . $exc->getMessage();
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
        // $imagem - colocar a posição da imagem na table MySQL 8
        // $titulo - posição de campo da table MySQL que contenha titulo ou nome no caso o 2
        //conteudo 4
        //url da noticia 3
        //posição de data 5
        //Chave Primária 
        //Chave Estrangeira
        try {
            $this->p = new Paginar();
            $this->p->paginacao(2, $pg, $table1, $table2, $pasta, '75px', $link, 8, 2, 4, 3, 5, "id", "id_noticia");
            /*
              $numreg, $pg, $table1, $table2,
              $pasta, $px, $link, $imagem, $titulo, $conteudo, $url, $data,
              $pk,$fk
             * */
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
                echo "<div class='noticia'>
                    <h3>$linha[2] - " . @date("d/m/Y", strtotime($linha[5])) . "</h3>
                    $linha[4]
                    " . $this->in->visualizar($caminho, $linha[0]) . "
                </div>";
            }
        } catch (PDOException $e) {
            echo "Erro no visualizar notícia " . $e->getMessage();
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
