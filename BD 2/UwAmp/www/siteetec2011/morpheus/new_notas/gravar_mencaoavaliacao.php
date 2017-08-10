<?php

$codAluno = $_POST["codaluno"];
$codAvaliacao = $_POST["codavaliacao"];
$mencao = $_POST["mencao"];


include "../conexao/conn.php";

$sql = "REPLACE MencoesAvaliacoes(".
		"codAluno, ".
		"codAvaliacao, ".
		"mencao ".
		") ".
		"VALUES ( $codAluno, $codAvaliacao,  '$mencao' )";

$rs = mysql_query($sql);


?>