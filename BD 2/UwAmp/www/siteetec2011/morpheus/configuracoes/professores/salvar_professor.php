<?php

$nome = $_REQUEST['nomeProfessor'];
$telefone = $_REQUEST['telefone'];
$email = $_REQUEST['email'];
$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];
$perfil = $_REQUEST['perfil'];

include '../../conexao/conn.php';

$sql = "insert into Professores (" .
		"nomeProfessor,".
		"telefone,".
		"email,".
		"login,".
		"senha,".
		"perfil".

") values(".
		"'$nome',".
		"'$telefone',".
		"'$email',".
		"'$login',".
		"md5('$senha'),".
		"'$perfil'".
")";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados. '));
}
?>