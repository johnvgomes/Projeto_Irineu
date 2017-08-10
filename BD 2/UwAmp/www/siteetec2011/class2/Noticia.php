<?php
header('Content-type: text/html; charset=utf-8');
require_once 'Conectar.php';
require_once 'Controles.php';
require_once 'Entity.php';

class Noticia extends Entity{
	
    private $titulo;
    private $conteudo;
    private $data;
    private $img;
    private $temp_img;
    private $eixo;
    private $controles;
    private $con;

    public function __construct($t="",$c="",$d="",$i="",$ti="",$e=""){
        $this->titulo=$t;
        $this->conteudo=$c;
        $this->data=$d;
        $this->img=$i;
        $this->temp_img=$ti;
        $this->eixo=$e;
        $this->controles = new Controles();
        $this->con = new Conectar();
    }
    
    public function cadastrar(){
        $this->controles->enviarArquivo($this->getTemp_img(),"../noticia/".$this->getImg());
        
        $this->con->executar("INSERT INTO noticia VALUES (null,
            '".$this->getTitulo()."',
            '".$this->getConteudo()."',
            '".$this->getData()."',
            '".$this->getImg()."',
            '".$this->getEixo()."')");	
    }

    public function consultar(){
        $sql = $this->con->executar("SELECT * FROM noticia ORDER BY data DESC");
        echo "<table><tr><td colspan='2'><h3>Not&iacute;cias da ETEC</h3></td></tr>";
        while ($linhas = mysql_fetch_row($sql)){
            echo "
            <tr><td>T&iacute;tulo: ".$linhas[1]." | ".$linhas[3]."</td></tr>
            <tr><td>Conte&uacute;do: ".$linhas[2]."</td></tr>
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
   
    public function carregarIndex($tipo){
        if($tipo === "adm"){
            $noticia = "../noticia";
            $link = "noticia/";
        }else{
             $noticia = "noticia";
             $link="";
        } 
        $sql = $this->con->executar("SELECT * FROM noticia ORDER BY id DESC LIMIT 0 , 6");
        
        while (list($i,$titulo,$conteudo,$data,$img) = mysql_fetch_array($sql)) {
            echo '
                <div class="box_esq">
                    <div class="tit_box_esq">
                        '.$titulo.'
                    </div>
                    <div class="content_esq">
                        <table>
                        <tr><td>
                        <img src="'.$noticia.'/'. $img .'" alt="'.$titulo.'" width="100px" height="75px" border="0" />
                        </td><td>
                        <a href="?p='.$link.'abrir.php&id='.$i.'" target="_self" title="'.$titulo.'">
                            Publicado em: '.$data.'<br />'.
                            substr($conteudo,0,150).'
                        </a> 
                        </td></tr></table>
                    </div>
                </div>
            ';
        }
    }

    public function carregarNoticia($id,$tipo){
         if($tipo === "adm"){
            $noticia = "../noticia";
        }else{
             $noticia = "noticia";
        }
    $sql = $this->con->executar("SELECT * FROM noticia WHERE id = '$id'");
    echo "<table>"; 
    while ($l = mysql_fetch_row($sql)) {

        echo "
         <tr><td colspan='2'><strong>".$l[1]."</strong>| publicado em: ".$l[3]."</td></tr>
         <tr><td colspan='2'>
            <img src='".$noticia.'/'.$l[4]."' border='0' width='500px' border='0' /></td></tr>
         <tr><td colspan='2'>".$l[2]."</td></tr>
         <tr><td>&nbsp;</td></tr>
         <tr><td>&nbsp;</td></tr>
         <tr><td><a href='?p=home.php' target='_self' title='noticia'>...Voltar</a></td></tr>";
     }
     echo "</table>";
    }

    public function mostrar($pagina,$tipo){
        if($tipo === "adm"){
            $noticia = "../noticia/";
        }else{
             $noticia = "noticia/";
        }
        echo "<br /><table>";
        $this->controles->paginacao(4,$pagina,"noticia","id",$noticia,$tipo);
    }
    
     public function mostrar2($pagina,$tipo){
        if($tipo === "adm"){
            $noticia = "../noticia/";
        }else{
             $noticia = "noticia/";
        }
        $this->controles->paginacao2(4,$tipo,"noticia");
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
