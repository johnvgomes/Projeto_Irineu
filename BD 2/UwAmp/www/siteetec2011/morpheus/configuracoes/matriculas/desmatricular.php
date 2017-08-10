<?php

$id = intval($_REQUEST['id']);

include '../../conexao/conn.php';

$sql = "delete from Matriculas where codMatricula=$id";

@mysql_query($sql);
echo json_encode(array('success'=>true));
?>