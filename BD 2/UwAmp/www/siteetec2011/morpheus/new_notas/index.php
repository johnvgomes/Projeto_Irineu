<?php 

include "conexao/conn.php";
	
	$codProf = $_SESSION["id"];
	
	// pegar as etapas atuais
	$rsEtapaAtual = mysql_query("SELECT codEtapa FROM Etapas WHERE atual=1 ORDER BY semestre");
	$codEtapaEM = mysql_result($rsEtapaAtual, 0, 0);
	$codEtapa = mysql_result($rsEtapaAtual, 1, 0);


	
	$sqlDisciplinas = "SELECT DISTINCT Turmas.codTurma, Turmas.modulo, Series.serie, Disciplinas.disciplina, Disciplinas.sigla, Disciplinas.codDisciplina FROM Atribuicoes
						INNER JOIN Disciplinas ON Disciplinas.codDisciplina=Atribuicoes.codDisciplina
						INNER JOIN Series ON Series.codSerie=Atribuicoes.codSerie
						INNER JOIN Turmas ON Turmas.codSerie=Series.codSerie
						WHERE codProfessor = $codProf
						AND (Atribuicoes.codEtapa=$codEtapa OR Atribuicoes.codEtapa=$codEtapaEM)
						AND Disciplinas.modulo=Turmas.modulo
						AND Turmas.codEtapa=Atribuicoes.codEtapa
					";
    					
    $rsDisciplinas = mysql_query($sqlDisciplinas);

	//verificar se o professor tem disciplinas cadastradas
	if (mysql_num_rows($rsDisciplinas)<1){
		?>
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
					<strong>Atenção: </strong> Nenhuma matéria cadastrada no seu nome. Procure a secretaria.</p>
				</div>
			</div>
		<?php
		exit();
	}

	
?>

<script type="text/javascript">
	$(function(){
		var dificuldade_check = false;
		var recomendacao_check = false;
		var providencia_check = false;

		$( "#dialog-deliberacao"  ).bind( "dialogopen", function(event, ui) {
  				$("#dificuldades").html("");
	        	$("#recomendacoes").html("");
	        	$("#providencias").html("");
	        	dificuldade_check = false;
				recomendacao_check = false;
				providencia_check = false;

	        	$( "#dialog-deliberacao" ).parent().find("button").attr('disabled', true);
					
		});

		$( "#dialog-deliberacao" ).dialog({
				autoOpen: false,
				resizable: false,
				height:600,
				width:800,
				modal: true,
				buttons: {
					salvar: function() {
						
						$( this ).dialog( "close" );
					}
				}
		})
		.dialog( "widget" ).find( ".ui-dialog-titlebar-close" ).hide();

		$( "#dialog-deliberacao" ).parent().find("button").attr('disabled', true);
        
    	
    	$("#combo_dificuldades").change(function(){
			var dificuldade = $("#combo_dificuldades option:selected").text();
			var codDificuldade = $("#combo_dificuldades option:selected").val();
			var codMatricula = $("#dialog-deliberacao").attr("codmatricula");
			var codDisciplina = $("#dialog-deliberacao").attr("coddisciplina");
			
			$.post("new_notas/gravar_deliberacao.php", 
				{codMatricula: codMatricula, codDisciplina: codDisciplina, valor: codDificuldade, campo: 'Dificuldade'},
				function(result){
					dificuldade_check = true;
					var cod = result;
					$("#dificuldades").append("<p style='clear:left'>"+dificuldade+"</p>");
					if (dificuldade_check && recomendacao_check && providencia_check) $( "#dialog-deliberacao" ).parent().find("button").attr('disabled', false);
				})
	        .error(function() { alert("Erro ao gravar Deliberação. Banco de Dados Indisponível"); })
		});

		$("#combo_recomendacoes").change(function(){
			var recomendacao = $("#combo_recomendacoes option:selected").text();
			var codRecomendacao = $("#combo_recomendacoes option:selected").val();
			var codMatricula = $("#dialog-deliberacao").attr("codmatricula");
			var codDisciplina = $("#dialog-deliberacao").attr("coddisciplina");
			
			$.post("new_notas/gravar_deliberacao.php", 
				{codMatricula: codMatricula, codDisciplina: codDisciplina, valor: codRecomendacao, campo: 'Recomendacao'},
				function(result){
					recomendacao_check = true;
					var cod = result;
					$("#recomendacoes").append("<p style='clear:left'>"+recomendacao+"</p>");
					if (dificuldade_check && recomendacao_check && providencia_check) $( "#dialog-deliberacao" ).parent().find("button").attr('disabled', false);
				})
	        .error(function() { alert("Erro ao gravar Deliberação. Banco de Dados Indisponível"); })
		});

		$("#combo_providencias").change(function(){
			var providencia = $("#combo_providencias option:selected").text();
			var codProvidencia = $("#combo_providencias option:selected").val();
			var codMatricula = $("#dialog-deliberacao").attr("codmatricula");
			var codDisciplina = $("#dialog-deliberacao").attr("coddisciplina");
			
			$.post("new_notas/gravar_deliberacao.php", 
				{codMatricula: codMatricula, codDisciplina: codDisciplina, valor: codProvidencia, campo: 'Providencia'},
				function(result){
					providencia_check = true;
					var cod = result;
					$("#providencias").append("<p style='clear:left'>"+providencia+"</p>");
					if (dificuldade_check && recomendacao_check && providencia_check) $( "#dialog-deliberacao" ).parent().find("button").attr('disabled', false);
				})
	        .error(function() { alert("Erro ao gravar Deliberação. Banco de Dados Indisponível"); })
		});

	});

</script>


<div id="tabsnotas" class="tabs-bottom" >
<ul>
<?php
	$fator=mysql_num_rows($rsDisciplinas);
	$tab=($fator*2)+1;
	while($rowDisciplina = mysql_fetch_array($rsDisciplinas)){  
		$id = $rowDisciplina["codDisciplina"];
		$codturma = $rowDisciplina["codTurma"];
		$sigla = $rowDisciplina['sigla'];
		$turma = $rowDisciplina['modulo'].$rowDisciplina['serie'];
		echo "<li><a href='new_notas/form_notas.php?coddisciplina=$id&codturma=$codturma&retorno=$tab'>$sigla ($turma)</a></li>\n";
		$tab++;
	}
	echo "</ul>";

   
?>

</div>

<div id="dialog-deliberacao" title="Deliberação 11" coddisciplina=0 codmatricula=0>
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		Ao definir uma menção intermediária como "Insuficiente", você deve preencher a Deliberação 11 com o diagnóstico do aluno</p>
		
		<div style="border: 1px gray solid; margin:10px;">
			<p><label for="combo_dificuldades"><strong>As principais dificuldades do aluno</strong></label><br>
			<select name="combo_dificuldades" id="combo_dificuldades">
				<?php 
				$sqlDificuldades = "SELECT * FROM Dificuldades";
				$rsDificuldades = mysql_query($sqlDificuldades);
				while ($r = mysql_fetch_array($rsDificuldades)){
					$codDificuldade = $r["codDificuldade"];
					$descricaoDificuldade = ($r["descricaoDificuldade"]);
					echo "<option value='$codDificuldade'>$codDificuldade - $descricaoDificuldade</option>";
				}
				?>
				
			</select></p>
			<div id="dificuldades"></div>
		</div>
		
		<div style="border: 1px gray solid; margin:10px;">
			<p><label for="combo_recomendacoes"><strong>Recomendações do Professor ao Aluno e aos  Pais ou Responsáveis</strong></label>
			<br><select name="combo_recomendacoes" id="combo_recomendacoes">
				<?php 
				$sqlRecomendacoes = "SELECT * FROM Recomendacoes";
				$rsRecomendacoes = mysql_query($sqlRecomendacoes);
				while ($r = mysql_fetch_array($rsRecomendacoes)){
					$codRecomendacao = $r["codRecomendacao"];
					$descricaoRecomendacao = ($r["descricaoRecomendacao"]);
					echo "<option value='$codRecomendacao'>$codRecomendacao - $descricaoRecomendacao</option>";
				}
				?>
				
			</select></p>
			<div id="recomendacoes"></div>
		</div>

		<div style="border: 1px gray solid; margin:10px;">
			<p><label for="combo_providencias"><strong>Providências do Professor e da Escola para auxiliar o aluno</strong></label>
			<br><select name="combo_providencias" id="combo_providencias">
				<?php 
				$sqlProvidencias = "SELECT * FROM Providencias";
				$rsProvidencias = mysql_query($sqlProvidencias);
				while ($r = mysql_fetch_array($rsProvidencias)){
					$codProvidencia = $r["codProvidencia"];
					$descricaoProvidencia = ($r["descricaoProvidencia"]);
					echo "<option value='$codProvidencia'>$codProvidencia - $descricaoProvidencia</option>";
				}
				?>
				
			</select></p>
			<div id="providencias"></div>
		</div>
</div>