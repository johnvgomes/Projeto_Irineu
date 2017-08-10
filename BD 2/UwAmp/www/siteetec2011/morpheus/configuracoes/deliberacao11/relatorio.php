<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Relatório Deliberação 11</title>
		<link rel="stylesheet" href="bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
<?php

//verificar se usuário está logado e se tem permissões
session_name('jcLogin');
session_start();

$codMatricula = $_GET["codMatricula"];

include '../../conexao/conn.php';

$sqlAluno = "SELECT f_remove_acentos(Alunos.nomeAluno) as nomeAluno, Alunos.codAluno, Matriculas.nChamada, Cursos.habilitacao, Periodos.descricaoPeriodo, concat(Turmas.modulo,Series.serie) as turma, Turmas.modulo, Cursos.codCurso, Turmas.codEtapa, Series.codSerie FROM Alunos
				INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno
				INNER JOIN Turmas ON Turmas.codTurma=Matriculas.codTurma
				INNER JOIN Series ON Series.codSerie=Turmas.codSerie
				INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
				INNER JOIN Cursos ON Cursos.codCurso=Series.codCurso
				WHERE codMatricula=$codMatricula ";
$rsAluno = mysql_query($sqlAluno);

$codCurso = mysql_result($rsAluno, 0, "codCurso");
$modulo = mysql_result($rsAluno, 0, "modulo");
$codEtapa = mysql_result($rsAluno, 0, "codEtapa");
$codSerie = mysql_result($rsAluno, 0, "codSerie");
$codAluno = mysql_result($rsAluno, 0, "codAluno");

$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo";
$rsDisciplina = mysql_query($sqlDisciplinas);

?>
<style>
table {
	font-size: 8px;
}
td {
	padding: 1px;
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
.box {
	height: 25px;
	border: solid 1px;
	text-align: center;
	text-transform: bold;
	font-size: 12pt;
	padding-top: 7px;
}
td{
	font-size: 9pt;
	height: 15px;
}
.pqno td{
	font-size: 8pt;
}
</style>
</head>
<body>
<p align=center><img src="logo_relatorio.png"></p>
<div class="box">FICHA INDIVIDUAL DE AVALIAÇÃO PERIÓDICA – Deliberação CEE 11/96</div>
<br>
<table class="relatorio">
	<tr>
		<td><strong>Aluno:</strong></td>
		<td colspan=3><?php echo mysql_result($rsAluno, 0, "nomeAluno") ?></td>
		<td><strong>Número:</strong></td>
		<td class="centro"><?php echo mysql_result($rsAluno, 0, "nChamada") ?></td>
	</tr>
	<tr>
		<td><strong>Curso:</strong></td>
		<td><?php echo mysql_result($rsAluno, 0, "habilitacao") ?></td>
		<td><strong>Período:</strong></td>
		<td><?php echo mysql_result($rsAluno, 0, "descricaoPeriodo") ?></td>
		<td><strong>Módulo/Série:</strong></td>
		<td class="centro"><?php echo mysql_result($rsAluno, 0, "turma") ?></td>
	</tr>
	<tr>
		<td colspan=4>Resultado da Avaliação Parcial correspondente ao Conselho de Classe Intermediário realizado em:</td>
		<td colspan=2> __________ / __________ / _________</td>
	</tr>

</table>
<br>

<table class="relatorio pqno">
<tr>
	<td class="centro"><strong>Componente Curricular</strong></td>
	<td class="centro"><strong>Professor</strong></td>
	<td class="centro"><strong>Menção do Aluno</strong></td>
	<td class="centro"><strong>Principais dificuldades do aluno (I)</strong></td>
	<td class="centro"><strong>Recomendações ao aluno/responsável (II )</strong></td>
	<td class="centro"><strong>Providências da escola(III)</strong></td>
	<td class="centro"><strong>Acompanhamento da  Coordenação</strong></td>
</tr>
<?php 
while ($r = mysql_fetch_array($rsDisciplina)) { 
	$codDisciplina = $r["codDisciplina"];
	$sqlProfessores = "SELECT DISTINCT Professores.nomeProfessor FROM Professores 
						INNER JOIN Atribuicoes ON Atribuicoes.codProfessor=Professores.codProfessor
						INNER JOIN Series ON Series.codSerie=Atribuicoes.codSerie
						INNER JOIN Turmas ON Turmas.codSerie=Series.codSerie
						WHERE codDisciplina=$codDisciplina AND Atribuicoes.codEtapa=$codEtapa AND Series.codSerie=$codSerie";
	$rsProfessores = mysql_query($sqlProfessores);

	$sqlMencao = "SELECT * FROM Mencoes WHERE codDisciplina=$codDisciplina AND codAluno=$codAluno AND codEtapa=$codEtapa";
	$rsMencao = mysql_query($sqlMencao);
	if (mysql_num_rows($rsMencao)>0) $mencao = mysql_result($rsMencao, 0, "mencaoIntermediaria"); else $mencao = "";

	$sqlDificuldade = "SELECT Dificuldades.codDificuldade, Dificuldades.descricaoDificuldade FROM Deliberacao11Dificuldade 
						INNER JOIN Dificuldades ON Dificuldades.codDificuldade=Deliberacao11Dificuldade.codDificuldade
						WHERE codDisciplina=$codDisciplina AND codMatricula=$codMatricula";
	$rsDificuldade = mysql_query($sqlDificuldade);
		
	$sqlRecomendacoes = "SELECT Recomendacoes.codRecomendacao, Recomendacoes.descricaoRecomendacao FROM Deliberacao11Recomendacao 
						INNER JOIN Recomendacoes ON Recomendacoes.codRecomendacao=Deliberacao11Recomendacao.codRecomendacao
						WHERE codDisciplina=$codDisciplina AND codMatricula=$codMatricula";
	$rsRecomendacao = mysql_query($sqlRecomendacoes);

	$sqlProvidencia = "SELECT Providencias.codProvidencia, Providencias.descricaoProvidencia FROM Deliberacao11Providencia 
						INNER JOIN Providencias ON Providencias.codProvidencia=Deliberacao11Providencia.codProvidencia
						WHERE codDisciplina=$codDisciplina AND codMatricula=$codMatricula";
	$rsProvidencia = mysql_query($sqlProvidencia);


	?>
<tr>
	<td> <?php echo $r["disciplina"] ?></td>
	<td> <?php 
		$cont=0;
		while ($rowp = mysql_fetch_array($rsProfessores)) {
			echo ($cont>0) ? " e " : "" ;
			echo $rowp["nomeProfessor"];
			$cont++;
	} ?></td>
	<td class="centro <?php echo ($mencao=='I')?'red':'';?> "><?php echo $mencao; ?></td>
	<td> 
		<?php
		if ($mencao=="I"){
			while ($rowd = mysql_fetch_array($rsDificuldade)){
				echo $rowd["codDificuldade"]." - ".($rowd["descricaoDificuldade"])."<br>";
			}
		}
		?>
	</td>
	<td>
		<?php
		if ($mencao=="I"){
			
			while ($rowr = mysql_fetch_array($rsRecomendacao)){
				echo $rowr["codRecomendacao"]." - ".($rowr["descricaoRecomendacao"])."<br>";
			}
		}
		?>
	</td>
	<td>
		<?php
		if ($mencao=="I"){
			
			while ($rowp = mysql_fetch_array($rsProvidencia)){
				echo $rowp["codProvidencia"]." - ".($rowp["descricaoProvidencia"])."<br>";
			}
		}
		?>

	</td>
	<td></td>
</tr>

<?php 	
}
?>


</table>

<br><br><br><br>
<div style='float:left;width:200px;white-space: nowrap ;'> Data: ________  /  ________  /  ________</div> 
<div style='float:left;margin-left:50px;border-top:solid 1px;width:200px;white-space: nowrap ;'> Coordenador do Curso</div> 
<div style='float:left;margin-left:50px;border-top: solid 1px;width:200px;white-space: nowrap ;'><?php echo mysql_result($rsAluno, 0, "nomeAluno")?> </div>
<div style='float:left;margin-left:50px;border-top: solid 1px;width:200px;white-space: nowrap ;'>Responsável (se menor) </div>
 
	
</body></html>
