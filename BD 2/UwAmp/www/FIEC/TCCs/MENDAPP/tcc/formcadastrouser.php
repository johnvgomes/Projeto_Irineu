<?php
/*'<pre>';
print_r($_POST);
die();*/
include "conectar.php";

$url = "/tcc/index.php";

$user=utf8_decode($_POST['txtCADnome']);
$senha = sha1($_POST['txtCADsenha']);
$senha2 = sha1($_POST['txtConfirmaSenha']);
$email = utf8_decode($_POST['txtCADemail']);


$con = new Conectar();

if(!($senha == $senha2)){
	header("Location:".$url."?msg=senhaInvalida");
	exit;
}

$selectUser = $con->prepare("SELECT * FROM usuarios WHERE txt_usuario = '$user'"); 
$selectUser->execute();
$userExists = $selectUser -> rowCount();
if(($userExists) > 0){
	header("Location:".$url."?msg=userExists");
	exit;
}

$selectemail = $con->prepare("SELECT * FROM usuarios WHERE txt_email = '$email'");
$selectemail->execute();
$emailExists = $selectemail -> rowCount();
if(($emailExists) > 0){
	header("Location:".$url."?msg=emailExists");
	exit;
}


$insert = $con->prepare('INSERT INTO usuarios (block, id_usuario,txt_usuario,txt_senha,txt_email, desk, orgao) VALUES 
	(0, null,:txt_usuario,:txt_senha,:txt_email, 0 , 0)');

$insert->bindValue(":txt_usuario", $user);
$insert->bindValue(":txt_senha", $senha);
$insert->bindValue(":txt_email", $email);

$tfbool = $insert->execute();

if ($insert->rowCount()==1) {
	session_start();
	$_SESSION['sessao'] = sha1(time());
	$_SESSION['email'] = $email;
	$_SESSION['nome'] = $user;
	$_SESSION['id'] = $con->lastInsertId();
	header("Location: cadastrar-queixa.php");
} else{
	header("Location:".$url."?msg=error");
}	

?>