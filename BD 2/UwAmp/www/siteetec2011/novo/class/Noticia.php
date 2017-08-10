<?php

require_once 'Conectar.php';
require_once 'Controles.php';

class Noticia{
	
    private $titulo;
    private $conteudo;
    private $data;
    private $img;
    private $temp_img;
    private $eixo;
    private $legenda;
    private $controles;
    private $con;

    public function __construct($t="",$c="",$d="",$i="",$ti="",$e="",$l=""){
        $this->titulo=$t;
        $this->conteudo=$c;
        $this->data=$d;
        $this->img=$i;
        $this->temp_img=$ti;
        $this->eixo=$e;
        $this->legenda=$l;
        $this->controles = new Controles();
        $this->con = new Conectar();
    }
    
    public function setLegenda($l){
        $this->legenda = $l;
    }

    public function getLegenda(){
        return $this->legenda;
    }
    
    public function setImg($img){
        $this->img = $img;
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
    public function getImg(){
        return $this->img;
    }
    public function getTemp_img(){
        return $this->temp_img;
    }
    public function getEixo(){
        return $this->eixo;
    }
    
    public function cadastrar(){
        $this->controles->enviarArquivo($this->getTemp_img(),"../noticia/".$this->getImg());
        
        $this->con->executar("INSERT INTO noticia VALUES (null,
            '".$this->getTitulo()."',
            '".$this->getConteudo()."',
            '".$this->getData()."',
            '".$this->getImg()."',
            '".$this->getEixo()."',
            '".$this->getLegenda()."')");	
    }

    public function consultar(){
        $sql = $this->con->executar("SELECT * FROM noticia ORDER BY id DESC");
        echo "<table><tr><td colspan='2'><h3>Not&iacute;cias da ETEC</h3></td></tr>";
        while ($linhas = mysql_fetch_row($sql)){
            echo "
            <tr><td>T&iacute;tulo: ".$linhas[1]." | ".$linhas[3]."</td></tr>
            <tr><td>Conte&uacute;do: ".substr($linhas[2],0,200)."</td></tr>
            <tr><td><img src='../noticia/".$linhas[4]."' width='100px' height='75px' />
            </td></tr>
            <tr>
                <td colspan='2'>
                <a href='?p=noticia/excluir.php&id=".$linhas[0]."' target='_self'>[Excluir]</a>
                <a href='?p=noticia/editar.php&id=".$linhas[0]."' target='_self'>[Editar]</a>
                <a href='?p=noticia/editarArq.php&id=".$linhas[0]."&t=i' target='_self'>[Trocar Imagem]</a>
                <a href='?p=noticia/editarArq.php&id=".$linhas[0]."&t=e' target='_self'>[Trocar eixo]</a>
                </td>
            </tr>
            <tr><td colspan='2'><hr /><br /></td></tr>
            ";
        }
        echo "</table>";
    }

    public function excluir($id){
            $sql = $this->con->executar("SELECT * FROM noticia WHERE id = '$id'");
            while($linhas = mysql_fetch_row($sql)){
                    $this->controles->excluirArquivo("../noticia/".$linhas[4]);
            }
            $this->con->executar("DELETE FROM noticia WHERE id = '$id'");
    }

    public function carregarID($id){
        $sql = $this->con->executar("SELECT * FROM noticia WHERE id = '$id'");
        while($linhas = mysql_fetch_row($sql)){
            return array($linhas[0],
            $linhas[1],$linhas[2],
            $linhas[3],$linhas[4],
            $linhas[5]);			
        }
    }

    public function editar($id,$titulo,$conteudo){
        $this->con->executar("UPDATE noticia SET titulo = '$titulo',
            conteudo = '$conteudo' WHERE id = '$id'");
    }
    
    public function editarImagem($id, $arquivo, $arquivo_temp,$antigo){
        $this->controles->excluirArquivo("../noticia/".$antigo);
        $this->controles->enviarArquivo($arquivo_temp,"../noticia/".$arquivo);

        $this->con->executar("UPDATE noticia SET imagem = '$arquivo'
                                        WHERE id = '$id'");
    }

    public function editarEixo($id,$eixo){
        $this->con->executar("UPDATE noticia SET eixo = '$eixo'
                                        WHERE id = '$id'");
    }
   
    public function carregarIndex(){
        
        $sql = $this->con->executar("SELECT * FROM noticia ORDER BY id DESC LIMIT 0 , 4");
        
        while (list($i,$titulo,$conteudo,$data,$img,$eixo,$legenda) = mysql_fetch_array($sql)) {
            echo '
                <div class="box_esq">
                    <div class="tit_box_esq">
                        '.$titulo.'
                    </div>
                    <div class="content_esq">
                        <table>
                        <tr><td>
                        <img src="http://www.etecitu.com.br/noticia/'. $img .'" alt="'.$titulo.'" width="100px" height="75px" border="0" />
                        </td><td>
                        <a href="'.URL::getBase().'abrir/'.$legenda.'" target="_self" title="'.$titulo.'">
                            Publicado em: '.$data.'<br />'.
                            substr($conteudo,0,150).'
                        </a> 
                        </td></tr></table>
                    </div>
                </div>
            ';
        }
    }

    public function carregarNoticia($entrada,$tipo){
    $noticia = "http://www.etecitu.com.br/noticia";

    $sql = $this->con->executar("SELECT * FROM noticia WHERE legenda = '$entrada'");
    echo "<table>"; 
    while ($l = mysql_fetch_row($sql)) {

        echo "
         <tr><td colspan='2'><strong>".$l[1]."</strong>| publicado em: ".$l[3]."</td></tr>
         <tr><td colspan='2'>
            <img src='".$noticia.'/'.$l[4]."' border='0' width='500px' border='0' /></td></tr>
         <tr><td colspan='2'>".$l[2]."</td></tr>
         <tr><td>       
         
         <div class='fb-like' data-href='http://www.etecitu.com.br/novo/abrir/".$l[6]."' data-width='30' data-layout='standard' data-action='like' data-show-faces='true' data-share='true'></div>

</td></tr>
            

         <tr><td>&nbsp;</td></tr>
         <tr><td>&nbsp;</td></tr>
         
         <tr><td><a href='".URL::getBase()."home' target='_self' title='noticia'>...Voltar</a></td></tr>";
     }
     echo "</table>";
    }

    public function mostrar($pagina,$tipo){
        $noticia = "http://www.etecitu.com.br/noticia/";
 
        echo "<br /><table>";
        $this->controles->paginacao(4,$pagina,"noticia","id",$noticia,$tipo);
    }
    
     public function mostrar2($pagina,$tipo,$local){
        if($tipo === "adm"){
            $noticia = "../noticia/";
        }else{
             $noticia = "noticia/";
        }
        $this->controles->paginacao2(4,$tipo,"noticia",$local);
    }

    public function __destruct(){
        $this->titulo="";
        $this->conteudo="";
        $this->data="";
        $this->img="";
        $this->temp_img="";
        $this->eixo="";
        $this->controles = "";
        $this->con = "";
    }

}
