<?php

$senha_atual = $_REQUEST['senha_atual'];
$nova_senha = $_REQUEST['nova_senha'];
$codProfessor = $_REQUEST['cod'];

$sql = "SELECT * FROM Professores WHERE codProfessor=$codProfessor";
include '../conexao/conn.php';

$result = @mysql_query($sql);

//verificar se a senha digitada é igual
$senha_correta = mysql_result($result, 0, "senha");

// se for igual update
if (md5($senha_atual) == $senha_correta){
	$sqlUpdate = "UPDATE Professores set senha = md5('$nova_senha') WHERE codProfessor=$codProfessor";
	$rsUpdate = mysql_query($sqlUpdate);
	if ($rsUpdate){
		echo json_encode(array('sucess'=>true ));	
	}else{
		$msg = 'Erro ao gravar senha no banco de dados' . mysql_error();
		echo json_encode(array('msg'=>$msg ));
	}
	
}else{
	echo json_encode(array('msg'=>'A senha digitada não confere'));
}

