<?php

$codMatricula = intval($_POST["codMatricula"]);
$resumo = ($_POST["resumo"]);

include '../../../conexao/conn.php';

$sql = "REPLACE DecisoesConselho (codMatricula, resumo) VALUES
			($codMatricula, '$resumo')";

$result = @mysql_query($sql);
?>