<?php
include '../../conexao/conn.php';


$cod = intval($_REQUEST['cod']);

$ano = $_REQUEST['ano'];
$semestre = $_REQUEST['semestre'];
$dataEntrega1 = $_REQUEST['dataEntrega1'];
$dataEntrega2 = $_REQUEST['dataEntrega2'];
$dataEntrega3 = $_REQUEST['dataEntrega3'];
$dataEntrega4 = $_REQUEST['dataEntrega4'];

if ($semestre==0){
	$etapa = $ano;
}else{
	$etapa = $semestre . "o Sem - " . $ano;
}

$sql = "update Etapas set ".
"etapa='$etapa', ".
"ano='$ano', ".
"semestre='$semestre', ".
"dataEntrega1='$dataEntrega1', ".
"dataEntrega2='$dataEntrega2', ".
"dataEntrega3='$dataEntrega3', ".
"dataEntrega4='$dataEntrega4' ".
" where codEtapa=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$_REQUEST['cod']));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>