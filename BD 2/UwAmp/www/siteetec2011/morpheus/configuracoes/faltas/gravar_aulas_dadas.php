<?php

include "../../conexao/conn.php";

$codTurma = $_POST["codturma"];
$codDisciplina = $_POST["coddisciplina"];
$aulas = $_POST["aulas"];

$sql = "INSERT INTO AulasDadas (codTurma, codDisciplina, aulasDadas)
		VALUES ($codTurma, $codDisciplina, $aulas)
		ON DUPLICATE KEY UPDATE aulasDadas=$aulas ";

$rs = mysql_query($sql);

?>