<?php

/*
 * create table pagina(
 *     id int auto_increment primary key,
 *     titulo varchar(100),
 *     url varchar(100),
 *     link varchar(100),
 *     conteudo text
 *     );
 */
include_once 'Conectar.php';

class Pagina {

    //put your code here
    private $id;
    private $titulo;
    private $url;
    private $link;
    private $conteudo;
    private $con;

    public function __construct() {
        $this->con = new Conectar();
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

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function getConteudo() {
        return $this->conteudo;
    }

    public function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    public function salvar() {
        try {
            $sql = "INSERT INTO pagina VALUES (null,?,?,?,?)";
            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getTitulo(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getLink(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getConteudo(), PDO::PARAM_STR);

            $prepsql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

//fim salvar

    public function visualizar($caminho, $url, $tipo) {
        try {
            $sql = "SELECT * FROM pagina WHERE url = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $url, PDO::PARAM_STR);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {

                echo "<h3>$linha[1]</h3>";
                if ($tipo != "admin") {
                    echo "<div class='pgcurso'>"
                    . "<img src='" . $caminho . "imagem/calendario.png' 
                    alt='Calendário'>"
                    . "<h4>$linha[1]</h4>"
                    . "";
                }
                if (!$linha[3] == null) {
                    echo "<a href='$linha[3]' target='_blank'>Acesse aqui</a>";
                }
                if ($tipo == "admin") {
                    echo "<a href='?p=pagina/editar&id=$linha[0]' title='Editar Legenda'>
                            <img src='../imagem/icone/accept.png' id='imagem'> 
                        </a>";
                }
                echo $linha[4]
                . "</div>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregarSelect() {
        try {
            $sql = "SELECT * FROM pagina ORDER BY titulo";

            $sqlprep = $this->con->query($sql);

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$linha[2]'>$linha[1]</option>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

//fim consultar
    //carregar será útil para os métodos excluir, editar, editarimagem e editaricone
    public function carregar($id) {
        try {
            $sql = "SELECT * FROM pagina WHERE id = ?;";

            $this->con = new Conectar();
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linha;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE pagina SET titulo=?, url=?,  
                link=?, conteudo=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getTitulo(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getUrl(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getLink(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getConteudo(), PDO::PARAM_STR);
            $sqlprep->bindParam(5, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM pagina WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregarPDF($tipo) {
        try {
            $sql = "select * from pagina";
            $this->con = new Conectar();
            $r = $this->con->query($sql);

            if ($tipo == "adm") {
                include '../../pdf/mpdf.php';
            } else {
                include 'pdf/mpdf.php';
            }
            $pdf = new mPDF();

            $html = "<table>";

            while ($l = $r->fetch(PDO::FETCH_NUM)) {
                $html .= "<tr><td>$l[3]</td></tr>
                    <tr><td></td></tr>
                    <tr><td>&nbsp;</td></tr>";
            }

            $html .= "</table>";

            $pdf->WriteHTML($html);
            $pdf->Output();
            exit();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

//fim consultar

    public function __destruct() {
        $this->id = "";
        $this->url = "";
        $this->titulo = "";
        $this->conteudo = "";
        $this->icone = "";
        $this->con = "";
    }

}

?>
