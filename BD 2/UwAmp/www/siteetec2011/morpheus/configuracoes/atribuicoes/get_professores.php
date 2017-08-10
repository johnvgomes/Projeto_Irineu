<?php 
include '../../conexao/conn.php';
$term = $_REQUEST['term'];
$query = "SELECT * FROM Professores WHERE nomeProfessor LIKE '%$term%'";
$result = mysql_query($query);

$array = array();

while ($data = mysql_fetch_array($result))
{
	$row_array['id'] = $data['codProfessor'];
	$row_array['value'] = $data["nomeProfessor"];

	array_push($array, $row_array);
}

echo json_encode($array);