<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Foto {

    private $id;
    private $nome;
    private $tpnome;
    private $url;
    private $legenda;
    private $con;
    private $ct;

    public function __construct($id = "", $nome = "", $tpnome = "", $url = "", $legenda = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->tpnome = $tpnome;
        $this->url = $url;
        $this->legenda = $legenda;
        $this->con = new Conectar();
        $this->ct = new Controles();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTpnome() {
        return $this->tpnome;
    }

    public function setTpnome($tpnome) {
        $this->tpnome = $tpnome;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getLegenda() {
        return $this->legenda;
    }

    public function setLegenda($legenda) {
        $this->legenda = $legenda;
    }

    public function salvar() {
        try {
            //faremos o envio da foto na linha abaixo
            $this->ct->enviarArquivo($this->getTpnome(), "../foto-etec/" . $this->getNome());

            //envio dos dados para a table MySQL
            $sql = "INSERT INTO foto VALUES (null,?,?,?);";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getLegenda(), PDO::PARAM_STR);

            if ($prepsql->execute()) {
                echo "Cadastro de foto efetuado com sucesso";
            } else {
                echo "Falha ao cadastrar foto";
            }
        } catch (PDOException $exc) {
            echo "Erro no cadastrar foto " . $exc->getMessage();
        }
    }

    public function consultar($caminho) {
        try {
            $sql = "SELECT * FROM foto ORDER BY legenda";

            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo "
                    <div class='pgfoto'>
                    <a href='$caminho" . "foto-etec/$linha[1]' rel='lightbox' title='$linha[1]'>
                    <img src='$caminho/foto-etec/$linha[1]' alt='$linha[1]'>
                    $linha[3]
                    </a>
                </div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar foto " . $exc->getMessage();
        }
    }

    public function consultarAdmin() {
        try {
            $sql = "SELECT * FROM foto";

            $res = $this->con->query($sql);

            echo "<br><br><div class='imagem'>";
            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo "
                    <div class='posicionar'>
                    <table>
                    <tr><th colspan='2'>
                        <a href='?p=foto/editarFoto&img=$linha[1]&id=$linha[0]' title='Alterar Foto'>
                            <img src='../foto-etec/$linha[1]' alt='Alterar Foto'>
                        </a>
                    </th></tr>
                    <tr><td>
                        <a href='?p=foto/excluir&id=$linha[0]' title='Excluir Foto'>
                            <img src='../imagem/icone/remove.png' id='imagem'> 
                        </a>
                    </td><td>
                        <a href='?p=foto/editar&id=$linha[0]' title='Editar Legenda'>
                            <img src='../imagem/icone/accept.png' id='imagem'> 
                        </a>
                    </td></tr>
                </table>
                </div>";
            }
            echo "</div>";
        } catch (PDOException $exc) {
            echo "Erro no consultar foto " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM foto WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar foto " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE foto SET legenda=?,url=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getLegenda(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getUrl(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo 'Noticia atualizada com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar registros de foto  " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $foto = $this->carregar($id);
            $this->ct->excluirArquivo("../foto-etec/" . $foto[1]);

            $sql = "DELETE FROM foto WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo "Erro ao excluir a foto " . $exc->getMessage();
        }
    }

    public function editarFoto($id, $foto, $tempfoto, $fotoanterior) {
        try {
            $this->ct->excluirArquivo("../foto-etec/" . $fotoanterior);
            $this->ct->enviarArquivo($tempfoto, "../foto-etec/" . $foto);

            $sql = "UPDATE foto SET nome=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $foto, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Foto atualizada com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar foto  " . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->tpnome = "";
        $this->url = "";
        $this->legenda = "";
        $this->con = "";
        $this->ct = "";
    }

}
