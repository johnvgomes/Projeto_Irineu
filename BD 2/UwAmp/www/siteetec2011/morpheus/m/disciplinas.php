<!DOCTYPE html> 
<html> 
<?php include "cabecalho.php"; ?>

<body> 

<div data-role="page">

	<div data-role="header">
		<a href="logout.php" data-icon="home" data-theme="b">Sair</a>
		<h1>Disciplinas</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<img src="http://etecia.com.br/morpheus/logo_morpheus_tmb.png" alt="logo Morpheus" />

		<h2> Escolha uma disciplina</h2>

		<ul data-role="listview">
			<li><a href="msystem.php?codDisciplina=100">IMC (1G)</a></li>
			<li><a href="msystem.php?codDisciplina=200">PTCC (2G)</a></li>
			<li><a href="msystem.php?codDisciplina=300">DTCC (3G)</a></li>
		</ul>
	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>