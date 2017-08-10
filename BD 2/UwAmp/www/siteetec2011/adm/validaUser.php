<?php
session_start();

if (isset($_SESSION["nome_usuario"])){
	$nome_usuario = $_SESSION["nome_usuario"];}
if (isset($_SESSION["senha_usuario"])){
	$senha_usuario = $_SESSION["senha_usuario"];}
	
if(!(empty($nome_usuario) OR empty($senha_usuario))){
	require_once '../class/Conectar.php';
	$con = new Conectar();
	$resultado = $con->executar("SELECT * FROM login WHERE usuario = '$nome_usuario'");
	if(mysql_num_rows($resultado)==1){
		if($senha_usuario != mysql_result($resultado,0,"senha")){
			unset($_SESSION['nome_usuario']);
			unset($_SESSION['senha_usuario']);
			exit;
		}
	}else{
		unset($_SESSION['nome_usuario']);
		unset($_SESSION['senha_usuario']);
		echo "Voc&ecirc; n&atilde;o efetuou o login!";
		exit;
	}
}else{
	echo "Voc&ecirc; n&atilde;o efetuou o login!";
	exit;
}

?>