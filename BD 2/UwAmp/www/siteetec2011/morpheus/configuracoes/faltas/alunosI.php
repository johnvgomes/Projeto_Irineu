<?php 
include '../../conexao/conn.php';
$codTurma =   $_GET["codTurma"]; 
$result = mysql_query ( " select concat(Turmas.modulo, Series.serie) as turma  FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie where codTurma=$codTurma");
$row = mysql_fetch_row($result);
$turma = $row[0];
$modulo = substr($turma, 0, 1);
$serie = substr($turma, 1, 1);

//pegar o código do curso
$result = mysql_query ( " select Turmas.codTurma, Series.codCurso FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie WHERE modulo=$modulo and serie='$serie'");
$codCurso = mysql_result($result, 0, "codCurso");

$sqlAlunos = "SELECT Matriculas.*, f_remove_acentos(Alunos.nomeAluno) as nomeAluno, Alunos.codAluno FROM Alunos INNER JOIN
				Matriculas ON Matriculas.codAluno=Alunos.codAluno
				INNER JOIN Turmas ON Turmas.codTurma=Matriculas.codTurma
				WHERE Matriculas.codTurma=$codTurma
				ORDER BY nChamada";

$rsAlunos = mysql_query($sqlAlunos);

$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo";
$rsDisciplina = mysql_query($sqlDisciplinas);

	$sqlAulasDadas = "SELECT SUM(qtdeAulas) as aulasDadas FROM Encontros WHERE codTurma=$codTurma";

$rsAulasDadas = mysql_query($sqlAulasDadas);
$total_aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");


?>

<html>
<head>			
	<link rel="stylesheet" href="../conselho/ata/bootstrap.css">
	<script type="text/javascript" src="../../jquery/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript">
		$(function(){	
			$(".campo_falta").change(function () {
				var codMatricula = $(this).attr("codMatricula");
				var codDisciplina = $(this).attr("codDisciplina");
				var faltas = $(this).attr("value");
				$.post("gravar_faltas.php", 
					{codmatricula: codMatricula, coddisciplina: codDisciplina, faltas : faltas })
		        .error(function() { alert("Erro ao gravar faltas. Banco de Dados Indisponível"); }) 

		    });

			$(".campo_aulas_dadas").change(function () {
				var codTurma = $(this).attr("codTurma");
				var codDisciplina = $(this).attr("codDisciplina");
				var aulas = $(this).attr("value");
				//alert(codTurma+" "+codDisciplina+" "+aulas);
				$.post("gravar_aulas_dadas.php", 
					{codturma: codTurma, coddisciplina: codDisciplina, aulas : aulas })
		        .error(function() { alert("Erro ao gravar aulas dadas. Banco de Dados Indisponível"); }) 
	        });


    		$(".numero").keydown(function(event){
	        /* Testar as teclas não numérica */
    		    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)){
            		return;
        		}else{
           			if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )){
                		event.preventDefault();
            		}  
        		}
    		});
		});
	</script>
</head>
<body>
	<?php if ($codCurso==8) echo "<div class='alert alert-error' data-alert='alert'><a class='close' data-dismiss='alert'>×</a><strong>Atenção</strong>As faltas do curso de informática são importadas do diário eletrônico e não permitem alterações. [O sistema está aberto para digitação de aulas dadas em informática] </div>"; ?>

<table>
	<tr>
		<th>N</th>
		<th>Aluno</th>
		<?php
			while ($row = mysql_fetch_array($rsDisciplina)){
				echo "<th>";
				echo $row["sigla"];
				echo "</th>";
			}
		?>
		<th>TOTAL</th>
		<th>FREQ.</th>
	</tr>

<?php

while ($r = mysql_fetch_array($rsAlunos)){ 
	$nChamada = $r["nChamada"];
	$nomeAluno = $r["nomeAluno"];
	$codAluno = $r["codAluno"];
	$codMatricula = $r["codMatricula"];
	$status = $r["status"];

	$rsDisciplina = mysql_query($sqlDisciplinas);

	?>

	<tr>
		<td><?php echo $nChamada; ?></td>
		<td><?php echo $nomeAluno; ?></td>
		<?php if ($status !="MA") {
			echo "<td>$status</td></tr>";
			continue;
		} 
		$total_faltas_aluno=0;
		?>

		<?php while ($row = mysql_fetch_array($rsDisciplina)){ 
			$codDisciplina = $row["codDisciplina"];
			//Pegar as faltas que já foram digitas
			
				$sqlTotalFaltas = "SELECT count(codChamada) as faltas, Encontros.codDisciplina FROM Faltas
									INNER JOIN Aulas ON Aulas.codAula=Faltas.codAula
									INNER JOIN Encontros ON Encontros.codEncontro=Aulas.codEncontro
									INNER JOIN Turmas ON Turmas.codTurma=Encontros.codTurma
									INNER JOIN Disciplinas ON Disciplinas.codDisciplina = Encontros.codDisciplina
									WHERE codAluno=$codAluno
									AND Encontros.codTurma=$codTurma 
									AND Disciplinas.codDisciplina=$codDisciplina";

				$rsTotalFaltas = mysql_query($sqlTotalFaltas);
				$n_faltas = mysql_result($rsTotalFaltas, 0 , "faltas");


			$total_faltas_aluno += $n_faltas;
			
			?>
			<td>
				<input 
					type=text 
					size=4 
					class="campo_falta numero input-mini"
					name=<?php echo $codMatricula."_".$row["codDisciplina"];?>
					codMatricula=<?php echo $codMatricula; ?>
					codDisciplina=<?php echo $row["codDisciplina"]; ?>
					value=<?php echo $n_faltas; ?>
					<?php 
						//alterado porque os professore não digitaram o diário a secretaria teve que fizer as aulas dadas.
						//echo ($codCurso==8) ? "readonly=readonly" : "" 
					?>

				>
			</td>

		<?php } ?>
			<td style="text-align:center;"><?php echo $total_faltas_aluno; ?></td>
			<?php 	
				$freq = number_format((1-($total_faltas_aluno/$total_aulas_dadas))*100,2); 
				$color  = ($freq<75) ? "red" : "black" ;
				 
			?>
			<td style="text-align:center;color:<?php echo $color;?>">
				<?php echo $freq."%"; ?>
			</td>

	</tr>


<?php } ?>
	<tr>
		<td>
		</td>
		<td>
			<strong>Total de Aulas Dadas</strong>
		</td>
		<?php 
		$rsDisciplina = mysql_query($sqlDisciplinas);
		while ($row = mysql_fetch_array($rsDisciplina)){ 
			$codDisciplina = $row["codDisciplina"];
			$sqlAulasDadas = "SELECT SUM(qtdeAulas) as aulasDadas FROM Encontros WHERE codDisciplina=$codDisciplina AND codTurma=$codTurma";
			$rsAulasDadas = mysql_query($sqlAulasDadas);
			if (mysql_num_rows($rsAulasDadas)>0) $aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas"); else $aulas_dadas=0;
		?>
		<td>
			<input 
				type=text
				size=4
				class="campo_aulas_dadas numero input-mini"
				name=<?php echo $codTurma."_".$codDisciplina;?>
				codTurma=<?php echo $codTurma; ?>
				codDisciplina=<?php echo $codDisciplina; ?>
				<?php //echo ($codCurso==8) ? "readonly=readonly" : "" ;?>
				value=<?php echo $aulas_dadas; ?>


			>
		</td>
		<?php } ?>
		<td style="text-align:center"><?php echo $total_aulas_dadas; ?></td>
	</tr>


</table>
</body>
</html>
