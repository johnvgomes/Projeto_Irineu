<?php
include '../../conexao/conn.php';


$codMatricula = intval($_REQUEST['cod']);
$resumo = $_REQUEST['resumo'];
$resultado = $_REQUEST['resultado'];

$rsControle = mysql_query("SELECT * FROM DecisoesConselho WHERE codMatricula=$codMatricula");
if(mysql_num_rows($rsControle)==0){
	$sql = "INSERT INTO DecisoesConselho ( codMatricula, resumo, resultado) VALUES ($codMatricula, '$resumo', '$resultado')";
}else{
	$sql = "UPDATE DecisoesConselho SET resumo='$resumo', resultado='$resultado' WHERE codMatricula=$codMatricula ";
}

$result = @mysql_query($sql);

if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$sql));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>