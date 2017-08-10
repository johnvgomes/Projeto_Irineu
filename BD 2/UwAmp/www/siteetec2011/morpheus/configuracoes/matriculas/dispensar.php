<?php

$id = intval($_REQUEST['id']);
$codDisciplina = intval($_REQUEST['codDisciplina']);

include '../../conexao/conn.php';

$sql = "REPLACE Dispensas(
		codMatricula, 
		codDisciplina)
		VALUES ( $id, $codDisciplina )";

if (@mysql_query($sql)) {
	echo json_encode(array('success'=>true));
}else{
	echo json_encode(array('msg'=>"Erro: ". mysql_error()));

}
?>