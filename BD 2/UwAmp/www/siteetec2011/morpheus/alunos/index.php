<?php 

include "conexao/conn.php";
	
	$codAluno = $_SESSION["id"];
	
	//pegar a ultima matricula do aluno no sistema
	$sqlMatriculas = "SELECT * FROM Matriculas WHERE codAluno=$codAluno ORDER BY codMatricula DESC LIMIT 1";
	$rsMatriculas = mysql_query($sqlMatriculas);
	$codMatricula = mysql_result($rsMatriculas, 0, "codMatricula");
	$codturma = mysql_result($rsMatriculas, 0, "codTurma");

	
	//pegar as disciplinas da turma do aluno
	$sqlDisciplinas = "SELECT * FROM Disciplinas
						INNER JOIN Cursos ON Cursos.codCurso=Disciplinas.codCurso
						INNER JOIN Series ON Series.codCurso=Cursos.codCurso
						INNER JOIN Turmas ON Turmas.codSerie=Series.codSerie
						WHERE Turmas.codTurma = $codturma
						AND Disciplinas.modulo=Turmas.modulo
						ORDER BY numeroPlanoDeCurso";
    $rsDisciplinas = mysql_query($sqlDisciplinas);

	//verificar se o aluno tem matricula
	if (mysql_num_rows($rsDisciplinas)<1){
		?>
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
					<strong>Atenção: </strong> Nenhuma matr�cula registrada. Procure a secretaria.</p>
				</div>
			</div>
		<?php
		exit();
	}

	
?>

<script type="text/javascript">
	$(function(){
		
	});

</script>

<div id="tabsboletim" class="tabs-bottom" >
<ul>
<?php

	while($rowDisciplina = mysql_fetch_array($rsDisciplinas)){  
		$id = $rowDisciplina["codDisciplina"];
		$codturma = $rowDisciplina["codTurma"];
		$sigla = $rowDisciplina['sigla'];
		$turma = $rowDisciplina['modulo'].$rowDisciplina['serie'];
		echo "<li><a href='alunos/form_notas.php?coddisciplina=$id&codturma=$codturma&codmatricula=$codMatricula'>$sigla</a></li>\n";
	}
	echo "<li><a href='alunos/form_notas.php?coddisciplina=0&codturma=$codturma&codmatricula=$codMatricula'><strong>BOLETIM</strong></a></li>\n";
	echo "</ul>";

   
?>
</div>