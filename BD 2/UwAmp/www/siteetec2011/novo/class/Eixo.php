<?php

require_once 'Conectar.php';

class Eixo {
   
    private $eixo;
    private $con;

    public function __construct() {
        $this->con = new Conectar();
    }

    public function setEixo($eixo){
            $this->eixo = $eixo;
    }

    public function getEixo(){
            return $this->eixo;
    }

    public function cadastrar(){
        $this->con->executar("INSERT INTO eixo VALUES (null,'".$this->getEixo()."')");
    }

    public function consultar(){
        $sql = $this->con->executar("SELECT * FROM eixo");
        echo "<tr>
            <td><h3>Eixo</h3></td>
            <td>Excluir?</td>
            <td>Editar?</td>
        </tr>";
        while($linhas = mysql_fetch_row($sql)){
            echo "<tr>
                <td>".$linhas[1]."</td>
                <td>
                <a href=?p=eixo/excluir.php&id=".(int)$linhas[0]." starget=_self>[Excluir]</a>
                </td>
                <td>
                <a href=?p=eixo/editar.php&id=".(int)$linhas[0]." target=_self>[Editar]</a>
                </td>
            </tr>";
        }
    }

    public function carregarID($id){
        $sql = $this->con->executar("SELECT * FROM eixo WHERE id = '$id'");
        while($linhas = mysql_fetch_row($sql)){
                return array((int)$linhas[0],$linhas[1]);
        }
    }

    public function carregarEixo(){
        $sql = $this->con->executar("SELECT * FROM eixo ORDER BY eixo");
        echo "<option value='1'>Escolha o eixo</option>";
        while($linhas = mysql_fetch_row($sql)){
            echo "<option value=".(int)$linhas[0].">".$linhas[1]."</option>";
        }
    }

    public function editar($id,$eixo){
        $this->con->executar("UPDATE eixo SET eixo = '$eixo' WHERE id = '$id'");
    }

    public function excluir($id){
        $this->con->executar("DELETE FROM eixo WHERE id = '$id'");
    }
    
    public function __destruct() {
        $this->eixo="";
        $this->con="";
    }
}