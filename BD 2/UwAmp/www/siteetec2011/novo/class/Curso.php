<?php

require_once 'Controles.php';
require_once 'Conectar.php';
require_once 'Eixo.php';

class Curso{

    private $nome;
    private $descricao;
    private $matriz;
    private $temp_matriz;
    private $plano;
    private $temp_plano;
    private $img;
    private $temp_img;
    private $eixo;
    private $controles;
    private $con;
	
    public function __construct($n="",$d="",$m="",$tm="",$p="",$tp="",$img="",$ti="",$e=""){
        $this->nome = $n;
        $this->descricao = $d;
        $this->matriz = $m;
        $this->temp_matriz = $tm;
        $this->plano = $p;
        $this->temp_plano = $tp;
        $this->img = $img;
        $this->temp_img = $ti;
        $this->eixo = $e;
        $this->controles = new Controles;
        $this->con = new Conectar();
    }

    public function setMatriz($matriz){
        $this->matriz = $matriz;
    }
    public function setPlano($plano){
        $this->plano = $plano;
    }
    
    public function getNome(){
        return $this->nome;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function getMatriz(){
        return $this->matriz;
    }
    public function getTemp_matriz(){
        return $this->temp_matriz;
    }
    public function getPlano(){
        return $this->plano;
    }
    public function getTemp_plano(){
        return $this->temp_plano;
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
    $this->controles->enviarArquivo($this->getTemp_matriz(),"../curso/matriz/".$this->getMatriz());
    $this->controles->enviarArquivo($this->getTemp_plano(),"../curso/plano/".$this->getPlano());
    $this->controles->enviarArquivo($this->getTemp_img(),"../curso/imagem/".$this->getImg());
  
    $this->con->executar("INSERT INTO curso VALUES (null,
            '".$this->getNome()."','".$this->getDescricao()."',
            '".$this->getMatriz()."','".$this->getPlano()."',
            '".$this->getImg()."','".$this->getEixo()."')");
    }

    public function consultar(){
        $sql = $this->con->executar("SELECT * FROM curso");
        echo "<table><tr><td colspan='2'><h3>Cursos da ETEC</h3></td></tr>";
        while ($linhas = mysql_fetch_row($sql)){
            echo "
            <tr><td>ID - ".$linhas[0]." Nome: </td><td>".$linhas[1]."</td></tr>
            <tr><td>Descri&ccedil;&atilde;o: </td><td>".$linhas[2]."</td></tr>
            
            <tr><td>Matriz: </td>
            <td><a href=../curso/matriz/".$linhas[3]." target=_blank title=".$linhas[1].">Clique aqui</a></td></tr>
            <tr><td>Plano: </td>
            <td><a href=../curso/plano/".$linhas[4]." target=_blank title=".$linhas[1].">Clique aqui</a></td></tr>
            <tr><td>Imagem: </td>
            <td><img src=../curso/imagem/".$linhas[5]." border='0' width='75px' alt='".$linhas[1]."' /></td></tr>
            <tr>
                <td colspan='2'>
                        <a href='?p=curso/excluir.php&id=".$linhas[0]."' target='_self'>[Excluir]</a>
                        <a href='?p=curso/editar.php&id=".$linhas[0]."' target='_self'>[Editar]</a>
                        <a href='?p=curso/editarArq.php&id=".$linhas[0]."&t=m' target='_self'>[Trocar Matriz]</a>
                        <a href='?p=curso/editarArq.php&id=".$linhas[0]."&t=p' target='_self'>[Trocar Plano]</a>
                        <a href='?p=curso/editarArq.php&id=".$linhas[0]."&t=i' target='_self'>[Trocar Imagem]</a>
                        <a href='?p=curso/editarArq.php&id=".$linhas[0]."&t=e' target='_self'>[Alterar Eixo]</a>
                </td>
            </tr>
            <tr><td colspan='2'><hr /><br /></td></tr>";
        }
        echo "</table>";
    }

    public function excluir($id){
            $sql = $this->con->executar("SELECT * FROM curso WHERE id = '$id'");
            while($linhas = mysql_fetch_row($sql)){
                    $this->controles->excluirArquivo("../curso/matriz/".$linhas[3]);
                    $this->controles->excluirArquivo("../curso/plano/".$linhas[4]);
                    $this->controles->excluirArquivo("../curso/imagem/".$linhas[5]);
            }
            $this->con->executar("DELETE FROM curso WHERE id = '$id'");
    }

    public function carregarID($id){
        $sql = $this->con->executar("SELECT * FROM curso WHERE id = '$id'");
        while($linhas = mysql_fetch_row($sql)){
            return array($linhas[0],
            $linhas[1],$linhas[2],
            $linhas[3],$linhas[4],
            $linhas[5],$linhas[6]);				
        }
    }

    public function editar($id,$n,$d){
        $this->con->executar("UPDATE curso SET nome = '$n',
            descricao = '$d' WHERE id = '$id'");
    }
    //parei aqui
    public function editarPlano($id, $plano, $plano_temp,$antigo){		
        $this->controles->excluirArquivo("../curso/plano/".$antigo);
        $this->controles->enviarArquivo($plano_temp,"../curso/plano/".$plano);
        $this->con->executar("UPDATE curso SET plano = '$plano' WHERE id = '$id'");
    }

    public function editarMatriz($id, $matriz, $matriz_temp,$antigo){
        $this->controles->excluirArquivo("../curso/matriz/".$antigo);
        $this->controles->enviarArquivo($matriz_temp,"../curso/matriz/".$matriz);
        $this->con->executar("UPDATE curso SET matriz = '$matriz' WHERE id = '$id'");
    }

    public function editarImagem($id, $imagem, $imagem_temp,$antigo){
            $this->controles->excluirArquivo("../curso/imagem/".$antigo);
            $this->controles->enviarArquivo($imagem_temp,"../curso/imagem/".$imagem);
            $this->con->executar("UPDATE curso SET imagem = '$imagem' WHERE id = '$id'");
    }

    public function editarEixo($id,$eixo){
        $this->con->executar("UPDATE curso SET eixo = '$eixo' WHERE id = '$id'");
    }

    public function carregarCurso(){
        $sql = $this->con->executar("SELECT * FROM curso ORDER BY nome");
        echo "<option value='1'>Escolha o curso</option>";
        while($linhas = mysql_fetch_row($sql)){
                echo "<option value=".$linhas[0].">".$linhas[1]."</option>";
        }
    }
    
    public function carregarCurs(){
        $sql = $this->con->executar("SELECT * FROM curso ORDER BY nome");
        echo "<option value='1'>Escolha o curso</option>";
        while($linhas = mysql_fetch_row($sql)){
                echo "<option value='".$linhas[1]."'>".$linhas[1]."</option>";
        }
    }
    
     public function carregarCur(){
        $sql = $this->con->executar("SELECT * FROM curso ORDER BY nome");
        echo "<option value='1'>Escolha o curso</option>";
        while($linhas = mysql_fetch_row($sql)){
                echo "<option value='".$linhas[7]."'>".$linhas[1]."</option>";
        }
    }
    
    public function mostrar($entrada,$tipo){
        if($tipo === "adm"){
            $curso = "../curso/";
        }else{
             $curso = "curso/";
        }
        $sql = $this->con->executar("SELECT * FROM curso WHERE legenda = '$entrada'");
        
        $this->eixo = new Eixo();
        echo "<table>";
        while ($linhas = mysql_fetch_row($sql)){
            $array = $this->eixo->carregarID($linhas[6]);
            echo "
            <tr><td><h2>Curso: ".$linhas[1]." <br /> Eixo Tecnol&oacute;gico: ".$array[1]."</h2></td></tr>
            <tr><td><img src='http://www.etecitu.com.br/curso/imagem/".$linhas[5]."' alt='".$linhas[1]."' width='500px' height='150px' /></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><strong>Informa&ccedil;&otilde;es Gerais: </strong></td></tr>
            <tr><td>".$linhas[2]."<br /></td></tr>
            <tr><td><strong>Matriz Curricular</strong> - <a href='http://www.etecitu.com.br/curso/matriz/".$linhas[3]."' target='_blank' title='".$linhas[1]."'>Clique aqui</a></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><strong>Plano de Curso</strong> - <a href='http://www.etecitu.com.br/curso/plano/".$linhas[4]."' target='_blank' title='".$linhas[1]."'>Clique aqui</a></td></tr>
            ";
        }
        echo "</table>";
    }

    public function __destruct(){
            $this->controles = "";
            $this->eixo = "";
            $this->titulo = "";
            $this->descricao = "";
            $this->matriz = "";
            $this->temp_matriz = "";
            $this->plano = "";
            $this->temp_plano = "";
            $this->img = "";
            $this->temp_img = "";
            $this->con = "";
    }
}
