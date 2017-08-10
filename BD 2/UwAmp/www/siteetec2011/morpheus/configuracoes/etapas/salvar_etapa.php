<?php


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

include '../../conexao/conn.php';

$sql = "insert into Etapas (" .
		"etapa, ".
		"ano, ".
		"semestre, ".
		"dataEntrega1, ".
		"dataEntrega2, ".
		"dataEntrega3, ".
		"dataEntrega4 ".
		") values(".
		"'$etapa', ".
		"'$ano', ".
		"'$semestre', ".
		"'$dataEntrega1', ".
		"'$dataEntrega2', ".
		"'$dataEntrega3', ".
		"'$dataEntrega4' ".
	")";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados. ' . $sql));
}
?>