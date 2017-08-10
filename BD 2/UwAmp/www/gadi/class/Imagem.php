<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Imagem {

    private $id;
    private $id_produto;
    private $nome;
    private $temp_nome;
    private $con;
    private $ct;

    public function __construct($id = "", $id_produto = "", $nome = "", $temp_nome = "") {
        $this->id = $id;
        $this->id_produto = $id_produto;
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

    public function getId_produto() {
        return $this->id_produto;
    }

    public function setId_noticia($id_produto) {
        $this->id_produto = $id_produto;
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
            $sql = "SELECT id FROM produto ORDER BY id DESC LIMIT 1 ";
            $prepsql = $this->con->query($sql);

            if ($ultimo_id = $prepsql->fetch(PDO::FETCH_NUM)) {
                $sql = "INSERT INTO imagem VALUES (null,?,?)";
                $prepsql = $this->con->prepare($sql);
                $prepsql->bindParam(1, $ultimo_id[0], PDO::PARAM_INT);
                $prepsql->bindParam(2, $this->getNome(), PDO::PARAM_STR);
                $prepsql->execute();
            }
        } catch (PDOException $e) {
            echo "Erro no salvar imagens " . $e->getMessage();
        }
    }

    public function visualizarAdmin($id_produto) {
        try {
            $sql = "SELECT * FROM 
            imagem WHERE id_produto = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id_produto, PDO::PARAM_INT);
            $sqlprep->execute();

            echo "<br><br><div class='imagem'>";
            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<a href='?p=imagem/trocarimagem&img=$linha[2]&id=$linha[0]' title='$linha[2]'>
                        <img src='../imagem_produto/$linha[2]' alt='$linha[2]'>
                    </a>
                ";
            }
            echo "</div>";
        } catch (PDOException $e) {
            echo "Erro no visualizar imagem produto " . $e->getMessage();
        }
    }

    public function editarImagem($id, $novo, $temporario, $anterior) {
        try {
            //excluir arquivo anterior na pasta
            $this->ct->excluirArquivo("../imagem_produto/" . $anterior);

            //inserir novo arquivo na pasta
            $this->ct->enviarArquivo($temporario, "../imagem_produto/" . $novo);

            //atualizar registro na table MySQL
            $sql = "UPDATE imagem SET nome=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $novo, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $e) {
            echo "Erro no editar imagem de produto " . $e->getMessage();
        }
    }

    public function excluir($id_produto) {
        try {
            $sql = "SELECT * FROM 
                imagem WHERE id_produto = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id_produto, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                $this->ct->excluirArquivo("../imagem_produto/" . $linha[2]);
            }

            $sql = "DELETE FROM imagem WHERE id_produto=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id_produto, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $e) {
            echo "Erro no excluir imagem produto " . $e->getMessage();
        }
    }

}

?>
