<?php

$campo = $_REQUEST['campo'];

if ($campo == "habilitaNenhum"){
	$sql = "Update Etapas set habilitaIntermediaria=0, habilitaFinal=0 Where atual=1";
}elseif ($campo == "habilitaIntermediaria"){
	$sql = "Update Etapas set habilitaIntermediaria=1, habilitaFinal=0 Where atual=1";
}elseif ($campo == "habilitaFinal"){
	$sql = "Update Etapas set habilitaIntermediaria=0, habilitaFinal=1 Where atual=1";
}elseif ($campo == "habilitaNenhumEM"){
	$sql = "Update Etapas set habilitaIntermediaria=0, habilitaFinal=0 Where semestre=0";
}elseif ($campo == "habilitaIntermediariaEM"){
	$sql = "Update Etapas set habilitaIntermediaria=1, habilitaFinal=0 Where semestre=0";
}elseif ($campo == "habilitaFinalEM"){
	$sql = "Update Etapas set habilitaIntermediaria=0, habilitaFinal=1 Where semestre=0";
}



include '../../conexao/conn.php';

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao mudar permissão.'));
}
?>