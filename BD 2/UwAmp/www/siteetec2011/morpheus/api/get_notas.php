<?php

$pass = $_GET["token"];

if ($pass != "2c20105978d80f0c5e540bee0db37e66"){
	echo "nao autorizado";
	exit();
}

include '../conexao/conn.php';

// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Etapas WHERE atual=1");
$codEtapa = mysql_result($rsEtapaAtual, 0);

$codAluno = $_GET['codaluno'];

$sqlAluno = "SELECT Alunos.*, Matriculas.* FROM Alunos INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno WHERE Alunos.rg=$codAluno";
$rsAluno = mysql_query($sqlAluno);

$codAluno = mysql_result($rsAluno, 0, "codaluno");

$sqlMatricula = "SELECT codTurma FROM Matriculas WHERE codAluno=$codAluno AND codEtapa=$codEtapa";
$rsMatricula = mysql_query($sqlMatricula);
$codTurma = mysql_result($rsMatricula, 0);


	//pegar todas as turmas em que o aluno foi matriculado
	$sql = "select distinct Disciplinas.*, Turmas.codTurma, Turmas.modulo, Series.serie, Series.codSerie, Cursos.codCurso, Cursos.habilitacao, Periodos.descricaoPeriodo, Etapas.etapa, Matriculas.codMatricula, Alunos.nomeAluno
			FROM Turmas 
			INNER JOIN Series ON Turmas.codSerie=Series.codSerie
			INNER JOIN Cursos ON Series.codCurso=Cursos.codCurso
			INNER JOIN Matriculas ON Matriculas.codTurma=Turmas.codTurma
			INNER JOIN Etapas ON Etapas.codEtapa=Matriculas.codEtapa
			INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
			INNER JOIN Periodos ON Series.codPeriodo=Periodos.codPeriodo 
			INNER JOIN Disciplinas ON Cursos.codCurso=Disciplinas.codCurso AND Turmas.modulo=Disciplinas.modulo
			WHERE Alunos.codAluno=$codAluno AND Turmas.codTurma=$codTurma";

			

	$rsDisciplinas = mysql_query($sql);

//{"GSO3":["MB","B"],"PC2":["R","B"],"DTCC":["B","MB"],"ECO":["MB","B"],"APP":["I","R"],"PPI":["B","B"],"DS2":["MB","R"]}

	echo "{";

		$cont = 0;
		while ($rowDisciplinas = mysql_fetch_array($rsDisciplinas)){
			if ($cont>0) echo ",";
			
			echo "\"".utf8_decode($rowDisciplinas['disciplina'])."\": ";
			
			$codDisciplina = $rowDisciplinas['codDisciplina'];
				
			//buscar as menções da disciplina
			$sqlMencoes = "SELECT mencaoIntermediaria, mencaoFinal FROM Mencoes ".
											"WHERE codAluno=$codAluno ".
											"AND codDisciplina=$codDisciplina";
			$rsMencoes = mysql_query($sqlMencoes);
					
			//verifica se o aluno tem menção
			if (mysql_num_rows($rsMencoes)<1) {
				$mencaoI="-";
				$mencaoF="-";
				}else {
					$mencaoI = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
					$mencaoF = mysql_result($rsMencoes, 0, "mencaoFinal");
				}
			echo "[\"".$mencaoI."\", ";
			echo "\"".$mencaoF."\"]";

			$cont++;
			
		}// fim do while das avaliacoes

		echo "}";

		?>

