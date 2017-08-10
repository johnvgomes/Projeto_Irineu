<?php

$codTurma = $_REQUEST['codTurma'];
$codDisciplina = $_REQUEST['codDisciplina'];
$conteudo = $_REQUEST['conteudo'];
$aulas = $_REQUEST['aulas'];
$data = $_REQUEST['campo_data'];

$data = implode("-",array_reverse(explode("/",$data)));

include '../conexao/conn.php';

$sql = "insert into Encontros (" .
		"data, ".
		"conteudo, ".
		"codTurma, ".
		"codDisciplina, ".
		"qtdeAulas ".
		") values(".
		"'$data', ".
		"'$conteudo', ".
		"'$codTurma', ".
		"'$codDisciplina', ".
		"'$aulas'".
	")";

$result = @mysql_query($sql);

$codEncontro = mysql_insert_id();

for ($i=1; $i <= $aulas; $i++) { 
	$sql = "INSERT INTO Aulas (codEncontro, indice) VALUES ($codEncontro, $i)";
	$result = @mysql_query($sql);

}

?>