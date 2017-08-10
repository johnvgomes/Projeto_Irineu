<?php

include_once('../../relatorios/class/tcpdf/tcpdf.php');
include_once("../../relatorios/class/PHPJasperXML.inc.php");

include_once ('../../relatorios/setting.php');

$tipo = $_POST["tipo"];

if ($tipo == "porTurma"){
	$turma = $_POST["turma"];
	$where = "codTurma=$turma";
}else{
	$codAluno = $_POST["codAluno"];
	$where = "codAluno=$codAluno";
}

$xml =  simplexml_load_file("../../relatorios/ficha_de_matricula.jrxml");
$PHPJasperXML = new PHPJasperXML("pt_BR","TCPDF");
$PHPJasperXML->debugsql=false;
$PHPJasperXML->arrayParameter=array("where"=>$where);
$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>

