<?php

require_once 'Controles.php';
require_once 'Conectar.php';
require_once 'Eixo.php';

class Banner{

    private $nome;
    private $arquivo;
    private $temp_arquivo;
    private $link;
    private $mostrar;
    private $eixo;
    private $controles;
    private $con;
	
    public function __construct($n="",$a="",$ta="",$l="",$m="",$e=""){
        $this->nome = $n;
        $this->arquivo = $a;
        $this->temp_arquivo = $ta;
        $this->link = $l;
        $this->mostrar = $m;
        $this->eixo = $e;
        $this->controles = new Controles;
        $this->con = new Conectar();
    }

    public function setArquivo($arquivo){
        $this->arquivo = $arquivo;
    }
    
    public function setTemp_arquivo($ta){
        $this->temp_arquivo = $ta;
    }
   
    public function getNome(){
        return $this->nome;
    }
    public function getArquivo(){
        return $this->arquivo;
    }
    public function getTemp_arquivo(){
        return $this->temp_arquivo;
    }
    public function getLink(){
        return $this->link;
    }
    public function getMostrar(){
        return $this->mostrar;
    }
    public function getEixo(){
        return $this->eixo;
    }

    public function cadastrar(){
        try{
            $this->controles->enviarArquivo($this->getTemp_arquivo(),"../banner/".$this->getArquivo());

            $this->con->executar("INSERT INTO banner VALUES (null,
                '".$this->getNome()."','".$this->getArquivo()."',
                '".$this->getLink()."','".$this->getMostrar()."',
                '".$this->getEixo()."')");
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function consultar(){
        try{
            $sql = $this->con->executar("SELECT * FROM banner");
            echo "<table><tr><td colspan='2'><h3>Banner - parceiros [coluna direita]</h3></td></tr>";
            while ($linhas = mysql_fetch_row($sql)){
                echo "
                <tr><td>ID - ".$linhas[0]." Nome: ".$linhas[1]."</td><td>Link: ".$linhas[3]."</td></tr>
                <tr><td>Imagem: </td>
                <td><img src=../banner/".$linhas[2]." border='0' width='75px' alt='".$linhas[1]."' /></td></tr>
                <tr>
                    <td colspan='2'>
                            <a href='?p=banner/excluir.php&id=".$linhas[0]."' target='_self'>[Excluir]</a>
                            <a href='?p=banner/editar.php&id=".$linhas[0]."' target='_self'>[Editar]</a>
                            <a href='?p=banner/editarArq.php&id=".$linhas[0]."&t=i' target='_self'>[Trocar Imagem]</a>
                            <a href='?p=banner/editarArq.php&id=".$linhas[0]."&t=e' target='_self'>[Alterar Eixo]</a>
                    </td>
                </tr>
                <tr><td colspan='2'><hr /><br /></td></tr>";
            }
            echo "</table>";
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function excluir($id){
        try{    
            $sql = $this->con->executar("SELECT * FROM banner WHERE id = '$id'");
            while($linhas = mysql_fetch_row($sql)){
                    $this->controles->excluirArquivo("../banner/".$linhas[2]);
            }
            $this->con->executar("DELETE FROM banner WHERE id = '$id'");
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function carregarID($id){
        try{
            $sql = $this->con->executar("SELECT * FROM banner WHERE id = '$id'");
            while($linhas = mysql_fetch_row($sql)){
                return array($linhas[0],
                $linhas[1],$linhas[2],
                $linhas[3],$linhas[4],
                $linhas[5]);				
            }
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function editar($id,$n,$l,$m){
        try{    
            $this->con->executar("UPDATE banner SET nome = '$n',
                link = '$l', mostrar = '$m' WHERE id = '$id'");
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function editarImagem($id, $imagem, $imagem_temp,$antigo){
        try{    
            $this->controles->excluirArquivo("../banner/".$antigo);
            $this->controles->enviarArquivo($imagem_temp,"../banner/".$imagem);
            $this->con->executar("UPDATE banner SET arquivo = '$imagem' WHERE id = '$id'");
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function editarEixo($id,$eixo){
        try{    
            $this->con->executar("UPDATE banner SET eixo = '$eixo' WHERE id = '$id'");
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function carregarBanner($tipo){
        try{
            if($tipo === "adm"){
                @$banner = "../banner/";
            }else{
                @$banner = "banner/";
            }
            $sql = $this->con->executar("SELECT * FROM banner ORDER BY nome");
            while($linhas = mysql_fetch_row($sql)){
                    echo "
                        <a href='".$linhas[3]."' target='_blank' title='".$linhas[1]."' >
                            <img src='".@$banner."".$linhas[2]."' alt='".$linhas[1]."' border='0' />
                        </a>";
            }
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function __destruct(){
        $this->controles = "";
        $this->eixo = "";
        $this->nome = "";
        $this->arquivo = "";
        $this->temp_arquivo = "";
        $this->link = "";
        $this->mostrar = "";
        $this->con = "";
    }
}
