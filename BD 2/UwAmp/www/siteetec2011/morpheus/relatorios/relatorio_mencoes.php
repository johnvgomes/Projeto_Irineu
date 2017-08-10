<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 
include_once('class/fpdf/fpdf.php');
include_once("class/PHPJasperXML.inc.php");
include_once ('setting.php');

$codDisciplina = $_GET["codDisciplina"];
$codTurma = $_GET["codTurma"];

$xml =  simplexml_load_file("mencoes.jrxml");

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("codDisciplina"=>$codDisciplina, "codTurma"=>$codTurma);
$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
*/

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('class/fpdf/fpdf.php');
include_once("class/PHPJasperXML.inc.php");

include_once ('../conexao/conn.php');
$filename="saida";

$codDisciplina = $_GET["codDisciplina"];
$codTurma = $_GET["codTurma"];

//$xml =  simplexml_load_file("ficha_de_matricula.jrxml");
$xml =  simplexml_load_file("mencoes2.jrxml");

$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->debugsql=false;
$PHPJasperXML->arrayParameter=array("codDisciplina"=>$codDisciplina, "codTurma"=>$codTurma);
//$PHPJasperXML->arrayParameter=array("where"=>"codAluno=3033");
$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
//$PHPJasperXML->outpage("F","tmp/$filename"); 
//page output method I:standard output D:Download file, F =save as filename and submit 2nd parameter as destinate file name 

$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
?>