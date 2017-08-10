<?php

include '../conexao/conn.php';

$codAluno = $_SESSION["id"];

//pegar a ultima matricula do aluno no sistema
$sqlMatriculas = "SELECT * FROM Matriculas WHERE codAluno=$codAluno ORDER BY codMatricula DESC LIMIT 1";
$rsMatriculas = mysql_query($sqlMatriculas);
$codMatricula = mysql_result($rsMatriculas, 0, "codMatricula");
$codTurma = mysql_result($rsMatriculas, 0, "codTurma");



//Buscar dados do aluno
$sql = "SELECT Alunos.codAluno, Alunos.nomeAluno, Turmas.modulo, Series.serie, Alunos.rg, Cursos.habilitacao, Periodos.descricaoPeriodo, Matriculas.status, Matriculas.codMatricula, Cursos.codCurso FROM Alunos 
		INNER JOIN Matriculas ON Matriculas.codAluno=Alunos.codAluno
		INNER JOIN Turmas ON Turmas.codTurma = Matriculas.codTurma
		INNER JOIN Series ON Series.codSerie=Turmas.codSerie
		INNER JOIN Cursos ON Cursos.codCurso=Series.codCurso
		INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
		WHERE Alunos.codAluno=$codAluno
		AND Turmas.codTurma=$codTurma";

$rs = mysql_query($sql);
echo mysql_error();

$aluno = mysql_fetch_assoc($rs);
$codAluno = $aluno["codAluno"];
$codMatricula = $aluno["codMatricula"];
$status = $aluno["status"];

?>

<style type="text/css">
.vermelho {
	color: red;
	font-weight: bold;
}
.mencao{
	cursor: pointer;
}
</style>


<?php 

//Buscar disciplinas do módulo
$codCurso = $aluno["codCurso"];
$modulo = $aluno["modulo"];

$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ORDER BY numeroPlanoDeCurso";
$rsDisciplinas = mysql_query($sqlDisciplinas);
//echo $sqlDisciplinas;
echo mysql_error();

?>

<table class="table table-hover">
	<thead>
	<tr>
		<th>Sigla</th>
		<th>Disciplina</th>
		<th>Aulas</th>
		<th>Faltas</th>
		<th>%</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$soma_aulas = 0;
	$soma_faltas = 0;
	while ($disciplina = mysql_fetch_array($rsDisciplinas)) { 
		$codDisciplina = $disciplina["codDisciplina"];

		//Verificar se o aluno tem dispensa na disciplina
		$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula AND codDisciplina=$codDisciplina";
		$rsDispensa = mysql_query($sqlDispensa);
		if (mysql_num_rows($rsDispensa)>0){
			echo "<tr>";
			echo "<td>".$disciplina["sigla"]."</td>";
			echo "<td>".$disciplina["disciplina"]."</td>";
			echo "<td colspan=3>Dispensado</td>";
			echo "</tr>";
			continue;
		}

		//Buscar aulas dadas

		$sqlAulasDadas = "SELECT SUM(qtdeAulas)*1.25 as aulasDadas FROM Encontros 
								WHERE codTurma=$codTurma 
								AND codDisciplina=$codDisciplina";
								
		$rsAulasDadas = mysql_query($sqlAulasDadas);
		$total_aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");
		$total_aulas_dadas = number_format($total_aulas_dadas,1);
		$soma_aulas += $total_aulas_dadas;


		//echo $sqlAulasDadas;
		//Pegar as faltas digitadas
			$sqlTotalFaltas = "SELECT count(codChamada) as faltas, Encontros.codDisciplina FROM Faltas
										INNER JOIN Aulas ON Aulas.codAula=Faltas.codAula
										INNER JOIN Encontros ON Encontros.codEncontro=Aulas.codEncontro
										INNER JOIN Turmas ON Turmas.codTurma=Encontros.codTurma
										INNER JOIN Disciplinas ON Disciplinas.codDisciplina = Encontros.codDisciplina
										WHERE codAluno=$codAluno
										AND Encontros.codTurma=$codTurma
										AND Disciplinas.codDisciplina=$codDisciplina";

			$rsTotalFaltas = mysql_query($sqlTotalFaltas);
			$total_faltas = mysql_result($rsTotalFaltas, 0 , "faltas");
			$total_faltas = $total_faltas * 1.25;
			$total_faltas = number_format($total_faltas, 1);

			//echo $sqlTotalFaltas."<br>";

		$soma_faltas += $total_faltas;
		$freq_p = (1 - ($total_faltas / $total_aulas_dadas) )* 100; 	
		$freq_p = number_format($freq_p,2);

		echo "<tr>";
		echo "<td>".$disciplina["sigla"]."</td>";
		echo "<td>".$disciplina["disciplina"]."</td>";
		echo "<td>".$total_aulas_dadas."</td>";
		echo "<td>".$total_faltas."</td>";
		$cor = ($freq_p < 75)?"vermelho":"preto";
		echo "<td><div class=$cor>".$freq_p."%</div></td>";
		echo "</tr>";
	 } 


	 $freq_total = (1 - ($soma_faltas / $soma_aulas) ) * 100;
	 $freq_total = number_format($freq_total,1);
	 $cor = ($freq_total<75)?"vermelho":"preto";

	 $span=2;

	 ?>
	 <tr>
	 	<th colspan=2 style="text-align:right">TOTAL</th>
	 	<th><?php echo $soma_aulas; ?></th>
	 	<th><?php echo $soma_faltas; ?></th>
	 	<th><div class=<?php echo $cor; ?> ><?php echo $freq_total; ?>%</div></th>
	 </tr>

	</tbody>
</table>

