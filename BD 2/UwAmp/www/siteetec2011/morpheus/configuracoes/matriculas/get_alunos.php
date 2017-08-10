<?php 
include '../../conexao/conn.php';
$term = $_REQUEST['term'];
$query = "SELECT nomeAluno as nomeAluno, rg, codAluno FROM Alunos WHERE nomeAluno LIKE '%$term%'";
$result = mysql_query($query);

$array = array();

while ($data = mysql_fetch_array($result))
{
	$row_array['id'] = $data['codAluno'];
	$row_array['value'] = $data["nomeAluno"]." (".$data["rg"].")";

	array_push($array, $row_array);
}

echo json_encode($array);