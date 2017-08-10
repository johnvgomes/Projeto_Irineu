<?php

$descricaoPeriodo = $_REQUEST['descricaoPeriodo'];
$entrada = $_REQUEST['entrada'];
$saida = $_REQUEST['saida'];

include '../../conexao/conn.php';

$sql = "insert into Periodos (" .
		"descricaoPeriodo, ".
		"entrada, ".
		"saida".
		") values(".
		"'$descricaoPeriodo', ".
		"'$entrada', ".
		"'$saida'".
	")";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados. ' . $sql));
}
?>