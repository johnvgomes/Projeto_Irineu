<?php
include "../../../conexao/conn.php";

$minimo = $_POST["minimo"];
$maximo = $_POST["maximo"];
$turma = $_POST["turma"];

$sql = "SELECT * FROM AlunosImport WHERE CLASS BETWEEN $minimo AND $maximo";

$rs = mysql_query($sql);

while($r = mysql_fetch_array($rs)){
	
	$nomeAluno 		= $r['NOME'];
	$rg 			= $r['RG'];
	$orgaoExpeditor	= $r['ORGAO_EXPEDIDOR'];
	$endereco		= $r['ENDERECO'];
	$numero			= $r['NUMERO'];
	$complemento	= $r['COMPLEMENTO'];
	$bairro			= $r['BAIRRO'];
	$ddd			= $r['DDD'];
	$telefone		= $r['TELEFONE'];
	$ddd2			= $r['DDD2'];
	$telefone2		= $r['TELEFONE2'];
	$cep			= $r['CEP'];
	$email			= $r['EMAIL'];
	$estadoCivil	= $r['ESTADO_CIVIL'];
	$sexo			= $r['SEXO'];
	$nascimento		= $r['DT_NASCIMENTO'];
	$codCidadeNascimento = 1;
//	$codCidadeNascimento = $r['CIDADE'];
	$acertos		= $r['ACERTOS'];
	$nota			= $r['NOTA'];
	$class			= $r['CLASS'];
	$escolaridade	= $r['ESCOLARIDADE'];
	$afrodescendente= $r['AFRO_DESC'];
	$curso			= $r['HABILITACAO'];
	$afrodescendente= $r['AFRO_DESC'];
	$periodo		= $r['PERIODO'];
	
	$sql = "INSERT INTO Alunos (codAluno, nomeAluno, rg, orgaoExpeditor, endereco, numero, complemento, bairro, ddd, telefone, ddd2, telefone2, cep, email, estadoCivil, sexo, nascimento, codCidadeNascimento, acertos, nota, class, escolaridadePublica, afrodescendente, curso, periodo, codTurma) VALUES (".
			"0, '$nomeAluno', '$rg', '$orgaoExpeditor', '$endereco', '$numero', '$complemento', '$bairro', '$ddd', '$telefone', '$ddd2', '$telefone2', '$cep', '$email', '$estadoCivil', '$sexo', '$nascimento', '$codCidadeNascimento', '$acertos', '$nota', '$class', '$escolaridade', '$afrodescendente', '$curso', '$periodo', '$turma' )";

	//echo $sql."<br>";
	mysql_query($sql);
	if (mysql_errno() == 0) echo mysql_error()."<br>";
}
 header("location: ../../../configuracoes.php");
?>
