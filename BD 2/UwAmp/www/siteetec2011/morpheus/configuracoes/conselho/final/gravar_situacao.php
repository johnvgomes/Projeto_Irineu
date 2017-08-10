<?php

$codMatricula = intval($_POST["codMatricula"]);
$situacao = ($_POST["situacao"]);

include '../../../conexao/conn.php';

$sql = "REPLACE SituacaoFinal (codMatricula, situacao) VALUES
			($codMatricula, '$situacao')";

$result = @mysql_query($sql);
?>