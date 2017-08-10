<?php
session_name('jcLogin');
session_start();

$codCoordenador=$_SESSION["id"];

include "../conexao/conn.php";

$sql = "SELECT * FROM Cursos WHERE codCoordenador=$codCoordenador";
$rs = mysql_query($sql);
$codCurso = mysql_result($rs, 0, "codCurso");

?>
<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Diário de classe</title>
		<link rel="stylesheet" href="bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
</head>
<body>
	<a href="chamada/diario/diario.php" target="_blank" class="btn">Ver Diários</a>
	<a href="avaliacao/relatorio.php" target="_blank" class="btn">Relatório de Avaliação</a>
	<a href="configuracoes/anexo4/form.php" target="_blank" class="btn">Anexo IV</a>
	<a href="configuracoes/pp/formulario.php?codCurso=<?php echo $codCurso;?>" target="_blank" class="btn">Relação de PP</a>
</body>

