<?php
include '../../conexao/conn.php';


$cod = intval($_REQUEST['cod']);
$nome = $_REQUEST['nomeAluno'];
$rg = $_REQUEST['rg'];
$sexo = $_REQUEST['sexo'];
$RM = $_REQUEST['RM'];
$nascimento = $_REQUEST['nascimento'];
//$codCidade = $_REQUEST['cidade'];
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
//$codEscolaEM = $_REQUEST['codEscolaEM'];

//$codCidade = (isset( $codCidade ) ? $codCidade : 0);
//$codEscolaEM = (isset( $codEscolaEM ) ? $codEscolaEM : 0);


$nascimento = implode("-",array_reverse(explode("/",$nascimento)));


$sql = "update Alunos set ".
"nomeAluno='$nome',".
"rg='$rg',".
"orgaoExpeditor='$orgaoExpeditor',".
"endereco='$endereco',".
"numero='$numero',".
"complemento='$complemento',".
"bairro='$bairro',".
"ddd='$ddd',".
"telefone='$telefone',".
"ddd2='$ddd2',".
"telefone2='$telefone2',".
"cep='$cep',".
"email='$email',".
"estadoCivil='$estadoCivil',".
"sexo='$sexo',".
"RM='$RM',".
"nascimento='$nascimento'".
//"codCidadeNascimento=$codCidade".
//"codEscolaEM=$codEscolaEM".
" where codAluno=$cod";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
	//echo json_encode(array('msg'=>$sql));
	
} else {
	echo json_encode(array('msg'=>'Erro ao gravar dados.'.$sql));
}
?>