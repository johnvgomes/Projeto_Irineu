<?php

require_once 'Conectar.php';
require_once 'Controles.php';

class Oficina{
	
    private $titulo;
    private $conteudo;
    private $data;
    private $horario;
    private $eixo;
    private $controles;
    private $con;

    public function __construct($t="",$c="",$d="",$h="",$e=""){
        $this->titulo=$t;
        $this->conteudo=$c;
        $this->data=$d;
        $this->horario=$h;
        $this->eixo=$e;
        $this->controles = new Controles();
        $this->con = new Conectar();
    }

    public function getTitulo(){
        return $this->titulo;
    }
    public function getConteudo(){
        return $this->conteudo;
    }
    public function getData(){
        return $this->data;
    }
    public function getHorario(){
        return $this->horario;
    }
    public function getEixo(){
        return $this->eixo;
    }
    
    public function cadastrar(){      
        $this->con->executar("INSERT INTO oficina VALUES (null,
            '".$this->getTitulo()."',
            '".$this->getConteudo()."',
            '".$this->getData()."',
            '".$this->getHorario()."',
            '".$this->getEixo()."')");	
    }

    public function consultar(){
        $sql = $this->con->executar("SELECT * FROM oficina ORDER BY data DESC");
        echo "<table><tr><td colspan='2'><h3>Oficina do EPA-ETEC ".  date('Y')."</h3></td></tr>";
        while ($linhas = mysql_fetch_row($sql)){
            echo "
            <tr><td>T&iacute;tulo: ".$linhas[1]." | ".$linhas[3]."</td></tr>
            <tr><td>Conte&uacute;do: ".$linhas[2]."</td></tr>
            </td></tr>
            <tr>
                <td colspan='2'>
                <a href='?p=epa/excluir.php&id=".$linhas[0]."' target='_self'>[Excluir]</a>
                <a href='?p=epa/editar.php&id=".$linhas[0]."' target='_self'>[Editar]</a>
                <a href='?p=epa/editarArq.php&id=".$linhas[0]."' target='_self'>[Trocar eixo]</a>
                </td>
            </tr>
            <tr><td colspan='2'><hr /><br /></td></tr>
            ";
        }
        echo "</table>";
    }

    public function excluir($id){
            $this->con->executar("DELETE FROM oficina WHERE id = '$id'");
    }

    public function carregarID($id){
        $sql = $this->con->executar("SELECT * FROM oficina WHERE id = '$id'");
        while($linhas = mysql_fetch_row($sql)){
            return array($linhas[0],
            $linhas[1],$linhas[2],
            $linhas[3],$linhas[4],
            $linhas[5]);			
        }
    }

    public function editar($id,$titulo,$conteudo){
        $this->con->executar("UPDATE oficina SET titulo = '$titulo',
            conteudo = '$conteudo' WHERE id = '$id'");
    }
    
    public function editarEixo($id,$eixo){
        $this->con->executar("UPDATE oficina SET eixo = '$eixo'
                                        WHERE id = '$id'");
    }
   
   
    public function carregarOficina($eixo){
    $sql = $this->con->executar("SELECT * FROM oficina WHERE eixo = '$eixo'");
    echo "<table>"; 
    while ($l = mysql_fetch_row($sql)) {

        echo "
         <tr><td colspan='2'><strong>".$l[1]."</strong>| data em: ".$l[3]."</td></tr>
         <tr><td colspan='2'>".$l[2]."</td></tr>
         <tr><td>&nbsp;</td></tr>
         <tr><td>&nbsp;</td></tr>
         <tr><td><a href='?p=epa.php' target='_self' title='oficna'>...Voltar</a></td></tr>";
     }
     echo "</table>";
    }


    public function __destruct(){
        $this->titulo="";
        $this->conteudo="";
        $this->data="";
        $this->horario="";
        $this->eixo="";
        $this->controles = "";
        $this->con = "";
    }

}
