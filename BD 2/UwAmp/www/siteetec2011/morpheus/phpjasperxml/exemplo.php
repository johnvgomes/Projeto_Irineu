<?php

include('class/fpdf/fpdf.php');
include('class/PHPJasperXML.inc');
include('setting.php');

$xml = simplexml_load_file("ficha_de_matricula.jrxml"); 
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->debugsql=TRUE;

$turma=$_POST["turma"]; 
$PHPJasperXML->arrayParameter=array("turma"=>$turma);
$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->connect($server,$user,$pass,$db);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");

?>