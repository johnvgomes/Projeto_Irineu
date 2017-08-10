<?php

session_name('jcLogin');
session_start();

include "../conexao/conn.php";

$codAluno = $_POST["codaluno"];
$codDisciplina = $_POST["coddisciplina"];
$codTurma = $_POST["codturma"];
$mencao = $_POST["mencao"];
$campo = $_POST["campo"];
$codEtapa = $_POST["codEtapa"];
$codProfessor = $_SESSION['id'];

$sql = "INSERT Mencoes (codAluno, codDisciplina, codEtapa, $campo) ".
		"VALUES ($codAluno, $codDisciplina, $codEtapa, '$mencao') ".
		"ON DUPLICATE KEY UPDATE $campo='$mencao'";

$rs = mysql_query($sql);

$sqlControle = "INSERT EntregaDeMencoes (codDisciplina, codTurma, codEtapa, ultimaAlteracaoI, codDigitadorI) ".
				"VALUES ($codDisciplina, $codTurma, $codEtapa, now(), $codProfessor) ".
				"ON DUPLICATE KEY UPDATE ultimaAlteracaoI=now(), codDigitadorI=$codProfessor";

$rsControle = mysql_query($sqlControle);



?>