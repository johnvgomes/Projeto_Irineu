<?php
include_once 'Controles.php';
include_once 'Conectar.php';

class Conta{
    
    private $id;
    private $mes;
    private $ano;
    private $tipo;
    private $arquivo;
    private $temp_arquivo;
    private $controles;
    private $con;
	
    public function __construct($m="",$a="",$t="",$arq="",$ta=""){
        $this->mes = $m;
        $this->ano = $a;
        $this->tipo = $t;
        $this->arquivo = $arq;
        $this->temp_arquivo = $ta;
        $this->controles = new Controles;
        $this->con = new Conectar();
    }

    public function setArquivo($arquivo){
        $this->arquivo = $arquivo;
    }
    
    public function getAno(){
        return $this->ano;
    }
    public function getMes(){
        return $this->mes;
    }
    public function getArquivo(){
        return $this->arquivo;
    }
    public function getTemp_arquivo(){
        return $this->temp_arquivo;
    }
    public function getTipo(){
        return $this->tipo;
    }

    public function cadastrar(){
    $this->controles->enviarArquivo($this->getTemp_arquivo(),"../conta/".$this->getArquivo());
  
    $this->con->executar("INSERT INTO conta VALUES (null,
            '".$this->getMes()."','".$this->getAno()."',
            '".$this->getTipo()."','".$this->getArquivo()."')");
    }

    public function consultar($tipo, $ano, $mes){
        $sql = $this->con->executar("SELECT * FROM conta 
            WHERE mes='$mes' AND ano='$ano' AND tipo='$tipo'");
        
        echo "<table>
            <tr>
                <td colspan='2'>
                    <h3>ETEC Itu - $tipo $mes/$ano</h3>
                </td>
            </tr>";
        if($linhas = mysql_fetch_row($sql)){
            echo "
            <tr>
                <td>Para visualizar: </td>
                <td>
                    <a href='http://www.etecitu.com.br/conta/".$linhas[4]."' target='_blank' title='".$linhas[3]."'>Clique aqui</a>
                </td>
            </tr>
            <tr><td colspan='2'><hr /><br /></td></tr>";
        }else{
            echo "<tr><td colspan='2'>Não encontrado</td></tr>";
        }
        echo "</table>";
    }
    
     public function consultarAdm(){
        $sql = $this->con->executar("SELECT * FROM conta ORDER BY
            mes, ano, tipo ");
        
        echo "<table>
            <tr>
                <td colspan='2'>
                    <h3>Contas ETEC Itu</h3>
                </td>
            </tr>";
        while($linhas = mysql_fetch_row($sql)){
            echo "
            <tr><td>Conta: </td><td>".$linhas[1]."/".$linhas[2]." - ".$linhas[3]."</td></tr>
            
            <tr>
                <td>Para visualizar: </td>
                <td>
                    <a href='http://www.etecitu.com.br/conta/".$linhas[4]."' target='_blank' title='".$linhas[3]."'>Clique aqui</a>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <a href='?p=conta/excluir.php&id=".$linhas[0]."' target='_self'>[Excluir]</a>
                </td>
            </tr>
            <tr><td colspan='2'><hr /><br /></td></tr>";
        }
        echo "</table>";
    }


    public function excluir($id){
            $sql = $this->con->executar("SELECT * FROM conta WHERE id = '$id'");
            while($linhas = mysql_fetch_row($sql)){
                    $this->controles->excluirArquivo("../conta/".$linhas[3]);
            }
            $this->con->executar("DELETE FROM conta WHERE id = '$id'");
    }

    public function __destruct(){
        $this->mes = "";
        $this->ano = "";
        $this->tipo = "";
        $this->arquivo = "";
        $this->temp_arquivo = "";
        $this->controles = "";
        $this->con = "";
    }
}
