<?php

include '../../conexao/conn.php';

$codTurma = $_GET["codTurma"];
$etapa = $_GET["etapa"];

// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Etapas WHERE atual=1");
$codEtapa = mysql_result($rsEtapaAtual, 0);

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

$sql = "select Alunos.codAluno, f_remove_acentos(Alunos.nomeAluno) as nomeAluno, Matriculas.status, Matriculas.codMatricula, Matriculas.nChamada from Matriculas INNER JOIN Alunos ON Matriculas.codAluno=Alunos.codAluno WHERE Matriculas.codTurma=$codTurma ORDER BY nChamada;";
$rs = mysql_query($sql);
//echo $sql;

echo "[";
$cont=0;
while($row = mysql_fetch_array($rs)){
	$rsDisciplinas = mysql_query ($sqlDisciplinas);
	
	$codAluno = $row["codAluno"];
	$status = $row["status"];
	
	if ($cont!=0) echo ",";
	echo "{";
	echo "\"nChamada\":\"".$row["nChamada"]."\",";
	echo "\"nomeAluno\":\"".$row["nomeAluno"]."\",";
	echo "\"codMatricula\":\"".$row["codMatricula"]."\",";
	echo "\"aulasDadas\":\""."1"."\",";  //alteracao emergencial
	echo "\"faltas\":\""."0"."\","; //alteracao emergencial
	echo "\"frequencia\":\""."100"."\",";
	echo "\"resumo\":\""." "."\",";
	$resultado = "Indefinido";
	while ($row = mysql_fetch_array($rsDisciplinas)){
		$codDisciplina = $row["codDisciplina"];
		if ($status != "MA"){
			echo "\"$codDisciplina\":\"".$status."\",";
		}else{
			if ($etapa=="I") $sqlMencao = "SELECT mencaoIntermediaria as mencao FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa";
			if ($etapa=="F") $sqlMencao = "SELECT mencaoFinal as mencao FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa";
			$rsMencao = mysql_query($sqlMencao); //TODO só funciona para menção final
			if (mysql_num_rows($rsMencao)>0) $mencao = mysql_result($rsMencao, 0, "mencao"); else $mencao="";
			//echo $sqlMencao."<br>";
			echo "\"$codDisciplina\":\"".$mencao."\",";
		}
	}
	echo "\"resultado\":\"".$resultado."\"";
	
	echo "}";
	$cont++;
}
echo "]";
?>