<?php

session_name('jcLogin');
session_start();

include "../conexao/conn.php";

$codAluno = $_POST["codaluno"];
$codDisciplina = $_POST["coddisciplina"];
$codTurma = $_POST["codturma"];
$mencao = $_POST["mencao"];
$codEtapa = $_POST["codEtapa"];
$codProfessor = $_SESSION['id'];

$sql = "INSERT Mencoes (codAluno, codDisciplina, codEtapa, mencaoFinal) ".
		"VALUES ($codAluno, $codDisciplina, $codEtapa, '$mencao') ".
		"ON DUPLICATE KEY UPDATE mencaoFinal='$mencao'";

$rs = mysql_query($sql);

$sqlControle = "INSERT EntregaDeMencoes (codDisciplina, codTurma, codEtapa, ultimaAlteracaoF, codDigitadorF) ".
				"VALUES ($codDisciplina, $codTurma, $codEtapa, now(), $codProfessor) ".
				"ON DUPLICATE KEY UPDATE ultimaAlteracaoF=now(), codDigitadorF=$codProfessor";

$rsControle = mysql_query($sqlControle);

?>