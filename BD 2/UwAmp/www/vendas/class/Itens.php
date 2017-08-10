<?php

include_once 'Conectar.php';

class Itens {

    private $id;
    private $preco;
    private $peso;
    private $quantidade;
    private $id_produto;
    private $id_venda;
    private $con;

    public function __construct($id = "", $preco = "", $peso = "", $quantidade = "", $id_produto = "", $id_venda = "") {
        $this->id = $id;
        $this->preco = $preco;
        $this->peso = $peso;
        $this->quantidade = $quantidade;
        $this->id_produto = $id_produto;
        $this->id_venda = $id_venda;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getId_produto() {
        return $this->id_produto;
    }

    public function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function getId_venda() {
        return $this->id_venda;
    }

    public function setId_venda($id_venda) {
        $this->id_venda = $id_venda;
    }

    public function exibirItens($idVenda) {
        try {
            $sql = "SELECT i.*, p.* FROM itens as i, produtos as p, vendas as v "
                    . "WHERE v.id=? AND i.id_produto = p.id AND i.id_venda = v.id ORDER BY i.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $idVenda, PDO::PARAM_INT);
            $sqlprep->execute();

            $str = '';
            $first = true;

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if (!$first) {
                    $str .= "&&";
                } else {
                    $first = false;
                }

                $str .= "/^^item==/^id=$linhas[0]$/"
                        . "&/^nome_produto=$linhas[7]$/"
                        . "&/^id_produto=$linhas[6]$/"
                        . "&/^preco=" . $this->mudaPreco($linhas[1]) . "$/"
                        . "&/^peso=" . $this->mudaPeso($linhas[2]) . "$/"
                        . "&/^quantidade=$linhas[3]$/$$/";
            }

            echo $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function mudaPreco($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function mudaPeso($valor) {
        return number_format($valor, 3, ',', '.') . ' kg';
    }

    public function __destruct() {
        $this->id = "";
        $this->preco = "";
        $this->peso = "";
        $this->quantidade = "";
        $this->id_produto = "";
        $this->id_venda = "";
        $this->con = "";
    }

}

?>
