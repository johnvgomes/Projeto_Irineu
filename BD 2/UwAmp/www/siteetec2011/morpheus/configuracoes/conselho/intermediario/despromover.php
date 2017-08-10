<?php

$codMatricula = intval($_POST["codMatricula"]);

include '../../../conexao/conn.php';

$sql = "DELETE FROM SituacaoFinal WHERE codMatricula=$codMatricula";

$result = @mysql_query($sql);
?>