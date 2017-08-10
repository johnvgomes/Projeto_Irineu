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
					$turma = $rowTurmas["modulo"].$rowSeries["serie"];
					$codTurma = $rowTurmas["codTurma"];
					echo "<li>";
					echo "<span>".$turma."<font color=#ffffff>[#$codTurma#]</font></span>";
					//echo "<ul><li><span>Intermediário $turma <font color=#ffffff>[#$codTurma#]</font></span>";
					//echo "<li><span>Final $turma<font color=#ffffff>[#$codTurma#]</font></span></li></ul>";
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