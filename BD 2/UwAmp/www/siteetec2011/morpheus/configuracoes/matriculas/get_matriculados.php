<?php
$codTurma = $_GET["codTurma"];
include '../../conexao/conn.php';
$rs = mysql_query("select Matriculas.*, (Alunos.nomeAluno) as nomeAluno, Alunos.rg from Matriculas INNER JOIN Alunos ON Matriculas.codAluno=Alunos.codAluno WHERE Matriculas.codTurma=$codTurma ORDER BY nChamada");
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>