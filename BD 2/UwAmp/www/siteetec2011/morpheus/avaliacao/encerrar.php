<?php

$codmatricula 		= $_GET["codmatricula"];

include "../conexao/conn.php";

$sql = "INSERT INTO LogAvaliacao (codLog, codMatricula, data) 
		VALUES (0, $codmatricula, NOW() )";

mysql_query($sql);
	

?>

<html><head>
<meta charset="utf-8">
<title>ETECIA - Avaliação do Curso</title>
<link type="text/css" href="../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="style.css">
<script type='text/javascript'>
<!--
function FecharJanela() 
{
ww = window.open(window.location, "_self");
ww.close();
} 
-->
</script>
		
<style type="text/css">
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 20px 50px 40px 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>
	</head>
	<body>

<h1>Obrigado pela sua avaliação. A sua opinião é muito importante para nós.</h1>

<br><br>
<a href="#" class="btn btn-primary btn-large" onclick="FecharJanela();">Fechar</a>