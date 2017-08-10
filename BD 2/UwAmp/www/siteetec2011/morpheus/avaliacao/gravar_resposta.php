<?php

$pergunta 		= $_POST["pergunta"];
$codTurma 		= $_POST["codturma"];
$codDisciplina 	= $_POST["coddisciplina"];
$codAluno 		= $_POST["codaluno"];
$codAtribuicao	= $_POST["codatribuicao"];
$resposta 		= $_POST["resposta"];
$tipo 			= $_POST["tipo"];
$obs 			= $_POST["obs"];
$contexto 		= $_POST["contexto"];

include "../conexao/conn.php";

if ($tipo == "obs"){
	if ($contexto=="disciplina"){
			$sql = "REPLACE ObservacoesDisciplinas(
			codDisciplina,
			codAluno,
			codTurma,
			observacao)
			VALUES ($codDisciplina, $codAluno, $codTurma, '$obs')";
	}elseif ($contexto=="professor"){
			$sql = "REPLACE ObservacoesProfessores(
			codAtribuicao,
			codAluno,
			observacao)
			VALUES ($codAtribuicao, $codAluno, '$obs')";

	}
	$rs = mysql_query($sql);

	exit();
}

if ($pergunta <= 3){

	$sql = "REPLACE AvaliacaoDisciplinas(
			pergunta,
			codTurma,
			codDisciplina,
			codAluno,
			resposta)
			VALUES ($pergunta, $codTurma, $codDisciplina, $codAluno, $resposta)";
}else{
	$sql = "REPLACE AvaliacaoProfessores(
			pergunta,
			codAtribuicao,
			codAluno,
			resposta)
			VALUES ($pergunta, $codAtribuicao, $codAluno, $resposta)";
	
}	

$rs = mysql_query($sql);

echo mysql_affected_rows();


?>