<?php 


	/* é incluido no arquivo index.php para preencher 
	a arvore de matérias do aluno
	*/
	$codAluno = $_SESSION["id"];
	
	//pegar todas as turmas em que o aluno foi matriculado
	$sql = "select distinct Turmas.codTurma, Turmas.modulo, Series.serie, Series.codSerie, Cursos.codCurso, Cursos.habilitacao, Periodos.descricaoPeriodo, Etapas.etapa, Matriculas.codMatricula, Alunos.nomeAluno
			FROM Turmas 
			INNER JOIN Series ON Turmas.codSerie=Series.codSerie
			INNER JOIN Cursos ON Series.codCurso=Cursos.codCurso
			INNER JOIN Matriculas ON Matriculas.codTurma=Turmas.codTurma
			INNER JOIN Etapas ON Etapas.codEtapa=Matriculas.codEtapa
			INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
			INNER JOIN Periodos ON Series.codPeriodo=Periodos.codPeriodo 
			INNER JOIN Disciplinas ON Cursos.codCurso=Disciplinas.codCurso AND Turmas.modulo=Disciplinas.modulo
			WHERE Alunos.codAluno=$codAluno";

	$rsTurmas = mysql_query($sql);

	//verificar se o professor tem disciplinas cadastradas
	if (mysql_num_rows($rsTurmas)<1){
		?>
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
					<strong>Atenção: </strong> Nenhuma matrícula no seu nome. Procure a secretaria.</p>
				</div>
			</div>
		<?php
		exit();
	}

	
?>
<ul class="easyui-tree" id="treeTurmas"> 
<?php
while($rowTurmas = mysql_fetch_array($rsTurmas)){  
    $modulo = $rowTurmas["modulo"];
    $codSerie = $rowTurmas["codSerie"];
    $codCurso = $rowTurmas["codCurso"];
    $turma = $modulo.$rowTurmas["serie"]." - ".$rowTurmas["habilitacao"]." ".$rowTurmas["descricaoPeriodo"];
	echo "<li state='closed'>";
    echo "<span>".$turma."</span>";

    $sqlDisciplinas = "SELECT Disciplinas.codDisciplina, Disciplinas.disciplina FROM Disciplinas ".
    					"WHERE modulo=$modulo ".
    					"AND codCurso=$codCurso";

    $rsDisciplinas = mysql_query($sqlDisciplinas);

	echo "<ul>";
	while($rowDisciplina = mysql_fetch_array($rsDisciplinas)){  
		$id = $rowDisciplina["codDisciplina"];
		$codTurma = $rowTurmas["codTurma"];
		echo "<li>";
		echo "<span title=42>".$rowDisciplina["disciplina"]."<font color=#ffffff>[#$id#$codTurma#]</font>"."</span>";
		echo "</li>";  
	}
	echo "<li><span title=42><strong>Boletim</strong><font color=#ffffff>[#0#$codTurma#]</font></span></li>";
	echo "</ul>";
   echo "</li>";
  
}  

?>

</ul>