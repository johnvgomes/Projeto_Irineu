<?php

$id = intval($_REQUEST['id']);

include '../../conexao/conn.php';

$sql = "delete from Cursos where codCurso=$id";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao apagar curso.'));
}
?>