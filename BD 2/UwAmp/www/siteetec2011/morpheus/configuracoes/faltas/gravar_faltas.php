<?php

include "../../conexao/conn.php";

$codMatricula = $_POST["codmatricula"];
$codDisciplina = $_POST["coddisciplina"];
$faltas = $_POST["faltas"];

$sql = "INSERT INTO Frequencia (codMatricula, codDisciplina, faltas)
		VALUES ($codMatricula, $codDisciplina, $faltas)
		ON DUPLICATE KEY UPDATE faltas=$faltas ";

$rs = mysql_query($sql);

?>