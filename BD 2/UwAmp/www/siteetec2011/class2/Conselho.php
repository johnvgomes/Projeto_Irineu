<?php

require_once 'Controles.php';
require_once 'Conectar.php';
require_once 'Eixo.php';
require_once 'Entity.php';

class Conselho extends Entity{

    private $curso;
    private $modulo;
    private $ano;
    private $semestre;
    private $tipo;
    private $arquivo;
    private $temp_arquivo;
    private $eixo;
    private $controles;
    private $con;
	
    public function __construct($c="",$m="",$a="",$s="",$t="",$ar="",$ta="",$e="") {
        $this->curso = $c;
        $this->modulo = $m;
        $this->ano = $a;
        $this->semestre = $s;
        $this->tipo = $t;
        $this->arquivo = $ar;
        $this->temp_arquivo = $ta;
        $this->eixo = $e;
        $this->controles = new Controles;
        $this->con = new Conectar();
    }

    public function cadastrar(){
        $this->controles->enviarArquivo($this->getTemp_arquivo(),"../conselho/".$this->getArquivo());

        $this->con->executar("INSERT INTO conselho VALUES (null,
        '".$this->getCurso()."',
        '".$this->getModulo()."','".$this->getAno()."',
        '".$this->getSemestre()."','".$this->getTipo()."',
        '".$this->getArquivo()."',
        '".$this->getEixo()."')");
    }

    public function consultar($c,$m,$a,$s,$t){
        $sql = $this->con->executar("SELECT * FROM conselho WHERE curso = '$c' AND
                modulo = '$m' AND  ano = '$a' AND
                 semestre = '$s' AND  tipo = '$t'");
        
        if(mysql_num_rows($sql)===0){
            echo '<h3>Ata n&atilde;o encontrada</h3>';
        }else{
            echo '<table>';
            while ($linhas = mysql_fetch_row($sql)){
                echo "
                <tr><td><h3>Curso: ".$linhas[1]."</h3></td></tr>
                <tr><td>Ano: ".$linhas[3]."</td></tr>
                <tr><td>M&oacute;dulo: ".$linhas[2]."</td></tr>
                <tr><td>Semestre: ".$linhas[4]."</td></tr>
                <tr><td>Tipo (Parcial ou final): ".$linhas[5]."</td></tr>
                <tr>
                    <td colspan='2'>
                    <h3>
                        <a href='?p=conselho/excluir.php&id=".$linhas[0]."' target='_self'>[Excluir]</a>
                    </h3>
                    </td>
                </tr>";
              }
            echo "</table>";
        }
    }
    
    public function mostrar($c,$m,$a,$s,$t,$tipo){
        if($tipo === "adm"){
                @$tipo = "../conselho/";
            }else{
                @$tipo = "conselho/";
            }
        $sql = $this->con->executar("SELECT * FROM conselho WHERE curso = '$c' AND
                modulo = '$m' AND  ano = '$a' AND
                 semestre = '$s' AND  tipo = '$t'");
        
        if(mysql_num_rows($sql)===0){
            echo '<h3>Ata n&atilde;o encontrada</h3>';
        }else{
            echo '<table>';
            while ($linhas = mysql_fetch_row($sql)){
                echo "
                <tr><td><h3>Curso: ".$linhas[1]."</h3></td></tr>
                <tr><td>Ano: ".$linhas[3]."</td></tr>
                <tr><td>M&oacute;dulo: ".$linhas[2]."</td></tr>
                <tr><td>Semestre: ".$linhas[4]."</td></tr>
                <tr><td>Tipo (Parcial ou final): ".$linhas[5]."</td></tr>
                <tr>
                    <td colspan='2'>
                    <h3>
                        <a href='".$tipo.$linhas[6]."' target='_blank'>[Visualizar]</a>
                    </h3>
                    </td>
                </tr>";
              }
            echo "</table>";
        }
    }

    public function excluir($id){
        $sql = $this->con->executar("SELECT * FROM conselho WHERE id = '$id'");
        while($linhas = mysql_fetch_row($sql)){
                $this->controles->excluirArquivo("../conselho/".$linhas[6]);
        }
        $this->con->executar("DELETE FROM conselho WHERE id = '$id'");
    }

    public function __destruct(){
        $this->curso = "";
        $this->modulo = "";
        $this->ano = "";
        $this->semestre = "";
        $this->tipo = "";
        $this->arquivo = "";
        $this->temp_arquivo = "";
        $this->eixo = "";
        $this->controles = "";
        $this->con = "";
    }
}
