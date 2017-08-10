<?php

include "../../conexao/conn.php";

$campo = $_POST["campo"];
$codDisciplina = $_POST["codDisciplina"];
$codMatricula = $_POST["codMatricula"];
$valor = $_POST["valor"];

if ($campo=="concluiuEm"){
	$valor = implode("-",array_reverse(explode("/",$valor)));
}

$sql = "UPDATE ProgressoesParciais SET $campo='$valor' 
		WHERE codDisciplina=$codDisciplina
		AND codMatricula=$codMatricula";
    
$result = mysql_query($sql);

?>