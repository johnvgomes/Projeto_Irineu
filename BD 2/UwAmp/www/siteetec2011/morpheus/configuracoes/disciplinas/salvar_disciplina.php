<?php

$numeroPlanoDeCurso = $_REQUEST['numeroPlanoDeCurso'];
$disciplina = $_REQUEST['disciplina'];
$sigla = $_REQUEST['sigla'];
$cargaHoraria = $_REQUEST['cargaHoraria'];
$codCurso = $_REQUEST['codCurso'];
$modulo = $_REQUEST['modulo'];

include '../../conexao/conn.php';

$sql = "insert into Disciplinas (" .
		"numeroPlanoDeCurso, ".
		"disciplina, ".
		"sigla, ".
		"cargaHoraria, ".
		"codCurso, ".
		"modulo ".
		") values(".
		"'$numeroPlanoDeCurso', ".
		"'$disciplina', ".
		"'$sigla', ".
		"'$cargaHoraria', ".
		"'$codCurso', ".
		"'$modulo'".
	")";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados. ' . $sql));
}
?>