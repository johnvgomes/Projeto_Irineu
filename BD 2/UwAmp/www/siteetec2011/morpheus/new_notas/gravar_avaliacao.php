<?php

$codTurma = $_REQUEST['codTurma'];
$codDisciplina = $_REQUEST['codDisciplina'];
$sigla = $_REQUEST['sigla'];
$descricao = $_REQUEST['descricao'];
$tipo = $_REQUEST['tipo'];
$data = $_REQUEST['data'];
$date = substr($data, -4)."-".substr($data, 3, 2)."-".substr($data, 0, 2);

include '../conexao/conn.php';

$sql = "insert into Avaliacoes (" .
		"codTurma, ".
		"codDisciplina, ".
		"sigla, ".
		"descricao, ".
		"tipo, ".
		"data".
		") values(".
		"'$codTurma', ".
		"'$codDisciplina', ".
		"'$sigla', ".
		"'$descricao', ".
		"'$tipo', ".
		"'$data'".
	")";

$result = @mysql_query($sql);

?>