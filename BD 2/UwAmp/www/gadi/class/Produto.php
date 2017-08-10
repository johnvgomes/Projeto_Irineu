<?php

include_once 'Conectar.php';
include_once 'Imagem.php';

class Produto {

    private $id;
    private $id_categoria;
    private $descricao;
    private $url;
    private $dados;
    private $tipo;
    private $con;
    private $in;

    public function __construct($id = "", $id_categoria = "", $descricao = "", $url = "", $dados = "", $tipo = "") {
        $this->id = $id;
        $this->id_categoria = $id_categoria;
        $this->descricao = $descricao;
        $this->url = $url;
        $this->dados = $dados;
        $this->tipo = $tipo;
        $this->con = new Conectar();
        $this->in = new Imagem();
    }

    public function getId() {
        return $this->id;
    }

    public function getId_categoria() {
        return $this->id_categoria;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getDados() {
        return $this->dados;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setDados($dados) {
        $this->dados = $dados;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function salvar() {
        try {

            $sql = "INSERT INTO produto VALUES (null,?,?,?,?,?)";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getId_categoria(), PDO::PARAM_INT);
            $prepsql->bindParam(2, $this->getDescricao(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getDados(), PDO::PARAM_STR);
            $prepsql->bindParam(5, $this->getTipo(), PDO::PARAM_STR);

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
        //url da produto
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
            produto as n WHERE n.url = ?";

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

    public function consultar() {
        try {

            $sql = "SELECT * FROM produto 
                    WHERE id_categoria = ? ";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_categoria(), PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='noticia'>
                    <h3>$linha[2]</h3>
                        <a href='?p=produto/excluir&id=$linha[0]' title='excluir'>
                        <img src='../imagem/icone/remove.png'>  
                        </a>
                        <a href='?p=produto/editar&id=$linha[0]' title='editar'>
                        <img src='../imagem/icone/accept.png'>
                        </a>
                    <br><br><hr>
                    </div>
                
                    " . $this->in->visualizarAdmin($linha[0])
                . "";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar produto " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT n.*, e.*
                FROM produto as n, categoria as e
                WHERE n.id=? AND n.id_categoria = e.id";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar produto " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE produto SET id_categoria=?,descricao=?,url=?,dados=?,
                tipo=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_categoria(), PDO::PARAM_INT);
            $sqlprep->bindParam(2, $this->getDescricao(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getUrl(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getDados(), PDO::PARAM_STR);
            $sqlprep->bindParam(5, $this->getTipo(), PDO::PARAM_STR);
            $sqlprep->bindParam(6, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo 'Noticia atualizada com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar registros de produto  " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {

            $this->in->excluir($id);

            $sql = "DELETE FROM produto WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultarTitulo() {

        try {

            $sql = "select url from produto";

            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo utf8_encode('"' . $linha[0] . '", ');
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar de produto " . $exc->getMessage();
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
