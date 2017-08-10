<?php
include '../../conexao/conn.php';


$cod = intval($_REQUEST['cod']);
$nome = $_REQUEST['nomeProfessor'];
$telefone = $_REQUEST['telefone'];
$email = $_REQUEST['email'];
$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];
$perfil = $_REQUEST['perfil'];

$sql = "update Professores set ".
"nomeProfessor='$nome',".
"telefone='$telefone',".
"email='$email',".
"perfil='$perfil',".
"login='$login',".
"senha=md5('$senha')".
" where codProfessor=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$_REQUEST['cod']));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'));
}
?>