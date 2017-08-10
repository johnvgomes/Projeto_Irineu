<html><head>
<meta charset="utf-8">
<title>ETECIA - Conselho Final</title>
<link type="text/css" href="../../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="../../includes/bootstrap.css">
</head>
<body>
	<h1>Relatório de Entrega de Menções</h1>
	<h3><?php echo date( "d/m/Y");?></h3>
<?php

include '../../conexao/conn.php';

$sql = "SELECT * FROM Turmas 
		INNER JOIN Series ON Series.codSerie=Turmas.codSerie
		INNER JOIN Cursos ON Cursos.codCurso=Series.codCurso
		WHERE Turmas.codEtapa=10 OR Turmas.codEtapa=11
		ORDER BY Cursos.codCurso, Series.serie, Turmas.modulo";
$rs = mysql_query($sql);


while($r = mysql_fetch_array($rs)){
	$codCurso = $r["codCurso"];
	$modulo = $r["modulo"];
	$codTurma = $r["codTurma"];
	$codEtapa= $r["codEtapa"];
	$codSerie = $r["codSerie"];
	echo "<table class='table'>";
	echo "<tr><th colspan=3>".$r["modulo"].$r["serie"]."</th></tr>";
	$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ";
	$rsDisciplinas = mysql_query($sqlDisciplinas);
	while( $rD = mysql_fetch_array($rsDisciplinas)){
		echo "<tr>";
		echo "<td>".$rD["disciplina"]."</td>";
		$codDiciplina = $rD["codDisciplina"];
		$sqlProf = "SELECT * FROM Atribuicoes
					INNER JOIN Professores ON Professores.codProfessor=Atribuicoes.codProfessor 
					WHERE codDisciplina=$codDiciplina 
					AND (codEtapa=10 OR codEtapa=11)
					AND codSerie=$codSerie";
		$rsProf = mysql_query($sqlProf);
		//echo $sqlProf;
		echo "<td>";
		while ($rP = mysql_fetch_array($rsProf)) {
			echo $rP["nomeProfessor"]. " ";
		}
		echo "</td>";

		$sqlEntrega = "SELECT *, date_format(ultimaAlteracaoF, '%d/%m/%Y %H:%i') as data FROM EntregaDeMencoes 
				WHERE codDisciplina=$codDiciplina
				AND codTurma=$codTurma";
		$rsEntrega = mysql_query($sqlEntrega);
		//echo $sqlEntrega;
		$data = mysql_result($rsEntrega, 0, "data");
		if ($data==""){
			echo "<td>NÃO HOUVE ENTREGA</td>";
		}else{
			echo "<td>".$data."</td>";
		}
		echo "</tr>";

	}
}

echo "</table>";
?>