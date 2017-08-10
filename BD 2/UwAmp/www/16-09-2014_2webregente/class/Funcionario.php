<?php

class Funcionario {

    //put your code here
    //atributos - caracteristicas
    private $id;
    private $nome;
    private $endereco;
    private $salarioBruto;
    private $inss;
    private $ir;
    private $numeroFilhos;
    private $bonus;
    private $salarioLiquido;

    public function __construct($id="", $nome="", 
            $endereco="", $salarioBruto="", $inss="", 
            $ir="", $numeroFilhos="", $bonus="", 
            $salarioLiquido="") {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->salarioBruto = $salarioBruto;
        $this->inss = $inss;
        $this->ir = $ir;
        $this->numeroFilhos = $numeroFilhos;
        $this->bonus = $bonus;
        $this->salarioLiquido = $salarioLiquido;
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

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getSalarioBruto() {
        return $this->salarioBruto;
    }

    public function setSalarioBruto($salarioBruto) {
        $this->salarioBruto = $salarioBruto;
    }

    public function getInss() {
        return $this->inss;
    }

    public function setInss($inss) {
        $this->inss = $inss;
    }

    public function getIr() {
        return $this->ir;
    }

    public function setIr($ir) {
        $this->ir = $ir;
    }

    public function getNumeroFilhos() {
        return $this->numeroFilhos;
    }

    public function setNumeroFilhos($numeroFilhos) {
        $this->numeroFilhos = $numeroFilhos;
    }

    public function getBonus() {
        return $this->bonus;
    }

    public function setBonus($bonus) {
        $this->bonus = $bonus;
    }

    public function getSalarioLiquido() {
        return $this->salarioLiquido;
    }

    public function setSalarioLiquido($salarioLiquido) {
        $this->salarioLiquido = $salarioLiquido;
    }

     public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->endereco = "";
        $this->salarioBruto = "";
        $this->inss = "";
        $this->ir = "";
        $this->numeroFilhos = "";
        $this->bonus = "";
        $this->salarioLiquido = "";
    }
    
    /*
     * método - ação para INSS
     * if salarioBruto < 1000 inss = 7.5%
     * if salarioBruto >= 1000 e < 2000 inss = 9%
     * else inss = 11%
     */
    public function calcularINSS(){
        if($this->getSalarioBruto() < 1000){
            $this->setInss
                    ($this->getSalarioBruto()*0.075);
        }else if($this->getSalarioBruto() >= 1000 
                && $this->getSalarioBruto() < 2000){
             $this->setInss
                    ($this->getSalarioBruto()*0.09);
        }else{
            $this->setInss
                    ($this->getSalarioBruto()*0.11);
        }
    }//fim método calcularINSS
    
    /*
     * método calcularIR
     * if salarioBruto < 1500 ir = 0
     * else if salarioBruto >= 1500 e < 4000 ir = 7%
     * else ir = 11.5%
     */
    
    public function calcularIR(){
        if($this->getSalarioBruto() < 1500){
            $this->setIr(0);
        }else if($this->getSalarioBruto() >= 1500
                && $this->getSalarioBruto() < 4000){
            $this->setIr($this->getSalarioBruto()*0.07);
        }else{
            $this->setIr($this->getSalarioBruto()*0.115);
        }
    }//fim calcularIR
    
    
    
    
    
    
}

?>
