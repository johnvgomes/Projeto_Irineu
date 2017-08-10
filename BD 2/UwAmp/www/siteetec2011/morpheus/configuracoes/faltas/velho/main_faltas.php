<?php 
include '../../conexao/conn.php';
$codTurma = $_GET["turma"];
//$modulo = substr($turma, 0, 1);
//$serie = substr($turma, 1, 1);

//pegar o código da turma selecionada
$result = mysql_query ( " select Turmas.codTurma, Series.codCurso, Turmas.codEtapa FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie WHERE codTurma=$codTurma'");
$codCurso = mysql_result($result, 0, "codCurso");
$codEtapa = mysql_result($result, 0, "codEtapa");

//consultar os alunos da turma
$sqlAlunos =  "SELECT Matriculas.nChamada, Matriculas.codMatricula, Alunos.codAluno, nomeAluno FROM Alunos INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno WHERE Matriculas.codTurma=$codTurma AND codEtapa=$codEtapa ORDER BY nChamada;" ;
$rsAlunos = mysql_query ($sqlAlunos);

//consultar número de aulas dadas
$sqlAulasDadas = "SELECT aulasDadas FROM AulasDadas WHERE codEtapa=$codEtapa AND codTurma=$codTurma";
$rsAulasDadas = mysql_query($sqlAulasDadas);
if (mysql_num_rows($rsAulasDadas)>0) $aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");
?>
<html>
	<head>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ETECIA - Sistema Morpheus</title>
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
	<script>
	$(function() {
		$("#msg").hide();


		$("#btn_gravar").button()
		.click(function(){
			$.post('gravar_faltas.php', $("#ffaltas").serialize(),function(result){
				if (result.success){
					$("#mensagem").html("Faltas salvas com sucesso");
				} else {
					$("#mensagem").html(result.msg);
				}
			},'json');

			$("#msg").show("blind", {} , function(){
				setTimeout(function() {
					$( "#msg:visible" ).fadeOut();
				}, 1000 );
			});
		});
	});
	</script>
	<br><br><br>
<?php 

if (mysql_num_rows($rsAlunos)<1){
	?>
			<div class="ui-widget">
				<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
					<strong>Atenção:</strong> Nenhum aluno matriculado nessa turma</p>
				</div>
			</div>
<?php 
}else{
	echo "<form id='ffaltas' method='post'>";
	echo "<input type=hidden name=codTurma value=$codTurma />";
	echo "<table class='ui-widget ui-widget-content'>";
	echo "<thead><tr class='ui-widget-header '>";
	echo "<th>Nome</th>";
	echo "<th>Faltas</th>";
	echo "</tr></thead><tbody>";
	
	while ($row = mysql_fetch_array($rsAlunos)){
		$codMatricula = $row["codMatricula"];
		$sqlFaltas = "SELECT * FROM Frequencia WHERE codMatricula=$codMatricula";
		$rsFaltas = mysql_query($sqlFaltas);
		$faltas = (mysql_num_rows($rsFaltas)>0)?mysql_result($rsFaltas, 0, "faltas"):"";
		echo "<tr><td>".$row["nomeAluno"]."</td>";
		echo "<td><input type=text name=$codMatricula value='$faltas' size=2 /></td>";
		echo "</tr>";
	}
	echo "<tr><th>Total de Aulas Dadas</th><th>";
	echo "<input type=text size=2  value='$aulas_dadas' name=aulas_dadas />";
	echo "</th></tr>";
	echo "</tbody></table>";
	echo "<input id='btn_gravar' type='button' value='Gravar'/>";
	echo "</form>";
	
	
}


?>

<div class="ui-widget" id="msg" style="width:200px;position:absolute;right:0;top:0">
	<div class="ui-state-highlight ui-corner-all" style="margin-top: 0px; padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<strong><div id="mensagem">Salvando...</div></strong></p>
	</div>
</div>	
