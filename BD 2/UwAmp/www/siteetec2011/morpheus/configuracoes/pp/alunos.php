
<link type="text/css" href="../../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="../../includes/bootstrap.css">
	<script type="text/javascript">
	$(function(){
		$(".campo_pp").change(function () {
			var codmatricula = $(this).attr("codMatricula");
			var coddisciplina = $(this).attr("codDisciplina");
			var check = $(this).is(":checked");
			var pendente = 0;
			if (check) pendente = 1;
	
			//alert(concluido);

			$.post("gravar_pp.php", 
				{codmatricula: codmatricula, coddisciplina: coddisciplina, pendente: pendente })
	        .error(function() { alert("Erro ao gravar. Banco de Dados Indisponível"); }) 

        });

	});
	</script>

<?php 
include '../../conexao/conn.php';
$codTurma =   $_GET["codTurma"]; 

//pegar o código do curso
$result = mysql_query ( " select Turmas.codTurma, Series.codCurso FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie WHERE modulo=$modulo and serie='$serie'");
$codCurso = mysql_result($result, 0, "codCurso");

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

//pegar o código do curso
$result = mysql_query ( " select Turmas.codTurma, Series.codCurso FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie WHERE modulo=$modulo and serie='$serie'");
$codCurso = mysql_result($result, 0, "codCurso");

//consultar as disciplinas da turma
$sqlDisciplinas =  "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ORDER BY numeroPlanoDeCurso" ;
$rsDisciplinas = mysql_query ($sqlDisciplinas);		

//simplifiquei a consulta porque não estava retornando registro
//$sql = " select Alunos.codAluno, Alunos.nomeAluno, Matriculas.status, Matriculas.codMatricula, AulasDadas.aulasDadas, Frequencia.faltas, format((((aulasDadas-faltas)/aulasDadas)*100),1) as frequencia, DecisoesConselho.resumo, DecisoesConselho.resultado from Matriculas INNER JOIN Alunos ON Matriculas.codAluno=Alunos.codAluno INNER JOIN AulasDadas ON Matriculas.codTurma=AulasDadas.codTurma LEFT JOIN Frequencia ON Frequencia.codMatricula=Matriculas.codMatricula LEFT JOIN DecisoesConselho ON DecisoesConselho.codMatricula=Matriculas.codMatricula WHERE Matriculas.codTurma=$codTurma ORDER BY nomeAluno;";

$sql = "select Alunos.codAluno, (Alunos.nomeAluno) as nomeAluno, Matriculas.status, Matriculas.codMatricula, Matriculas.nChamada from Matriculas INNER JOIN Alunos ON Matriculas.codAluno=Alunos.codAluno WHERE Matriculas.codTurma=$codTurma ORDER BY nChamada;";
$rs = mysql_query($sql);
//echo $sql;

//Pegar nome do curso
$sqlCurso = "SELECT habilitacao FROM Cursos WHERE codCurso=$codCurso";
$rsCurso = mysql_query($sqlCurso);
$curso = mysql_result($rsCurso, 0, "habilitacao");

?>

<a class="btn btn-primary" href="relatorio.php?codCurso=<?php echo $codCurso;?>" target="_blank">Relatório de PP de <?php echo $curso;?></a>


<?php

$cont=0;
echo "<table class='table table-condensed'>";
echo "<tr><th>N</th><th>Nome</th>";
while($d = mysql_fetch_array($rsDisciplinas)){
	echo "<th>".$d["sigla"]."</th>";
}
echo "</tr>";
while($row = mysql_fetch_array($rs)){
	$rsDisciplinas = mysql_query ($sqlDisciplinas);
	
	$codAluno = $row["codAluno"];
	$status = $row["status"];
	$codMatricula = $row["codMatricula"];

	echo "<tr>";
	echo "<td>".$row["nChamada"]."</td>";
	echo "<td>".$row["nomeAluno"]."</td>";

	while ($row = mysql_fetch_array($rsDisciplinas)){
		$codDisciplina = $row["codDisciplina"];

		//verificar valor no banco de dados para mostrar no campo
		$sqlPP = "SELECT * FROM ProgressoesParciais WHERE
					codMatricula=$codMatricula
					AND codDisciplina=$codDisciplina
					AND pendente=1";
		$rsPP = mysql_query($sqlPP);
		$checked = (mysql_num_rows($rsPP)>0) ? "checked=checked" : "";

		if ($status != "MA"){
			echo "<td>".$status."</td>";
		}else{
			echo "<th>";
			echo "<input type=checkbox class='campo_pp' codMatricula=$codMatricula codDisciplina=$codDisciplina $checked> ";
			echo "</th>";
		}
	}

	echo "</tr>";
}

echo "</table>";
?>

