<?php
include '../../conexao/conn.php';


$cod = intval($_REQUEST['cod']);
$modulo = $_REQUEST['modulo'];
$codSerie = $_REQUEST['codSerie'];
$codEtapa = $_REQUEST['codEtapa'];

$sql = "update Turmas set ".
"modulo='$modulo', ".
"codSerie='$codSerie', ".
"codEtapa='$codEtapa'".
" where codTurma=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$_REQUEST['cod']));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>