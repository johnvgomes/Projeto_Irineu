<?php

$nome = $_REQUEST['nomeAluno'];
$rg = $_REQUEST['rg'];
$sexo = $_REQUEST['sexo'];
$RM = $_REQUEST['RM'];
$nascimento = $_REQUEST['nascimento'];
$codCidade = $_REQUEST['cidade'];
$orgaoExpeditor = $_REQUEST['orgaoExpeditor'];
$endereco = $_REQUEST['endereco'];
$numero = $_REQUEST['numero'];
$complemento = $_REQUEST['complemento'];
$bairro = $_REQUEST['bairro'];
$ddd = $_REQUEST['ddd'];
$telefone = $_REQUEST['telefone'];
$ddd2 = $_REQUEST['ddd2'];
$telefone2 = $_REQUEST['telefone2'];
$cep = $_REQUEST['cep'];
$email = $_REQUEST['email'];
$estadoCivil = $_REQUEST['estadoCivil'];
$codEscolaEM = $_REQUEST['codEscolaEM'];

$nascimento = implode("-",array_reverse(explode("/",$nascimento)));

include '../../conexao/conn.php';

$sql = "insert into Alunos (" .
		"nomeAluno,".
		"rg,".
		"orgaoExpeditor,".
		"endereco,".
		"numero,".
		"complemento,".
		"bairro,".
		"ddd,".
		"telefone,".
		"ddd2,".
		"telefone2,".
		"cep,".
		"email,".
		"estadoCivil,".
		"sexo,".
		"RM,".
		"nascimento,".
		"codCidadeNascimento".
		
") values(".
		"'$nome',".
		"'$rg',".
		"'$orgaoExpeditor',".
		"'$endereco',".
		"'$numero',".
		"'$complemento',".
		"'$bairro',".
		"'$ddd',".
		"'$telefone',".
		"'$ddd2',".
		"'$telefone2',".
		"'$cep',".
		"'$email',".
		"'$estadoCivil',".
		"'$sexo',".
		"'$RM',".
		"'$nascimento',".
		"$codCidade ".
		
")";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados. ' . $sql));
}
?>