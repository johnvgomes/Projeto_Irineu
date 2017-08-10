<?php

$modulo = $_REQUEST['modulo'];
$codSerie = $_REQUEST['codSerie'];
$codEtapa = $_REQUEST['codEtapa'];

include '../../conexao/conn.php';

$sql = "insert into Turmas (" .
		"modulo, ".
		"codSerie, ".
		"codEtapa".
		") values(".
		"'$modulo', ".
		"'$codSerie', ".
		"'$codEtapa'".
	")";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados. ' . $sql));
}
?>