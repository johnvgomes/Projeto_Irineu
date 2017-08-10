<?php

$rg = intval($_REQUEST['id']);

include '../../conexao/conn.php';

$sql = "UPDATE Alunos SET senha=MD5('etecia@238') WHERE rg=$rg";

if (@mysql_query($sql)) {
	echo json_encode(array('success'=>true));
}else{
	echo json_encode(array('msg'=>"Erro: ". mysql_error()));
}
?>