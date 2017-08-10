<?php

include '../../conexao/conn.php';
$rs = mysql_query("select CONCAT(modulo,Series.serie) AS turma, codTurma, modulo, Series.serie, Etapas.etapa from Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie INNER JOIN Etapas ON Turmas.codEtapa=Etapas.codEtapa;");
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>