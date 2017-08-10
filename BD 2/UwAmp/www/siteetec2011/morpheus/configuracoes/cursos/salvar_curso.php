<?php

$habilitacao = $_REQUEST['habilitacao'];
$numeroCurso = $_REQUEST['numeroCurso'];
$doe = $_REQUEST['doe'];
$periodicidade = $_REQUEST['periodicidade'];

include '../../conexao/conn.php';

$sql = "insert into Cursos (" .
		"habilitacao, ".
		"numeroCurso, ".
		"periodicidade, ".
		"doe".
		") values(".
		"'$habilitacao', ".
		"'$numeroCurso', ".
		"'$periodicidade', ".
		"'$doe'".
	")";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados. ' . $sql));
}
?>