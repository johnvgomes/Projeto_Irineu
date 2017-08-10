<?php

include_once 'Conectar.php';

class ImagemProduto {

    private $id;
    private $id_produto;
    private $nome;
    private $temp_nome;
    private $con;

    public function __construct() {
        $this->con = new Conectar();
    }
    public function getId() {
        return $this->id;
    }

    public function getId_produto() {
        return $this->id_produto;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTemp_nome() {
        return $this->temp_nome;
    }

    public function getCon() {
        return $this->con;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTemp_nome($temp_nome) {
        $this->temp_nome = $temp_nome;
    }

    public function setCon($con) {
        $this->con = $con;
    }

    

    public function salvar() {
        try {
            $sql = "SELECT id FROM produto ORDER BY id DESC LIMIT 1 ";
            $prepsql = $this->con->query($sql);

            if ($ultimo_id = $prepsql->fetch(PDO::FETCH_NUM)) {
                $sql = "INSERT INTO imagem_produto VALUES (null,?,?)";
                $prepsql = $this->con->prepare($sql);
                $prepsql->bindParam(2, $ultimo_id[0], PDO::PARAM_INT);
                @$prepsql->bindParam(1, $this->getNome(), PDO::PARAM_STR);
                $prepsql->execute();
            }
        } catch (PDOException $e) {
            echo "Erro no salvar imagens do produto " . $e->getMessage();
        }
    }
}

?>
