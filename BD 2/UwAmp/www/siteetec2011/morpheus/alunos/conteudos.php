<style type="text/css">
table.conteudo td{
	font-size: 0.8em;
}
</style>

<?php
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");



include '../conexao/conn.php';

$codAluno = $_SESSION["id"];

//pegar a ultima matricula do aluno no sistema
$sqlMatriculas = "SELECT * FROM Matriculas WHERE codAluno=$codAluno ORDER BY codMatricula DESC LIMIT 1";
$rsMatriculas = mysql_query($sqlMatriculas);
$codMatricula = mysql_result($rsMatriculas, 0, "codMatricula");
$codTurma = mysql_result($rsMatriculas, 0, "codTurma");

//Buscar todo os encontros da turma
$sqlEncontros = "SELECT data, conteudo, qtdeAulas, Disciplinas.sigla as disciplina 
					FROM Encontros 
					INNER JOIN Disciplinas ON Disciplinas.codDisciplina=Encontros.codDisciplina
					WHERE codTurma=$codTurma ORDER BY data";
$rsEncontros = mysql_query($sqlEncontros);
?>

<table class="table table-hover conteudo">
	<thead>
	<tr>
		<th>Data</th>
		<th>Disciplina</th>
		<th>Conte&uacute;do</th>
		<th>Aulas</th>
	</tr>
	</thead>
	<tbody>
	<?php 

	while ($encontro = mysql_fetch_array($rsEncontros)) { 
		$data = $encontro["data"];
		$data_formatada = strftime("%a %d/%m", strtotime($data));	
		echo "<tr>";
		echo "<td  class='data'>".$data_formatada."</td>";
		echo "<td>".$encontro["disciplina"]."</td>";
		echo "<td>".$encontro["conteudo"]."</td>";
		echo "<td>".$encontro["qtdeAulas"]."</td>";
		echo "</tr>";
	 } 
	 ?>

	</tbody>
</table>

