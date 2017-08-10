<?php 
include '../../conexao/conn.php';
$codCurso =   $_GET["codCurso"]; 

$sqlCabecalho = "SELECT * FROM Cursos 
					WHERE codCurso=$codCurso ";
$rsCabecalho = mysql_query($sqlCabecalho);

$habilitacao = mysql_result($rsCabecalho, 0, "habilitacao");

$ordem = 1;

//pegar todas as turmas do curso
$sqlTurmas = "SELECT Turmas.codTurma FROM Turmas 
				INNER JOIN Series ON Series.codSerie=Turmas.codSerie 
				WHERE Series.codCurso=$codCurso";
$rsTurmas = mysql_query($sqlTurmas);

?>

<html>
<head>
	<meta charset="UTF8">
</head>

<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Relatório de PP</title>
		<link rel="stylesheet" href="bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../../jquery/jquery-1.6.min.js"></script>

<style>
table {
	font-size: 8px;
}
td {
	padding: 1px;
}
th {
	background-color: #969696; /* cinza escuro */
	font-size: 10pt;
}
.espacado td {
	padding: 2px 1px;
}
.avaliacoes, .resumo {
	float: left;
	margin: 8px;
	text-align: center;
	border: 1px solid #000;
	padding: 15px;
}
.maior {
	font-size: 150%;
}
.quebraPagina {
	page-break-after: always;
}
</style>

<table class="relatorio">
	<tr>
		<td colspan="3"	 style="border:0px;"><img src="logoPaulaSouza.png" style="width: 300px;"></td>
		<td colspan="7" style="background-color:#DEDEDE;" class="centro maior">
			<h2>Controle dos Alunos em Progressão Parcial </h2> <h3><?php echo $habilitacao; ?></h3>
		</td>
	</tr>
	<tr>
		<th>Ordem</th>
		<th>Nome do Aluno</th>
		<th>Período</th>
		<th>PP na Série/Módulo</th>
		<th>Semestre/Ano</th>
		<th>Componente Curricular</th>
		<th>Professor Responsável</th>
		<th>Concluiu em</th>
		<th>Menção</th>
		<th>Motivo</th>

	</tr>

	<?php

	while ($rowTurmas = mysql_fetch_array($rsTurmas)) {
		$codTurma = $rowTurmas["codTurma"];
		$sqlAlunos = "SELECT Alunos.nomeAluno, Periodos.descricaoPeriodo, Turmas.modulo, Series.serie, Etapas.etapa, Disciplinas.disciplina, Disciplinas.codDisciplina, Matriculas.codMatricula FROM Alunos
						INNER JOIN Matriculas ON Matriculas.codAluno=Alunos.codAluno 
						INNER JOIN ProgressoesParciais ON ProgressoesParciais.codMatricula=Matriculas.codMatricula
						INNER JOIN Turmas ON Turmas.codTurma=Matriculas.codTurma
						INNER JOIN Series ON Series.codSerie=Turmas.codSerie
						INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
						INNER JOIN Etapas ON Etapas.codEtapa=Turmas.codEtapa
						INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
						WHERE Matriculas.codTurma=$codTurma";
		$rsAlunos = mysql_query($sqlAlunos);		
		
		while ($rowAluno = mysql_fetch_array($rsAlunos)) {
			$codDisciplina = $rowAluno["codDisciplina"];
			$codMatricula = $rowAluno["codMatricula"];
			
			//buscar dados da PP
			$sqlPP = "SELECT * FROM ProgressoesParciais WHERE codDisciplina=$codDisciplina AND codMatricula=$codMatricula";
			$rsPP = mysql_query($sqlPP);
			$rowPP = mysql_fetch_array($rsPP);
			$responsavel = $rowPP["responsavel"];
			$concluiuEm = $rowPP["concluiuEm"];
			if ($concluiuEm=="0000-00-00"){
				$concluiuEm = "";
			}else{
				$concluiuEm = implode("/",array_reverse(explode("-",$concluiuEm)));				
			}
			$mencao = $rowPP["mencao"];
			$motivo = $rowPP["motivo"];

			echo "<tr>";
			echo "<td>".$ordem."</td>";
			echo "<td>".$rowAluno["nomeAluno"]."</td>";
			echo "<td>".$rowAluno["descricaoPeriodo"]."</td>";
			echo "<td>".$rowAluno["modulo"].$rowAluno["serie"]."</td>";
			echo "<td>".$rowAluno["etapa"]."</td>";
			echo "<td>".$rowAluno["disciplina"]."</td>";
			echo "<td>".$responsavel."</td>";
			echo "<td>".$concluiuEm."</td>";
			echo "<td>".$mencao."</td>";
			echo "<td>".$motivo."</td>";
			echo "</tr>";
			$ordem++;
		}
	}
	?>

</table>
