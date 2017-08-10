<?php 

$codMatricula = $_POST["codMatricula"];
$codDisciplina = $_POST["codDisciplina"];
$campo = $_POST["campo"];
$valor = $_POST["valor"];

include "../conexao/conn.php";

$tabela = "Deliberacao11".$campo;
$campo = "cod".$campo;

$sql = "INSERT INTO $tabela ( codMatricula, codDisciplina, $campo )
		VALUES ( $codMatricula, $codDisciplina,  $valor )";

$rs = mysql_query($sql);
echo $sql;
//echo mysql_insert_id();

?>
