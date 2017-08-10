<?php 
include '../../conexao/conn.php';
$term = $_REQUEST['term'];
$query = "select Turmas.codTurma, CONCAT(Turmas.modulo, Series.serie) as turma, Turmas.modulo, Series.serie FROM Turmas INNER JOIN Series on Turmas.codSerie=Series.codSerie where modulo like '%$term%' OR serie like '%$term%';";
$result = mysql_query($query);

$array = array();

while ($data = mysql_fetch_array($result))
{
	$row_array['id'] = $data['codTurma'];
	$row_array['value'] = $data["turma"];

	array_push($array, $row_array);
}

echo json_encode($array);