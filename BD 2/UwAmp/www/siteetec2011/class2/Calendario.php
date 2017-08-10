<?php
header('Content-type: text/html; charset=utf-8');
require_once 'Controles.php';
require_once 'Conectar.php';
require_once 'Eixo.php';
require_once 'Entity.php';

class Calendario extends Entity{
    
    private $id;
    private $ano;
    private $titulo;
    private $arquivo;
    private $temp_arquivo;
    private $eixo;
    private $controles;
    private $con;
	
    public function __construct($a="",$t="",$arq="",$ta="",$e=""){
        $this->ano = $a;
        $this->titulo = $t;
        $this->arquivo = $arq;
        $this->temp_arquivo = $ta;
        $this->eixo = $e;
        $this->controles = new Controles;
        $this->con = new Conectar();
    }

    public function cadastrar(){
    $this->controles->enviarArquivo($this->getTemp_arquivo(),"../calendario/".$this->getArquivo());
  
    $this->con->executar("INSERT INTO calendario VALUES (null,
            '".$this->getAno()."','".$this->getTitulo()."',
            '".$this->getArquivo()."','".$this->getEixo()."')");
    }

    public function consultar(){
        $sql = $this->con->executar("SELECT * FROM calendario ORDER BY ano DESC");
        echo "<table><tr><td colspan='2'><h3>Calendario da ETEC</h3></td></tr>";
        while ($linhas = mysql_fetch_row($sql)){
            echo "
            <tr><td colspan='2'>ID - ".$linhas[0]." Ano: <strong>".$linhas[1]."</strong></td></tr>
            <tr><td>Titulo: </td><td>".$linhas[2]."</td></tr>
            
            <tr>
                <td>Arquivo: </td>
                <td>
                    <a href='../calendario/".$linhas[3]."' target='_blank' title='".$linhas[1]."'>Clique aqui</a>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                        <a href='?p=calendario/excluir.php&id=".$linhas[0]."' target='_self'>[Excluir]</a>
                        <a href='?p=calendario/editar.php&id=".$linhas[0]."' target='_self'>[Editar]</a>
                        <a href='?p=calendario/editarArq.php&id=".$linhas[0]."&t=c' target='_self'>[Trocar Arquivo]</a>
                </td>
            </tr>
            <tr><td colspan='2'><hr /><br /></td></tr>";
        }
        echo "</table>";
    }

    public function excluir($id){
            $sql = $this->con->executar("SELECT * FROM calendario WHERE id = '$id'");
            while($linhas = mysql_fetch_row($sql)){
                    $this->controles->excluirArquivo("../calendario/".$linhas[3]);
            }
            $this->con->executar("DELETE FROM calendario WHERE id = '$id'");
    }

    public function carregarID($id){
        $sql = $this->con->executar("SELECT * FROM calendario WHERE id = '$id'");
        while($linhas = mysql_fetch_row($sql)){
            return array($linhas[0],
            $linhas[1],$linhas[2],
            $linhas[3],$linhas[4]);				
        }
    }

    public function editar($id,$a,$t){
        $this->con->executar("UPDATE calendario SET ano = '$a',
            titulo = '$t' WHERE id = '$id'");
    }

    public function editarArquivo($id, $arq, $arq_temp,$antigo){		
        $this->controles->excluirArquivo("../calendario/".$antigo);
        $this->controles->enviarArquivo($arq_temp,"../calendario/".$arq);
        $this->con->executar("UPDATE calendario SET arquivo = '$arq' WHERE id = '$id'");
    }

    public function carregarCalendario(){
        $sql = $this->con->executar("SELECT * FROM calendario ORDER BY ano DESC");
        echo "<option value='1'>Escolha o Calendario</option>";
        while($linhas = mysql_fetch_row($sql)){
                echo "<option value=".$linhas[0].">".$linhas[1]." - ".$linhas[2]."</option>";
        }
    }
    
    public function mostrar($ano,$tipo){
        if($tipo === "adm"){
            $calendario = "../calendario/";
        }else{
             $calendario = "calendario/";
        }
        $sql = $this->con->executar("SELECT * FROM calendario WHERE ano = '$ano'");

        echo '<div>
            <div><h3>Calendario Escolar - ano de '.$ano.'</h3></div>';
        while ($linhas = mysql_fetch_row($sql)){
            echo '
                <div class="calendario"><a href="'.$calendario.$linhas[3].'" target="_blank" title="'.$linhas[1].'">'.
                    strtr(strtoupper($linhas[2]),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß")
                    .'</a>
                </div>
            ';
        }
        echo '</div>';
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
