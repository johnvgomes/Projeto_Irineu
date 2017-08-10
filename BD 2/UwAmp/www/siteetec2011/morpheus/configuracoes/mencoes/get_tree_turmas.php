<?php include '../../conexao/conn.php'; ?>

<ul class="easyui-tree" id="treeTurmas"> 
<?
$rsCursos = mysql_query("select * from Cursos");  
while($rowCursos = mysql_fetch_array($rsCursos)){  
   echo "<li state='closed'>";
   echo "<span>".$rowCursos["habilitacao"]."</span>";
	$rsSeries = mysql_query("select Series.*, Periodos.descricaoPeriodo from Series INNER JOIN Periodos ON Series.codPeriodo=Periodos.codPeriodo WHERE codCurso=".$rowCursos["codCurso"]);  
	echo "<ul>";
	while($rowSeries = mysql_fetch_array($rsSeries)){  
		echo "<li state='closed'>";
		echo "<span>".$rowSeries["serie"]." - ".$rowSeries["descricaoPeriodo"]."</span>";
		$rsTurmas = mysql_query("select * from Turmas WHERE codSerie=".$rowSeries["codSerie"]);
		if (mysql_num_rows($rsTurmas)!=0){
			echo "<ul>";
			while($rowTurmas = mysql_fetch_array($rsTurmas)){
				echo "<li>";
				echo "<span>".$rowTurmas["modulo"].$rowSeries["serie"]."</span>";
				echo "</li>";
			}  
			echo "</ul>";
		}
		echo "</li>";  
	}
	echo "</ul>";
   echo "</li>";
}  
?>
</ul>