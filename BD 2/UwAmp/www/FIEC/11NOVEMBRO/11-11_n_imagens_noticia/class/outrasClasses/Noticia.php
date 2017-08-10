<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Noticia {

    private $id;
    private $data;
    private $titulo;
    private $url;
    private $conteudo;
    private $imagem;
    private $tempimagem;
    private $id_marca;
    private $con;
    private $ct;

    public function __construct($id, $data, $titulo, $url, $conteudo, $imagem, $tempimagem, $id_marca) {
        $this->id = $id;
        $this->data = $data;
        $this->titulo = $titulo;
        $this->url = $url;
        $this->conteudo = $conteudo;
        $this->imagem = $imagem;
        $this->tempimagem = $tempimagem;
        $this->id_marca = $id_marca;
        $this->con = new Conectar();
        $this->ct = new Controles();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
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

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function getTempimagem() {
        return $this->tempimagem;
    }

    public function setTempimagem($tempimagem) {
        $this->tempimagem = $tempimagem;
    }

    public function getId_marca() {
        return $this->id_marca;
    }

    public function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }

    public function salvar() {
        try {
            $this->ct->enviarArquivo($this->getTempimagem(), "../imagem_noticia/" . $this->getImagem());

            $sql = "INSERT INTO noticia VALUES (null,?,?,?,?,?,?)";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getData(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getTitulo(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getConteudo(), PDO::PARAM_STR);
            $prepsql->bindParam(5, $this->getImagem(), PDO::PARAM_STR);
            $prepsql->bindParam(6, $this->getId_marca(), PDO::PARAM_INT);

            $prepsql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function consultar($tipo) {
        try {
            $sql = "SELECT n.id, n.titulo, 
                n.conteudo, n.imagem, 
                ma.marca, ma.origem
                FROM noticia as n, marca as ma 
                WHERE n.id_marca=ma.id 
                ORDER BY n.titulo";

            $res = $this->con->query($sql);

            echo '<table border="1">
                <tr>
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Conteudo</td>
                    <td>Imagem</td>
                    <td>Marca</td>
                    <td>Origem</td>';
            if ($tipo == "adm") {
                echo '<td>[excluir]</td>
                    <td>[alterar]</td>
                    <td>[alterar imagem]</td>';
            }
            echo '</tr>';

            while ($linhas = $res->fetch(PDO::FETCH_NUM)) {
                echo "
                <tr>
                    <td>$linhas[0]</td>
                    <td>$linhas[1]</td>
                    <td>$linhas[2]</td>
                    <td><img src=../imagem_noticia/$linhas[3] 
                        width=100 /></td>
                    <td>$linhas[4]</td>
                    <td>$linhas[5]</td>";

                if ($tipo == "adm") {
                    echo "<td><a href='?p=noticia/excluir&id=$linhas[0]'>[excluir]
                    </a></td>
                    <td><a href='?p=noticia/editar&id=$linhas[0]'>[editar]
                    </a></td>
                    <td><a href='?p=noticia/editarImagem&id=$linhas[0]'>[editar foto]
                    </a></td>";
                }

                echo "</tr>";
            }
            echo '</table>';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function pesquisarData($datainicial, $datafinal, $tipo) {
        try {
            $sql = "SELECT n.id, n.titulo, n.data,
                n.conteudo, n.imagem,
                ma.marca, ma.origem
                FROM noticia as n, marca as ma
                WHERE n.id_marca=ma.id AND
                n.data BETWEEN ? AND ?
                ORDER BY n.titulo";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $datainicial, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $datafinal, PDO::PARAM_STR);
            $sqlprep->execute();

            echo "<table><tr>";

            if ($tipo == "adm") {
                echo "<td colspan='7'>";
            } else {
                echo "<td colspan='4'>";
            }

            echo "<h3>Noticia(s) entre " .
            date('d/m/Y', strtotime($datainicial)) . " e " .
            date('d/m/Y', strtotime($datafinal)) . "
                    </h3></td></tr>";

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "
                  <tr>
                  <td><img src=../imagem_noticia/$linha[4]
                      width=100px alt=$linha[4] />
                    </td>
                    <td>$linha[1]</td>
                    <td>" . date('d/m/Y', strtotime($linha[2])) . "</td>
                    <td>$linha[3]</td>
                ";

                if ($tipo == "adm") {
                    echo "<td><a href='?p=noticia/excluir&id=$linhas[0]'>[excluir]
                    </a></td>
                    <td><a href='?p=noticia/editar&id=$linhas[0]'>[editar]
                    </a></td>
                    <td><a href='?p=noticia/editarImagem&id=$linhas[0]'>[editar foto]
                    </a></td>";
                }

                echo "</tr>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->data = "";
        $this->titulo = "";
        $this->url = "";
        $this->conteudo = "";
        $this->imagem = "";
        $this->tempimagem = "";
        $this->id_marca = "";
        $this->con = "";
        $this->ct = "";
    }

}

?>
