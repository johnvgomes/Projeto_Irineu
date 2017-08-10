<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('class/fpdf/fpdf.php');
include_once("class/PHPJasperXML.inc.php");

include_once ('setting.php');
 $filename=$_GET["filename"];


$xml =  simplexml_load_file("ficha_de_matricula.jrxml");


$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->debugsql=false;
$PHPJasperXML->arrayParameter=array("turma"=>1);
$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("F","tmp/$filename"); 
//page output method I:standard output D:Download file, F =save as filename and submit 2nd parameter as destinate file name 

$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
