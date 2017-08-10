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

<div id="tabsavaliacoes" class="tabs-bottom" >
<ul>
<?php
	while($rowDisciplina = mysql_fetch_array($rsDisciplinas)){  
		$id = $rowDisciplina["codDisciplina"];
		$codturma = $rowDisciplina["codTurma"];
		$sigla = $rowDisciplina['sigla'];
		$turma = $rowDisciplina['modulo'].$rowDisciplina['serie'];
		echo "<li><a href='new_notas/form_avaliacoes.php?coddisciplina=$id&codturma=$codturma'>$sigla ($turma)</a></li>\n";
	}
	echo "</ul>";

   
?>

</div>

<div id="dialog-form-ava" title="Editar Avaliação">
	<form id="form-edit-ava">
	<fieldset><br><br>
		<input type="hidden" name="edit_cod" id="edit_cod" />
		<label for="sigla">Sigla</label>
		<input type="text" name="edit_sigla" id="edit_sigla" size='10' class="text ui-widget-content ui-corner-all" /><br><br>
		<label for="descricao">Descrição</label>
		<input type="text" name="edit_descricao" size='100' id="edit_descricao" value="" class="text ui-widget-content ui-corner-all" /><br><br>
		<label for="data">Data</label>
		<input type="text" name="edit_data_ava" id="edit_data_ava" size='10' class="text ui-widget-content ui-corner-all" /><br><br>
	</fieldset>
	</form>
</div>