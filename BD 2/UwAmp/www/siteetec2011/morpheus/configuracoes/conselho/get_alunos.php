<?php

include '../../conexao/conn.php';

$codTurma = $_GET["codTurma"];
$etapa = $_GET["etapa"];

// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Turmas WHERE codTurma=$codTurma");
$codEtapa = mysql_result($rsEtapaAtual, 0, "codEtapa");

//verificar se o curso é semestral ou anual
$rsPeriodicidade = mysql_query("SELECT * FROM Etapas WHERE codEtapa=$codEtapa");
if (mysql_result($rsPeriodicidade, 0, "semestre")==0) $periodicidade="anual"; else $periodicidade="semestral";

$sql1 = " select concat(Turmas.modulo, Series.serie) as turma  FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie where codTurma=$codTurma";


$result = mysql_query ( $sql1);
$row = mysql_fetch_row($result);
$turma = $row[0];
$modulo = substr($turma, 0, 1);
$serie = substr($turma, 1, 1);

//echo "Turma=".$turma;

//pegar o código do curso
$result = mysql_query ( " select Turmas.codTurma, Series.codCurso FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie WHERE modulo=$modulo and serie='$serie'");
$codCurso = mysql_result($result, 0, "codCurso");

//consultar as disciplinas da turma
$sqlDisciplinas =  "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ORDER BY numeroPlanoDeCurso" ;

//simplifiquei a consulta porque não estava retornando registro
//$sql = " select Alunos.codAluno, Alunos.nomeAluno, Matriculas.status, Matriculas.codMatricula, AulasDadas.aulasDadas, Frequencia.faltas, format((((aulasDadas-faltas)/aulasDadas)*100),1) as frequencia, DecisoesConselho.resumo, DecisoesConselho.resultado from Matriculas INNER JOIN Alunos ON Matriculas.codAluno=Alunos.codAluno INNER JOIN AulasDadas ON Matriculas.codTurma=AulasDadas.codTurma LEFT JOIN Frequencia ON Frequencia.codMatricula=Matriculas.codMatricula LEFT JOIN DecisoesConselho ON DecisoesConselho.codMatricula=Matriculas.codMatricula WHERE Matriculas.codTurma=$codTurma ORDER BY nomeAluno;";

$sql = "select Alunos.codAluno, (Alunos.nomeAluno) as nomeAluno, Matriculas.status, Matriculas.codMatricula, Matriculas.nChamada from Matriculas INNER JOIN Alunos ON Matriculas.codAluno=Alunos.codAluno WHERE Matriculas.codTurma=$codTurma ORDER BY nChamada;";
$rs = mysql_query($sql);
//echo $sql;

echo "[";
$cont=0;
while($row = mysql_fetch_array($rs)){
	$rsDisciplinas = mysql_query ($sqlDisciplinas);
	
	$codAluno = $row["codAluno"];
	$status = $row["status"];
	$codMatricula = $row["codMatricula"];

	//Definir criterio de disciplinas em que o aluno foi dispensado
	$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula";
	$rsDispensa = mysql_query($sqlDispensa);
	$where = "";
	while ($rDispensa = mysql_fetch_array($rsDispensa)){
		$where .= " AND Encontros.codDisciplina<>".$rDispensa["codDisciplina"];
	}

	//Pegar as faltas do diario
	$sqlTotalFaltas = "SELECT count(codChamada) as faltas, Encontros.codDisciplina FROM Faltas
									INNER JOIN Aulas ON Aulas.codAula=Faltas.codAula
									INNER JOIN Encontros ON Encontros.codEncontro=Aulas.codEncontro
									INNER JOIN Turmas ON Turmas.codTurma=Encontros.codTurma
									INNER JOIN Disciplinas ON Disciplinas.codDisciplina = Encontros.codDisciplina
									WHERE codAluno=$codAluno
									AND Encontros.codTurma=$codTurma
									 $where";

	//echo $sqlTotalFaltas;
	$rsTotalFaltas = mysql_query($sqlTotalFaltas);
	$totaldefaltas = mysql_result($rsTotalFaltas, 0 , "faltas");
	//se for turma do técnico multiplicar por 1.25
	if ($periodicidade=="semestral") $totaldefaltas = $totaldefaltas*1.25;
	$totaldefaltas = number_format($totaldefaltas, 2);

	//somar as aulas em que o aluno não foi dispensado
	$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula";
	$rsDispensa = mysql_query($sqlDispensa);
	$where = "";
	while ($rDispensa = mysql_fetch_array($rsDispensa)){
		$where .= " AND codDisciplina<>".$rDispensa["codDisciplina"];
	}
	$sqlAulasDadas = "SELECT SUM(qtdeAulas) as aulasDadas FROM Encontros WHERE codTurma=$codTurma $where"; //se for informática busca do diário
	//echo $sqlAulasDadas;
	$rsAulasDadas = mysql_query($sqlAulasDadas);
	$total_aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");
	//se for turma do técnico multiplicar por 1.25
	if ($periodicidade=="semestral") $total_aulas_dadas = $total_aulas_dadas*1.25;
	
	$total_aulas_dadas = number_format($total_aulas_dadas,2);


	$freq_p = (1 - ($totaldefaltas / $total_aulas_dadas) )* 100; 	
	$freq_p = number_format($freq_p,2);
	$total_aulas_dadasF = number_format($total_aulas_dadas,2);


	if ($cont!=0) echo ",";
	echo "{";
	echo "\"nChamada\":\"".$row["nChamada"]."\",";
	echo "\"nomeAluno\":\"".$row["nomeAluno"]."\",";
	echo "\"codMatricula\":\"".$row["codMatricula"]."\",";
	echo "\"aulasDadas\":\"".$total_aulas_dadasF."\",";
	echo "\"faltas\":\"".$totaldefaltas."\",";
	echo "\"frequencia\":\"".$freq_p."\",";
	$resultado = "Indefinido";
	$tem_I = false;
	while ($row = mysql_fetch_array($rsDisciplinas)){
		$codDisciplina = $row["codDisciplina"];

		//Verificar se o aluno é dispensado da disciplina
		$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula AND codDisciplina=$codDisciplina";
		$rsDispensa = mysql_query($sqlDispensa);
		if (mysql_num_rows($rsDispensa)>0) {
			echo "\"$codDisciplina\":\""."D"."\",";
			continue;
		}

		if ($status != "MA"){
			echo "\"$codDisciplina\":\"".$status."\",";
		}else{
			if ($etapa=="I") $sqlMencao = "SELECT mencaoIntermediaria as mencao FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa";
			if ($etapa=="2") $sqlMencao = "SELECT mencaoFinal as mencao FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa";
			if ($etapa=="F") $sqlMencao = "SELECT mencaoFinal as mencao FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa";
			$rsMencao = mysql_query($sqlMencao); //TODO só funciona para menção final
			if (mysql_num_rows($rsMencao)>0) $mencao = mysql_result($rsMencao, 0, "mencao"); else $mencao="";
			//echo $sqlMencao."<br>";
			echo "\"$codDisciplina\":\"".$mencao."\",";
			if ($mencao == "I" ) $tem_I = true;
		}
	}

	if ($etapa=="I"){

		//buscar dados da deliberação 11
		$resumo = "";
		if ($tem_I){
			$sqlDificuldade = "SELECT DISTINCT Dificuldades.codDificuldade, Dificuldades.descricaoDificuldade FROM Deliberacao11Dificuldade 
								INNER JOIN Dificuldades ON Dificuldades.codDificuldade=Deliberacao11Dificuldade.codDificuldade
								WHERE codMatricula=$codMatricula";
			$rsDificuldade = mysql_query($sqlDificuldade);
			$sqlProvidencia = "SELECT DISTINCT Providencias.codProvidencia, Providencias.descricaoProvidencia FROM Deliberacao11Providencia 
							INNER JOIN Providencias ON Providencias.codProvidencia=Deliberacao11Providencia.codProvidencia
							WHERE codMatricula=$codMatricula";
			$rsProvidencia = mysql_query($sqlProvidencia);

			$c = 0;
			while ($rowd = mysql_fetch_array($rsDificuldade)){
				$resumo .= ($c>0) ? ", " : "" ;
				$resumo .= ($rowd["codDificuldade"]);
				$c++;
			}
			$c = 0;
			$resumo .= " / ";
			while ($rowd = mysql_fetch_array($rsProvidencia)){
				$resumo .= ($c>0) ? ", " : "" ;
				$resumo .= ($rowd["codProvidencia"]);
				$c++;
			}
			
		}

		echo "\"resumo\":\"".$resumo."\",";
		echo "\"resultado\":\"".$resultado."\"";
	}else{
		//Buscas as PPs do aluno no modulo1
		$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
					INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
					INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
					INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
					WHERE Alunos.codAluno=$codAluno
					AND pendente=1
					AND modulo=1";
		$rsPP = mysql_query($sqlPP);
		$pp1 = "";
		$cont=0;
		while ($r=mysql_fetch_array($rsPP)){
			if ($cont>0) $pp1 .=", ";
			$pp1 .= $r["sigla"];
			$cont++;
		}

		//Buscas as PPs do aluno no modulo 2
		$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
					INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
					INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
					INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
					WHERE Alunos.codAluno=$codAluno
					AND pendente=1
					AND modulo=2";
		$rsPP = mysql_query($sqlPP);
		$pp2 = "";
		$cont=0;
		while ($r=mysql_fetch_array($rsPP)){
			if ($cont>0) $pp2 .=", ";
			$pp2 .= $r["sigla"];
			$cont++;
		}

		//Buscas as PPs do aluno no modulo 3
		$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
					INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
					INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
					INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
					WHERE Alunos.codAluno=$codAluno
					AND pendente=1
					AND modulo=3";
		$rsPP = mysql_query($sqlPP);
		$pp3 = "";
		$cont=0;
		while ($r=mysql_fetch_array($rsPP)){
			if ($cont>0) $pp3 .=", ";
			$pp3 .= $r["sigla"];
			$cont++;
		}

		echo "\"PP1\":\"".$pp1."\",";
		echo "\"PP2\":\"".$pp2."\",";		
		echo "\"PP3\":\"".$pp3."\"";		
	}

	
	echo "}";
	$cont++;
}
echo "]";
?>