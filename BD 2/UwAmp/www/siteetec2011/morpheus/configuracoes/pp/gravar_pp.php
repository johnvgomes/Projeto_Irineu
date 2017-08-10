<?php

$codMatricula = $_POST["codmatricula"];
$codDisciplina = $_POST["coddisciplina"];
$pendente = $_POST["pendente"];


include "../../conexao/conn.php";

$sql = "REPLACE ProgressoesParciais( codMatricula, codDisciplina, pendente ) 
		VALUES ( $codMatricula, $codDisciplina,  '$pendente' )";

$rs = mysql_query($sql);


?>