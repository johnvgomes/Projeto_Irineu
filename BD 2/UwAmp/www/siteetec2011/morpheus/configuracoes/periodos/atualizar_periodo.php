<?php
include '../../conexao/conn.php';


$cod = intval($_REQUEST['cod']);
$descricaoPeriodo = $_REQUEST['descricaoPeriodo'];
$entrada = $_REQUEST['entrada'];
$saida = $_REQUEST['saida'];

$sql = "update Periodos set ".
"descricaoPeriodo='$descricaoPeriodo', ".
"entrada='$entrada', ".
"saida='$saida'".
" where codPeriodo=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$_REQUEST['cod']));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>