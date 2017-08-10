<?php

$codAluno = intval($_REQUEST['codAluno']);
$codTurma = intval($_REQUEST['codTurma']);

include '../../conexao/conn.php';

//Pegar o último número de chamada da turma
$sql_numero = "SELECT MAX(nchamada) as numero FROM Matriculas WHERE codTurma=$codTurma";
$rs_numero = mysql_query($sql_numero);
$nchamada = mysql_result($rs_numero, 0, "numero");
$nchamada++;

$sql = "INSERT INTO Matriculas (codMatricula, codAluno, codTurma, status, nchamada) VALUES (0, $codAluno, $codTurma, 'MA', $nchamada)";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao matricular aluno.'));
}
?>