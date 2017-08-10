<?php
include '../../conexao/conn.php';


$cod = intval($_REQUEST['cod']);
$habilitacao = $_REQUEST['habilitacao'];
$numeroCurso = $_REQUEST['numeroCurso'];
$doe = $_REQUEST['doe'];
$periodicidade = $_REQUEST['periodicidade'];

$sql = "update Cursos set ".
"habilitacao='$habilitacao', ".
"numeroCurso='$numeroCurso', ".
"periodicidade='$periodicidade', ".
"doe='$doe'".
" where codCurso=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$_REQUEST['cod']));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>