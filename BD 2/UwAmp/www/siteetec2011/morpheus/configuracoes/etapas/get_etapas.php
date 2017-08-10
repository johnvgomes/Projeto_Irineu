<?php

include '../../conexao/conn.php';
$rs = mysql_query("select * from Etapas");
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>