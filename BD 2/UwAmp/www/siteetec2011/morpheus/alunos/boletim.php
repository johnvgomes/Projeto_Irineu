<?php 

$codAluno = $_SESSION["id"];
$codMatricula = $_GET["codmatricula"];			
	
//pegar as disciplinas da turma
$sqlDisciplinas = "SELECT * FROM Disciplinas 
					INNER JOIN Cursos ON Cursos.codCurso=Disciplinas.codCurso
					INNER JOIN Series ON Series.codCurso=Cursos.codCurso
					INNER JOIN Turmas ON Turmas.codSerie=Series.codSerie
					INNER JOIN Matriculas ON Matriculas.codTurma=Turmas.codTurma
					WHERE Turmas.modulo=Disciplinas.modulo
					AND Matriculas.codMatricula=$codMatricula";


	$rsDisciplinas = mysql_query($sqlDisciplinas);

	echo mysql_error();

	//echo $sqlDisciplinas;

 ?>
<br><br>
<table class='table'>
	<thead>
		<tr class='ui-widget-header '>
			<th>Disciplina</th>
			<th>Menção Intermediária</th>
			<th>Menção Final</th>
		</tr>
	</thead>
	<tbody>
		<?php

		while ($rowDisciplinas = mysql_fetch_array($rsDisciplinas)){
			echo "<tr>";
			echo "<td>".$rowDisciplinas['disciplina']."</td>";
			
			$codDisciplina = $rowDisciplinas['codDisciplina'];
				
			//buscar as menções da disciplina
			$sqlMencoes = "SELECT mencaoIntermediaria, mencaoFinal FROM Mencoes ".
											"WHERE codAluno=$codAluno ".
											"AND codDisciplina=$codDisciplina";
			$rsMencoes = mysql_query($sqlMencoes);
					
			//verifica se o aluno tem menção
			if (mysql_num_rows($rsMencoes)<1) {
				$mencaoI="-";
				$mencaoF="-";
				}else {
					$mencaoI = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
					$mencaoF = mysql_result($rsMencoes, 0, "mencaoFinal");
				}
			?>
			<td><?php echo $mencaoI; ?></td>
			<td><?php echo $mencaoF; ?></td>
		</tr>
		<?php
		}// fim do while das avaliacoes

			

		?>

	</tbody>
</table>
