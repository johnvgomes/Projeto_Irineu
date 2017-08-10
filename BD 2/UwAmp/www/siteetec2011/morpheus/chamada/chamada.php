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

echo $sqlDisciplinas;
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
<div id="radio_mes">
	<?php 

		if (isset($_SESSION["mes"])){
			$mes = intval($_SESSION["mes"]);
		}else{
			$mes = intval(date("m")); 
			$_SESSION["mes"]=$mes;
		}

/*
	<input type="radio" value="2"  id="fevereiro" name="mes" <?php echo ($mes==2)?"checked=checked":"";?>/><label for="fevereiro">fevereiro</label>         
	<input type="radio" value="3"  id="marco" name="mes" 	<?php echo ($mes==3)?"checked=checked":"";?>/><label for="marco">março</label>      
	<input type="radio" value="4"  id="abril" name="mes" <?php echo ($mes==4)?"checked=checked":"";?>/><label for="abril">abril</label>
	<input type="radio" value="5" id="maio" name="mes" 	<?php echo ($mes==5)?"checked=checked":"";?>/><label for="maio">maio</label>   
	<input type="radio" value="6" id="junho" name="mes" <?php echo ($mes==6)?"checked=checked":"";?>/><label for="junho">junho</label>
	<input type="radio" value="7" id="julho" name="mes" <?php echo ($mes==7)?"checked=checked":"";?>/><label for="julho">julho</label>
*/
?>
	<input type="radio" value="7"  id="julho" name="mes" <?php echo ($mes==7)?"checked=checked":"";?>/><label for="julho">julho</label>         
	<input type="radio" value="8"  id="agosto" name="mes" 	<?php echo ($mes==8)?"checked=checked":"";?>/><label for="agosto">agosto</label>      
	<input type="radio" value="9"  id="setembro" name="mes" <?php echo ($mes==9)?"checked=checked":"";?>/><label for="setembro">setembro</label>
	<input type="radio" value="10" id="outubro" name="mes" 	<?php echo ($mes==10)?"checked=checked":"";?>/><label for="outubro">outubro</label>   
	<input type="radio" value="11" id="novembro" name="mes" <?php echo ($mes==11)?"checked=checked":"";?>/><label for="novembro">novembro</label>
	<input type="radio" value="12" id="dezembro" name="mes" <?php echo ($mes==12)?"checked=checked":"";?>/><label for="dezembro">dezembro</label>
</div>

<div id="tabschamada" class="tabs-bottom" >
<ul>
<?php

	while($rowDisciplina = mysql_fetch_array($rsDisciplinas)){  
		$id = $rowDisciplina["codDisciplina"];
		$codturma = $rowDisciplina["codTurma"];
		$sigla = $rowDisciplina['sigla'];
		$turma = $rowDisciplina['modulo'].$rowDisciplina['serie'];
		echo "<li><a href='chamada/form_chamada.php?coddisciplina=$id&codturma=$codturma'>$sigla ($turma)</a></li>\n";
	}
	echo "</ul>";

   
?>
<p>*por padrão todos os alunos estão presentes, desmarque as aulas em que o aluno faltou.</p>
</div>


