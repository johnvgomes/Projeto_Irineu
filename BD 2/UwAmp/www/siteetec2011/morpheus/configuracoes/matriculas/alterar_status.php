<?php
include '../../conexao/conn.php';


$cod = intval($_REQUEST['cod']);
$status = $_REQUEST['status'];

$sql = "update Matriculas set status='$status' where codMatricula=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$sql));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>