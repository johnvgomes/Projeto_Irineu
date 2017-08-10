<?php

$codAluno = intval($_REQUEST['codAluno']);
$codTurma = intval($_REQUEST['codTurma']);
$codEtapa = 1; //TODO pegar etapa atual

include '../../conexao/conn.php';

$sql = "INSERT INTO Matriculas (codMatricula, codAluno, codTurma, status, codEtapa) VALUES (0, $codAluno, $codTurma, 'MA', $codEtapa)";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao matricular aluno.'));
}
?>