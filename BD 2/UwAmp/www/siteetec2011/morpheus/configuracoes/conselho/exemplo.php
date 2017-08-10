<?php
echo $_SERVER['PHP_SELF'];
include('../../relatorios/class/fpdf/fpdf.php');
include('../../relatorios/class/fpdf/PHPJasperXML.inc');
include('../../relatorios/setting.php');

$xml = simplexml_load_file("../../relatorios/ficha_de_matricula.jrxml"); //informe onde est� seu arquivo jrxml

$PHPJasperXML = new PHPJasperXML();

$PHPJasperXML->debugsql=FALSE;

//$turma=$_POST["turma"]; //recebendo o par�metro descri��o

//$PHPJasperXML->arrayParameter=array("turma"=>$turma); //passa o par�metro cadastrado no iReport

$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->connect($server,$user,$pass,$db);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

$PHPJasperXML->outpage("I");

?>