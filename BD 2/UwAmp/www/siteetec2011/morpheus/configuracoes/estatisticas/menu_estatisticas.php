<?php

$codTurma = $_GET["codTurma"];

?>
<html><head>
		<meta charset="utf-8">
		<title>Faltas por Disciplinas</title>
		<link rel="stylesheet" href="../../includes/bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
</head>
<body>
	<p><a href="grafico_faltas.php?codTurma=<?php echo $codTurma;?>" target="_blank" class="btn">Faltas por Disciplinas</a></p>
	<p><a href="grafico_insuficiente.php?codTurma=<?php echo $codTurma;?>" target="_blank" class="btn">Menções Insuficientes</a></p>
	<p><a href="grafico_mencoes.php?codTurma=<?php echo $codTurma;?>" target="_blank" class="btn">Menções por Disciplinas</a></p>
</body>

