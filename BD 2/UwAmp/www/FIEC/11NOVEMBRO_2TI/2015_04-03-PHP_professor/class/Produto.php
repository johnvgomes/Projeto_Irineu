<?php


class Produto {
    private $id;
    private $descricao;
    private $valor;
    private $qtde;
    
    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getQtde() {
        return $this->qtde;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setQtde($qtde) {
        $this->qtde = $qtde;
    }


    
}
