<?php
include '../../conexao/conn.php';

$cod = intval($_REQUEST['cod']);
$numeroPlanoDeCurso = $_REQUEST['numeroPlanoDeCurso'];
$disciplina = $_REQUEST['disciplina'];
$sigla = $_REQUEST['sigla'];
$cargaHoraria = $_REQUEST['cargaHoraria'];
$codCurso = $_REQUEST['codCurso'];
$modulo = $_REQUEST['modulo'];

$sql = "update Disciplinas set ".
"numeroPlanoDeCurso='$numeroPlanoDeCurso', ".
"disciplina='$disciplina', ".
"sigla='$sigla', ".
"cargaHoraria='$cargaHoraria', ".
"codCurso='$codCurso', ".
"modulo='$modulo'".
" where codDisciplina=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$_REQUEST['cod']));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>