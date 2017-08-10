<?php include '../../conexao/conn.php'; ?>

<ul class="easyui-tree" id="treeTurmas"> 
<?php
$rsEtapas = mysql_query("SELECT * FROM Etapas");
while($rowEtapas = mysql_fetch_array($rsEtapas)){
	$codEtapa = $rowEtapas["codEtapa"];
	echo "<li state='closed'>";
	echo "<span>".$rowEtapas["etapa"]."</span>";
	if ($rowEtapas["semestre"]==0){
		$rsCursos = mysql_query("select * from Cursos WHERE periodicidade='anual'");
	}else{
		$rsCursos = mysql_query("select * from Cursos WHERE periodicidade='semestral'");
	}
	echo "<ul>";  
	while($rowCursos = mysql_fetch_array($rsCursos)){  
	   echo "<li state='closed'>";
	   echo "<span>".$rowCursos["habilitacao"]."</span>";
		$rsSeries = mysql_query("select Series.*, Periodos.descricaoPeriodo from Series INNER JOIN Periodos ON Series.codPeriodo=Periodos.codPeriodo WHERE codCurso=".$rowCursos["codCurso"]);  
		echo "<ul>";
		while($rowSeries = mysql_fetch_array($rsSeries)){  
			echo "<li state='closed'>";
			echo "<span>".$rowSeries["serie"]." - ".$rowSeries["descricaoPeriodo"]."</span>";
			$rsTurmas = mysql_query("select * from Turmas WHERE codEtapa=$codEtapa AND codSerie=".$rowSeries["codSerie"]);
			if (mysql_num_rows($rsTurmas)!=0){
				echo "<ul>";

				while($rowTurmas = mysql_fetch_array($rsTurmas)){
						echo "<li state='closed'>";
						echo "<span>".$rowTurmas["modulo"].$rowSeries["serie"]."</span>";
						$rsDisciplinas = mysql_query("select * from Disciplinas WHERE modulo=".$rowTurmas["modulo"]." AND codCurso=".$rowCursos["codCurso"]);
						if (mysql_num_rows($rsDisciplinas)!=0){
							echo "<ul>";
							while ($rowDisciplinas = mysql_fetch_array($rsDisciplinas)){
							$codDisciplina = $rowDisciplinas["codDisciplina"];

								echo "<li>";
								echo "<span>".$rowDisciplinas["sigla"]."<font color=#ffffff>[#$codDisciplina#$codEtapa#]</font></span>";
								echo "</li>";
							}
							echo "</ul>";
						}
						echo "</li>";
					}  
					echo "</ul>";
				}

			echo "</li>";  
		}
		echo "</ul>";
	   echo "</li>";
	}
		echo "</ul>";
	   echo "</li>";
	
}  
?>
</ul>

