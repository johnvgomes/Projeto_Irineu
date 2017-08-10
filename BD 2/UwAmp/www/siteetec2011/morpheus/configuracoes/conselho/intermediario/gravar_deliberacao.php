<?php

$codMatricula = intval($_POST["codMatricula"]);
$codDisciplina = intval($_POST["codDisciplina"]);
$cod = intval($_POST["cod"]);
$tabela = ($_POST["tabela"]);
$acao = ($_POST["acao"]);

include '../../../conexao/conn.php';

if ($acao=="insert"){
	$sql = "INSERT INTO Deliberacao11$tabela (codMatricula, codDisciplina, cod$tabela)
			VALUES ($codMatricula, $codDisciplina, $cod)";
}else{
	$sql = "DELETE FROM Deliberacao11$tabela 
			WHERE codMatricula=$codMatricula 
			AND codDisciplina=$codDisciplina 
			AND cod$tabela=$cod";
}

$result = @mysql_query($sql);
?>