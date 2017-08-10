<?php

include '../../conexao/conn.php';
$rs = mysql_query("select descricaoPeriodo, DATE_FORMAT (entrada, '%H:%i') AS entrada, DATE_FORMAT (saida, '%H:%i') AS saida from Periodos;");
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>