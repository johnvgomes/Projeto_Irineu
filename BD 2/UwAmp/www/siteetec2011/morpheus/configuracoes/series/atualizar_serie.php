<?php
include '../../conexao/conn.php';


$cod = intval($_REQUEST['cod']);
$serie = $_REQUEST['serie'];
$codCurso = $_REQUEST['codCurso'];
$codPeriodo = $_REQUEST['codPeriodo'];

$sql = "update Series set ".
"serie='$serie', ".
"codCurso='$codCurso', ".
"codPeriodo='$codPeriodo'".
" where codSerie=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$_REQUEST['cod']));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>