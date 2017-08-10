<?php

include "../../conexao/conn.php";

$campo = $_POST["campo"];
$codDisciplina = $_POST["coddisciplina"];
$codTurma = $_POST["codturma"];
$mes = $_POST["mes"];
$valor = $_POST["valor"];

$sql = "INSERT INTO Anexo4 (codDisciplina, codTurma, mes, $campo)
    VALUES ($codDisciplina, $codTurma, $mes, $valor)
    ON DUPLICATE KEY UPDATE $campo=$valor ";

$rs = mysql_query($sql);

?>