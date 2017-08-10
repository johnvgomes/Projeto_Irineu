<?php

include '../../conexao/conn.php';
$rs = mysql_query("select codSerie, serie, Cursos.habilitacao, Periodos.descricaoPeriodo from Series INNER JOIN Cursos ON Series.codCurso=Cursos.codCurso INNER JOIN Periodos ON Series.codPeriodo=Periodos.codPeriodo;");
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>