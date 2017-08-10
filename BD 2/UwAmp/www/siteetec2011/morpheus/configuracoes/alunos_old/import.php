<?php
echo "its work";

include "../../conexao/conn.php";

$handle = fopen('dados.csv', 'r');	

mysql_query("DELETE FROM AlunosTemp");

$registros_inseridos = 0;
$erros = 0;

while (($data = fgetcsv($handle, 1000, ",")) != FALSE){
	
	
	$NR_INSCRICAO 	= $data[0];
	$COD_CURSO	  	= $data[1];	
	$HABILITACAO	= $data[2];	
	$COD_ETE		= $data[3];	
	$NOME_ETE		= $data[4];	
	$NOSSO_NUMERO	= $data[5];	
	$DG				= $data[6];	
	$NOME			= $data[7];	
	$RG				= $data[8];	
	$ORGAO_EXPEDIDOR= $data[9];	
	$SEXO			= $data[10];
	$DT_NASCIMENTO	= $data[11];
	$ESTADO_CIVIL	= $data[12];
	$ENDERECO		= $data[13];
	$NUMERO			= $data[14];
	$COMPLEMENTO	= $data[15];
	$BAIRRO			= $data[16];
	$DDD			= $data[17];
	$TELEFONE		= $data[18];	
	$RAMAL			= $data[19];
	$CIDADE			= $data[20];
	$UF				= $data[21];
	$CEP			= $data[22];
	$AFRO_DESC		= $data[23];
	$ESCOLARIDADE	= $data[24];
	$PERIODO		= $data[25];
	$EMAIL			= $data[26];
	$NECESSIDADE	= $data[27];
	$NECESSIDADE_TIPO=$data[28];
	$TIPO_PROVA		=$data[29];
	$DDD2			= $data[30];
	$TELEFONE2		= $data[31];
	$RAMAL2			= $data[32];
	$COD_ESCOLA_CURSO=$data[33];
	$RESPOSTA		=$data[34];
	$F1				= $data[35];
	$F2				= $data[36];
	$F3				= $data[37];
	$F4				= $data[38];
	$F5				= $data[39];
	$ACERTOS		= $data[40];
	$NOTAENTREVISTA	= $data[41];
	$NOTA			= $data[42];
	$CLASS			= $data[43];
	$SITUACAO		= $data[44];
	$Q01			= $data[45];
	$Q02			= $data[46];
	$Q03			= $data[47];
	$Q04			= $data[48];
	$Q05			= $data[49];
	$Q06			= $data[50];
	$Q07			= $data[51];
	$Q08			= $data[52];
	$Q09			= $data[53];
	$Q10			= $data[54];
	$Q11			= $data[55];
	$Q12 			= $data[56];
	$Q13			= $data[57];
			
	$sql = "INSERT INTO AlunosImport (" .
	"NR_INSCRICAO 	      ".
	",COD_CURSO	  	      ".
	",HABILITACAO	      ".
	",COD_ETE		      ".
	",NOME_ETE		      ".
	",NOSSO_NUMERO	      ".
	",DG				      ".
	",NOME			      ".
	",RG				      ".
	",ORGAO_EXPEDIDOR      ".
	",SEXO			      ".
	",DT_NASCIMENTO	      ".
	",ESTADO_CIVIL	      ".
	",ENDERECO		      ".
	",NUMERO			      ".
	",COMPLEMENTO	      ".
	",BAIRRO		          ".
	",DDD			      ".
	",TELEFONE	          ".
	",RAMAL		          ".
	",CIDADE		          ".
	",UF			          ".
	",CEP			      ".
	",AFRO_DESC	          ".
	",ESCOLARIDADE         ".
	",PERIODO		      ".
	",EMAIL		          ".
	",NECESSIDADE	      ".
	",NECESSIDADE_TIPO     ".
	",TIPO_PROVA		      ".
	",DDD2			      ".
	",TELEFONE2		      ".
	",RAMAL2			      ".
	",COD_ESCOLA_CURSO     ".
	",RESPOSTA		      ".
	",F1				      ".
	",F2				      ".
	",F3				      ".
	",F4				      ".
	",F5				      ".
	",ACERTOS	          ".
	",NOTAENTREVISTA	      ".
	",NOTA			      ".
	",CLASS			      ".
	",SITUACAO		      ".
	",Q01			      ".
	",Q02                  ".
	",Q03                  ".
	",Q04                  ".
	",Q05                  ".
	",Q06                  ".
	",Q07                  ".
	",Q08                  ".
	",Q09                  ".
	",Q10                  ".
	",Q11                  ".
	",Q12                  ".
	",Q13                  ".
	") VALUES ( " .
	"'$NR_INSCRICAO 	'      ".
	",'$COD_CURSO	  	'      ".
	",'$HABILITACAO	    '  ".
	",'$COD_ETE		    '  ".
	",'$NOME_ETE		    '  ".
	",'$NOSSO_NUMERO	    '  ".
	",'$DG				'      ".
	",'$NOME			    '  ".
	",'$RG				'      ".
	",'$ORGAO_EXPEDIDOR  '    ".
	",'$SEXO			    '  ".
	",'$DT_NASCIMENTO	'      ".
	",'$ESTADO_CIVIL	    '  ".
	",'$ENDERECO		    '  ".
	",'$NUMERO			'      ".
	",'$COMPLEMENTO	    '  ".
	",'$BAIRRO		    '      ".
	",'$DDD			    '  ".
	",'$TELEFONE	        '  ".
	",'$RAMAL		    '      ".
	",'$CIDADE		    '      ".
	",'$UF			    '      ".
	",'$CEP			    '  ".
	",'$AFRO_DESC	    '      ".
	",'$ESCOLARIDADE     '    ".
	",'$PERIODO		    '  ".
	",'$EMAIL		    '      ".
	",'$NECESSIDADE	    '  ".
	",'$NECESSIDADE_TIPO '    ".
	",'$TIPO_PROVA		'      ".
	",'$DDD2			    '  ".
	",'$TELEFONE2		'      ".
	",'$RAMAL2			'      ".
	",'$COD_ESCOLA_CURSO '    ".
	",'$RESPOSTA		    '  ".
	",'$F1				'      ".
	",'$F2				'      ".
	",'$F3				'      ".
	",'$F4				'      ".
	",'$F5				'      ".
	",'$ACERTOS	        '  ".
	",'$NOTAENTREVISTA	'      ".
	",'$NOTA			    '  ".
	",'$CLASS			'      ".
	",'$SITUACAO		    '  ".
	",'$Q01			    '  ".
	",'$Q02              '    ".
	",'$Q03              '    ".
	",'$Q04              '    ".
	",'$Q05              '    ".
	",'$Q06              '    ".
	",'$Q07              '    ".
	",'$Q08              '    ".
	",'$Q09              '    ".
	",'$Q10              '    ".
	",'$Q11              '    ".
	",'$Q12              '    ".
	",'$Q13              '    ".
	")";			
	
	
	echo $sql . "<br>";
	mysql_query($sql);
	
	if (mysql_errno()==0) $registros_inseridos++;
	else {
		$erros++;
		echo "<br>Erro ao importar o aluno " . $nome;
	}
}

echo $registros_inseridos. " alunos importados com sucesso.<br>";
echo $erros . " erros";


?>
