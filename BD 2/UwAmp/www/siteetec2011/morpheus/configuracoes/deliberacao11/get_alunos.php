<?php

include '../../conexao/conn.php';

$codTurma = $_GET["codturma"];

$sql = "SELECT Turmas.*, Series.codCurso FROM Turmas INNER JOIN Series ON Series.codSerie=Turmas.codSerie WHERE codTurma=$codTurma";
$rs = mysql_query($sql);
$modulo = mysql_result($rs, 0, "modulo");
$codCurso = mysql_result($rs, 0, "codCurso");

$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo";
$rsDisciplinas = mysql_query($sqlDisciplinas);

while( $row = mysql_fetch_assoc($rsDisciplinas) ){
	$codDisciplina = $row["codDisciplina"];
	$sqlAlunos = "SELECT Alunos.codAluno, nomeAluno FROM Alunos 
					INNER JOIN Mencoes ON Mencoes.codAluno=Alunos.codAluno
					INNER JOIN Matriculas ON Matriculas.codAluno=Alunos.codAluno
					WHERE Mencoes.codDisciplina=$codDisciplina
					AND Matriculas.codTurma=$codTurma
					AND mencaoIntermediaria='I'";
	$rsAlunos = mysql_query($sqlAlunos);
	//echo $sqlAlunos."<br>";
	while ($r = mysql_fetch_array($rsAlunos)) {
     echo "<option value='".$r["codAluno"]."'>".htmlentities($r["nomeAluno"])."</option>\n";
	}
	
}

?>