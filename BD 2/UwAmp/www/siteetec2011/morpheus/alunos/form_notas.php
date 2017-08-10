<?php 

include "../conexao/conn.php";

session_name('jcLogin');
session_start();

$codTurma = $_GET['codturma'];
$codDisciplina = $_GET['coddisciplina'];
$codMatricula = $_GET['codmatricula'];

$sqlAluno = "SELECT Alunos.*, Matriculas.*, Turmas.codEtapa as Etapa FROM Alunos 
				INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno 
				INNER JOIN Turmas ON Turmas.codTurma=Matriculas.codTurma 
				WHERE Matriculas.codMatricula=$codMatricula";
$rsAluno = mysql_query($sqlAluno);
$codAluno = mysql_result($rsAluno, 0, "codAluno");
$codEtapa = mysql_result($rsAluno, 0, "Etapa");
	
if ($codDisciplina==0){
	echo "BOLETIM";
	include "boletim.php";
	exit();
}

$sqlAvaliacoes = "SELECT * FROM Avaliacoes ".
				"WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina";
$rsAvaliacoes = mysql_query($sqlAvaliacoes);

$sqlEntregas = "SELECT date_format(ultimaAlteracaoI, '%d/%m/%Y %H:%i') AS ultimaAlteracaoI, ".
						"date_format(ultimaAlteracaoF, '%d/%m/%Y %H:%i') AS ultimaAlteracaoF, ".
						"Professores.nomeProfessor as profI, ".
						"Professores.nomeProfessor as profF ".
						"FROM EntregaDeMencoes ".
						"INNER JOIN Professores ON EntregaDeMencoes.codDigitadorI=Professores.codProfessor ".
						"WHERE codDisciplina=$codDisciplina AND codTurma=$codTurma AND codEtapa=$codEtapa";
$rsEntrega = mysql_query($sqlEntregas);

?>
<br><br>
<table class='table'>
	<thead>
		<tr class='ui-widget-header '>
			<th>Avaliação</th>
			<th>Data</th>
			<th>Menção</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$rowAluno = mysql_fetch_array($rsAluno);

		while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){
			echo "<tr>";
			echo "<td>".$rowAvaliacoes['descricao']."</td>";
			echo "<td>".$rowAvaliacoes['data']."</td>";

			$codAvaliacao = $rowAvaliacoes['codAvaliacao'];

			//verificar se o professor autorizou a publicação da nota
			if ($rowAvaliacoes['mostrar']==1){
				
				//buscar a nota da avaliacao do aluno
				$sqlMencoesAvaliacoes = "SELECT mencao FROM MencoesAvaliacoes ".
												"WHERE codAluno=$codAluno ".
												"AND codAvaliacao=$codAvaliacao";
				$rsMencoesAvaliacoes = mysql_query($sqlMencoesAvaliacoes);
						
				//verifica se o aluno tem nota na avaliação
				if (mysql_num_rows($rsMencoesAvaliacoes)<1) $mencao="-"; 
					else $mencao = mysql_result($rsMencoesAvaliacoes, 0, "mencao");
				?>
				<td><?php echo $mencao; ?></td>
		<?php
			}else{
				echo "<td><a href='#' data-toggle='tooltip' title='o professor não autorizou a publicação dessa menção' class='indisponivel'>indisponível</a></td>";
			}
		
		}// fim do while das avaliacoes

		//mencao final e intermediaria 
		$sqlMencoes = "SELECT * FROM Mencoes ".
									"WHERE codAluno=$codAluno ".
									"AND codDisciplina=$codDisciplina ".
									"AND codEtapa=$codEtapa";
		$rsMencoes = mysql_query($sqlMencoes);
		if (mysql_num_rows($rsMencoes)>0){
			$mencaoI = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
			$mencaoF = mysql_result($rsMencoes, 0, "mencaoFinal");
		}
		
		echo "<tr><td><strong>Menção Intermediária</strong></td><td></td>";			
		echo "<td>$mencaoI</td></tr>";
		echo "<tr><td><strong>Menção Final<strong></td><td></td>";			
		echo "<td>$mencaoF</td>";
		echo "</tr>";
		?>

	</tbody>
</table>

<?php if(mysql_num_rows($rsEntrega)>0){ ?>
<p>Última atualização feita por <?php echo mysql_result($rsEntrega, 0, "profI"); ?> em <?php echo mysql_result($rsEntrega, 0, "ultimaAlteracaoI"); ?>
<?php } ?>

