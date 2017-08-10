<?php

/*
 * create table imagem_noticia(
 * id int auto_increment,
 * id_noticia int,
  nome varchar(100),
 * primary key (id,id_noticia)
 * );
 */

include_once 'Conectar.php';
include_once 'Controles.php';

class ImagemNoticia {

    private $id;
    private $id_noticia;
    private $nome;
    private $temp_nome;
    private $con;
    private $ct;

    public function __construct($id = "", $id_noticia = "", $nome = "", $temp_nome = "") {
        $this->id = $id;
        $this->id_noticia = $id_noticia;
        $this->nome = $nome;
        $this->temp_nome = $temp_nome;
        $this->con = new Conectar();
        $this->ct = new Controles();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId_noticia() {
        return $this->id_noticia;
    }

    public function setId_noticia($id_noticia) {
        $this->id_noticia = $id_noticia;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTemp_nome() {
        return $this->temp_nome;
    }

    public function setTemp_nome($temp_nome) {
        $this->temp_nome = $temp_nome;
    }

    public function salvar() {
        try {
            $sql = "SELECT id FROM noticia ORDER BY id DESC LIMIT 1 ";
            $prepsql = $this->con->query($sql);

            if ($ultimo_id = $prepsql->fetch(PDO::FETCH_NUM)) {
                $sql = "INSERT INTO imagem_noticia VALUES (null,?,?)";
                $prepsql = $this->con->prepare($sql);
                $prepsql->bindParam(1, $ultimo_id[0], PDO::PARAM_INT);
                $prepsql->bindParam(2, $this->getNome(), PDO::PARAM_STR);
                $prepsql->execute();
            }
        } catch (PDOException $e) {
            echo "Erro no salvar imagens de notícia " . $e->getMessage();
        }
    }

    public function consultar($id_noticia) {
        try {
            $sql = "SELECT * FROM 
            imagem_noticia WHERE id_noticia = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id_noticia, PDO::PARAM_INT);
            $sqlprep->execute();

            echo "<div class='imagem'>";
            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<a href='?p=noticia/trocarimagem"
                . "&img=$linha[2]"
                . "&id=$linha[0]' "
                . "title='$linha[2]'>"
                . "<img src='../imagem_noticia/$linha[2]' "
                . "alt='$linha[2]'>"
                . "</a>";
            }
            echo "</div>";
        } catch (PDOException $e) {
            echo "Erro no visualizar imagem notícia " . $e->getMessage();
        }
    }

    public function excluir($id_noticia) {
        try {
            $sql = "SELECT * FROM imagem_noticia "
                    . "WHERE id_noticia = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id_noticia, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                $this->ct->excluirArquivo("../imagem_noticia/" . $linha[2]);
            }

            $sql = "DELETE FROM imagem_noticia WHERE id_noticia = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id_noticia, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo "Erro ao excluir imagem " . $exc->getMessage();
        }
    }

    public function editarImagem($id, $novo, $temporario, $anterior) {
        try {
            //excluir imagem do server
            $this->ct->excluirArquivo("../imagem_noticia/" . $anterior);

            //inserir nova imagem no server
            $this->ct->enviarArquivo($temporario, "../imagem_noticia/" . $novo);

            //atualizar referencia da imagem na table imagem_noticia MySQL
            $sql = "UPDATE imagem_noticia SET nome = ? WHERE id = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $novo, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);
            $sqlprep->execute();
            
        } catch (Exception $exc) {
            echo "Erro ao atualizar imagem " . $exc->getMessage();
        }
    }
    
    public function visualizar($caminho, $id_noticia) {
        try {
            $sql = "SELECT * FROM 
            imagem_noticia WHERE id_noticia = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id_noticia, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='imagem'>
                    <a href='$caminho" . "imagem_noticia/$linha[2]' rel='lightbox' title='$linha[2]'>
                    <img src='$caminho/imagem_noticia/$linha[2]' alt='$linha[2]'>
                    </a>
                </div>";
            }
        } catch (PDOException $e) {
            echo "Erro no visualizar imagem notícia " . $e->getMessage();
        }
    }

}

?>
