<html><head>
<meta charset="utf-8">
<title>ETECIA - Avaliação do Curso</title>
<link type="text/css" href="../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Avaliação do Curso</h1>
<?php
session_name('jcLogin');
session_start();

include "../conexao/conn.php";

if (!$_SESSION["isCoordenador"]){
?>
	<div class="alert">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <strong>Acesso Negado!</strong> Você precisa estar logado como coordenador para acessar essa página
	</div>
<?php	
}

$codProfessor = $_SESSION["id"];

//Pegar o código do curso
$sql = "SELECT * FROM Cursos WHERE codCoordenador=$codProfessor";
$rs = mysql_query($sql);
$codCurso = mysql_result($rs, 0, "codCurso");


//Pegar as turmas do curso
$sql = "SELECT Turmas.modulo, Series.serie, Turmas.codTurma FROM Turmas 
		INNER JOIN Series ON Turmas.codSerie=Series.codSerie
		WHERE codCurso=$codCurso AND Status='Cursando'
		ORDER BY modulo";
$rs = mysql_query($sql);
echo mysql_error();
echo "<ul class='nav nav-pills'>";
while($r = mysql_fetch_array($rs)){
	$codTurma = $r["codTurma"];
	$turma = $r["modulo"].$r["serie"];
	$classe =  ($_GET["codTurma"]==$codTurma)? "class='active'" :"";
	echo "<li $classe><a href='relatorio.php?codTurma=$codTurma'>$turma</a></li>";
}
echo "</ul>";

//Depois que o usuário escolher a turma, mostrar os alunos que responderam o questionário
//e a opção para ver o relatório
if (isset($_GET["codTurma"])){
	$codTurma = $_GET["codTurma"];

	$sqlMatriculas = "SELECT Matriculas.codMatricula, Matriculas.nChamada, Alunos.nomeAluno FROM Alunos
						INNER JOIN Matriculas ON Matriculas.codAluno=Alunos.codAluno 
						WHERE Matriculas.codTurma=$codTurma
						ORDER BY Matriculas.nChamada";
	$rsMatriculas = mysql_query($sqlMatriculas);
	echo mysql_error();

	echo "<table class='table table-hover'>";
	echo "<tr><th>N.</th><th>Nome</th><th>Respondeu?</th></tr><tbody>";
	while($rMatricula = mysql_fetch_array($rsMatriculas)){
		$codMatricula = $rMatricula["codMatricula"];
		$respondeu = mysql_query("SELECT * FROM LogAvaliacao WHERE codMatricula=$codMatricula");
		echo "<tr><td>".$rMatricula[ "nChamada"]."</td><td>".$rMatricula[ "nomeAluno"]."</td><th>";
		if (mysql_num_rows($respondeu)>0) echo "<img src='check.png'>";
		echo "</th></tr>";
		$respondeu = 0;
	}
	echo "</tbody></table>";
}
?>

