<?php 


	/* é incluido no arquivo index.php para preencher 
	a arvore de matérias do professor
	*/
	$codProf = $_SESSION["id"];
	
	//pegar todas as turmas que o professor dá aula
	$sql = "select distinct Turmas.codTurma, Turmas.modulo, Series.serie, Series.codSerie, Cursos.codCurso, Cursos.habilitacao, Periodos.descricaoPeriodo, Atribuicoes.codProfessor, Professores.nomeProfessor ".
			"FROM Turmas ".
			"INNER JOIN Series ON Turmas.codSerie=Series.codSerie ".
			"INNER JOIN Cursos ON Series.codCurso=Cursos.codCurso ".
			"INNER JOIN Periodos ON Series.codPeriodo=Periodos.codPeriodo ".
			"INNER JOIN Disciplinas ON Cursos.codCurso=Disciplinas.codCurso AND Turmas.modulo=Disciplinas.modulo ".
			"INNER JOIN Atribuicoes ON Disciplinas.codDisciplina=Atribuicoes.codDisciplina AND Series.codSerie=Atribuicoes.codSerie ".
			"INNER JOIN Professores ON Atribuicoes.codProfessor=Professores.codProfessor ".
			"WHERE Atribuicoes.codProfessor=$codProf";
	$rsTurmas = mysql_query($sql);

	//verificar se o professor tem disciplinas cadastradas
	if (mysql_num_rows($rsTurmas)<1){
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
<ul class="easyui-tree" id="treeTurmas"> 
<?php
while($rowTurmas = mysql_fetch_array($rsTurmas)){  
	$codTurma = $rowTurmas["codTurma"];
    $modulo = $rowTurmas["modulo"];
    $codSerie = $rowTurmas["codSerie"];
    $codCurso = $rowTurmas["codCurso"];
    $turma = $modulo.$rowTurmas["serie"]." - ".$rowTurmas["habilitacao"]." ".$rowTurmas["descricaoPeriodo"];
	echo "<li state='closed'>";
    echo "<span>".$turma."</span>";

$sqlDisciplinas = "SELECT Disciplinas.codDisciplina, Disciplinas.disciplina
						FROM Disciplinas
						INNER JOIN Atribuicoes ON Atribuicoes.codDisciplina = Disciplinas.codDisciplina
						INNER JOIN Series ON Series.codSerie = Atribuicoes.codSerie
						INNER JOIN Turmas ON Turmas.codSerie = Series.codSerie
						WHERE codProfessor = $codProf
						AND Disciplinas.modulo = $modulo
						AND Turmas.codTurma = $codTurma
						AND Disciplinas.codCurso = $codCurso";
    					
    $rsDisciplinas = mysql_query($sqlDisciplinas);

	echo "<ul>";
	while($rowDisciplina = mysql_fetch_array($rsDisciplinas)){  
		$id = $rowDisciplina["codDisciplina"];
		$codTurma = $rowTurmas["codTurma"];
		echo "<li>";
		echo "<span title=42>".$rowDisciplina["disciplina"]."<font color=#ffffff>[#$id#$codTurma#]</font>"."</span>";
		echo "</li>";  
	}
	echo "</ul>";
   echo "</li>";
}  

?>

</ul>

