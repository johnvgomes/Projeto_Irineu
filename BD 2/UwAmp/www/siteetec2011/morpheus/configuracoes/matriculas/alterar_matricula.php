<?php

$id = intval($_REQUEST['codMatricula']);
$nChamada = $_REQUEST['nChamada'];
$nomeAluno = $_REQUEST['nomeAluno'];
$rg = $_REQUEST['rg'];
$status = $_REQUEST['status'];

include '../../conexao/conn.php';

$sql = "update Matriculas set nChamada='$nChamada', status='$status' where codMatricula=$id";
@mysql_query($sql);
echo json_encode(array(
	'id' => $id,
	'nChamada' => $nChamada,
	'nomeAluno' => $nomeAluno,
	'rg' => $rg,
	'status' => $status
));
?>

