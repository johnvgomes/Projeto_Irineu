<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Banner {

    private $id;
    private $titulo;
    private $imagem;
    private $tpimagem;
    private $link;
    private $destino;
    private $con;
    private $ct;

    public function __construct($id = "", $titulo = "", $imagem = "", $tpimagem = "", $link = "", $destino = "") {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->imagem = $imagem;
        $this->tpimagem = $tpimagem;
        $this->link = $link;
        $this->destino = $destino;
        $this->con = new Conectar();
        $this->ct = new Controles();
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

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function getDestino() {
        return $this->destino;
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }

    public function salvar() {
        try {
            //faremos o envio da foto na linha abaixo
            $this->ct->enviarArquivo($this->getTpimagem(), "../banner/img/" . $this->getImagem());

            //envio dos dados para a table MySQL
            $sql = "INSERT INTO banner VALUES (null,?,?,?,?);";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getTitulo(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getImagem(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getLink(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getDestino(), PDO::PARAM_STR);

            if ($prepsql->execute()) {
                echo "Cadastro de banner efetuado com sucesso";
            } else {
                echo "Falha ao cadastrar banner";
            }
        } catch (PDOException $exc) {
            echo "Erro no cadastrar banner " . $exc->getMessage();
        }
    }

    public function consultar($caminho) {
        try {
            $sql = "SELECT * FROM banner ORDER BY id DESC";

            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo "
                    <a href='$linha[3]' title='$linha[1]' target='$linha[4]'>
                    <img src='$caminho/banner/img/$linha[2]' alt='$linha[1]' title='$linha[1]'>     
                    </a>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar foto " . $exc->getMessage();
        }
    }

    public function consultarAdmin() {
        try {
            $sql = "SELECT * FROM banner";

            $res = $this->con->query($sql);

            echo "<br><br><div class='imagem'>";
            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo "
                    <div class='posicionar'>
                    <table>
                    <tr><th colspan='2'>
                        <a href='?p=banner/editarFoto&img=$linha[2]&id=$linha[0]' title='Alterar Banner'>
                            <img src='../banner/img/$linha[2]' alt='Alterar Banner'>
                        </a>
                    </th></tr>
                    <tr><td>
                        <a href='?p=banner/excluir&id=$linha[0]' title='Excluir Banner'>
                            <img src='../imagem/icone/remove.png' id='imagem'> 
                        </a>
                    </td><td>
                        <a href='?p=banner/editar&id=$linha[0]' title='Editar Informações'>
                            <img src='../imagem/icone/accept.png' id='imagem'> 
                        </a>
                    </td></tr>
                </table>
                </div>";
            }
            echo "</div>";
        } catch (PDOException $exc) {
            echo "Erro no consultar banner " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM banner WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar banner " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE banner SET titulo=?,link=?, destino=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getTitulo(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getLink(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getDestino(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo 'Noticia atualizada com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar registros de banner  " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $vetor = $this->carregar($id);
            $this->ct->excluirArquivo("../banner/img/" . $vetor[2]);

            $sql = "DELETE FROM banner WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo "Erro ao excluir o banner " . $exc->getMessage();
        }
    }

    public function editarFoto($id, $foto, $tempfoto, $fotoanterior) {
        try {
            $this->ct->excluirArquivo("../banner/img/" . $fotoanterior);
            $this->ct->enviarArquivo($tempfoto, "../banner/img/" . $foto);

            $sql = "UPDATE banner SET imagem=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $foto, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Banner atualizado com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar Banner  " . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->titulo = "";
        $this->imagem = "";
        $this->tpimagem = "";
        $this->link = "";
        $this->destino = "";
        $this->con = "";
        $this->ct = "";
    }

}
