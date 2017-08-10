<?php
$codEtapa = 1; //TODO pegar a etapa atual
$codTurma = $_REQUEST['codTurma'];
$codDisciplina = $_REQUEST['codDisciplina'];
$aulaDadas =  $_REQUEST['aulas_dadas'];

include '../../conexao/conn.php';

$sqlAlunos = "select Matriculas.*, Alunos.nomeAluno, Alunos.codAluno from Matriculas INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno WHERE Matriculas.codTurma=$codTurma";
$rsAlunos = mysql_query($sqlAlunos);
//echo mysql_error();
$success=true;
while ($row = mysql_fetch_array($rsAlunos)){
	$codMatricula = $row["codMatricula"]; 
	$faltas = $_REQUEST[$codMatricula];
	if ($faltas == "") $faltas = 0; 
	
	//gravar faltas
	$rsControle = mysql_query("SELECT * FROM Frequencia WHERE codMatricula=$codMatricula");
	if(mysql_num_rows($rsControle)==0){
		$sql = "INSERT INTO Frequencia (codMatricula, faltas) VALUES ($codMatricula, $faltas)";
	}else{
		$sql = "UPDATE Frequencia SET faltas=$faltas WHERE codMatricula=$codMatricula";
	}
	//echo $sql."<br>";
	$result = @mysql_query($sql);
	if (!$result) $success = false;
}
//echo $sqlAlunos;

//gravar aulas dadas
$rsControle = mysql_query("SELECT * FROM AulasDadas WHERE codEtapa=$codEtapa AND codTurma=$codTurma");
if(mysql_num_rows($rsControle)==0){
	$sql = "INSERT INTO AulasDadas (codEtapa, codTurma, aulasDadas) VALUES ($codEtapa, $codTurma, $aulaDadas)";
}else{
	$sql = "UPDATE AulasDadas SET aulasDadas=$aulaDadas WHERE codEtapa=$codEtapa AND codTurma=$codTurma";
}
//echo $sql."<br>";
$result = @mysql_query($sql);
if (!$result) $success = false;

	if ($success){
		echo json_encode(array('success'=>true));
	} else {
		echo json_encode(array('msg'=>'Erro ao gravar dados. ' . $sql));
	}
?>