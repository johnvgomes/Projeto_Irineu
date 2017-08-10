<?php 
include '../../conexao/conn.php';

// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Etapas WHERE atual=1");
$codEtapa = mysql_result($rsEtapaAtual, 0);

$turma = $_GET["turma"];
$modulo = substr($turma, 0, 1);
$serie = substr($turma, 1, 1);

//pegar o código da turma selecionada
$result = mysql_query ( " select Turmas.codTurma, Series.codCurso FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie WHERE modulo=$modulo and serie='$serie'");
$codTurma = mysql_result($result, 0, "codTurma");
$codCurso = mysql_result($result, 0, "codCurso");

//consultar as disciplinas da turma
$sqlDisciplinas =  "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ORDER BY Disciplina" ;
$rsDisciplinas = mysql_query ($sqlDisciplinas);

?>
<html>
	<head>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ETEC Capela do Socorro - Sistema Morpheus</title>
		<link type="text/css" href="../../jquery/css/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../../jquery/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
	
		<style type="text/css">
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 00px; margin-top: 0px}
			div#users-contain { width: 600px; margin: 20px 0; }
			div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
			div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: 0em 10px; text-align: left; }
		</style>	
	</head>
	
	<style>
	.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
	</style>
	<br><br><br>
<?php 

if (mysql_num_rows($rsDisciplinas)<1){
	?>
			<div class="ui-widget">
				<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
					<strong>Alerta:</strong> Nenhuma disciplina cadastrada para essa turma</p>
				</div>
			</div>
<?php 
}else{
	echo "<table class='ui-widget ui-widget-content'>";
	echo "<thead><tr class='ui-widget-header '>";
	echo "<th>Disciplina</th>";
	echo "<th>Menção Interm.</th>";
	echo "<th>Menção Final</th>";
	echo "</tr></thead><tbody>";
	
	while ($row = mysql_fetch_array($rsDisciplinas)){
		$codDisciplina = $row["codDisciplina"];
		$sqlEntregas = "SELECT date_format(ultimaAlteracaoI, '%d/%m/%Y %H:%i') AS ultimaAlteracaoI, ".
						"date_format(ultimaAlteracaoF, '%d/%m/%Y %H:%i') AS ultimaAlteracaoF, ".
						"Professores.nomeProfessor as profI, ".
						"Professores.nomeProfessor as profF ".
						"FROM EntregaDeMencoes ".
						"INNER JOIN Professores ON EntregaDeMencoes.codDigitadorI=Professores.codProfessor ".
						"WHERE codDisciplina=$codDisciplina AND codTurma=$codTurma AND codEtapa=$codEtapa";
		$rsEntregas = mysql_query($sqlEntregas);
		if (mysql_num_rows($rsEntregas)>0){
			echo "<tr><td>".$row["disciplina"]."</td>";
			echo "<td>Em ".mysql_result($rsEntregas, 0, "ultimaAlteracaoI")." por ".mysql_result($rsEntregas, 0, "profI")."</td>";
			if (mysql_result($rsEntregas, 0, "ultimaAlteracaoF")!="")
				echo "<td>Em ".mysql_result($rsEntregas, 0, "ultimaAlteracaoF")." por ".mysql_result($rsEntregas, 0, "profF")."</td>";
			else echo "<td>-</td>";
			echo "</tr>";
		}else{
			echo "<tr><td>".$row["disciplina"]."</td>";
			echo "<td>-</td>";
			echo "<td>-</td>";
			echo "</tr>";
		}
	}
	
	echo "</tbody></table>";
	
	
}


?>