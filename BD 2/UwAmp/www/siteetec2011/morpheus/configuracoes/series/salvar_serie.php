<?php

$serie = $_REQUEST['serie'];
$codCurso = $_REQUEST['codCurso'];
$codPeriodo = $_REQUEST['codPeriodo'];

include '../../conexao/conn.php';

$sql = "insert into Series (" .
		"serie, ".
		"codCurso, ".
		"codPeriodo".
		") values(".
		"'$serie', ".
		"'$codCurso', ".
		"'$codPeriodo'".
	")";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados. ' . $sql));
}
?>