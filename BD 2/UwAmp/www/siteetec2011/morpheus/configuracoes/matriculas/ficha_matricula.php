<html><head>
		<meta charset="utf-8">
		<title>Morpheus - Ficha de Matrícula</title>
		<link rel="stylesheet" href="../../includes/bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
<?php

//verificar se usuário está logado e se tem permissões
session_name('jcLogin');
session_start();

$codMatricula = $_GET["codMatricula"];

include '../../conexao/conn.php';

$sqlAluno = "SELECT (Alunos.nomeAluno) as nomeAluno, Alunos.*, Alunos.RM, Matriculas.nChamada, Cursos.habilitacao, Periodos.descricaoPeriodo, concat(Turmas.modulo,Series.serie) as turma, Turmas.modulo, Cursos.codCurso, Turmas.codEtapa, Series.codSerie FROM Alunos
				INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno
				INNER JOIN Turmas ON Turmas.codTurma=Matriculas.codTurma
				INNER JOIN Series ON Series.codSerie=Turmas.codSerie
				INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
				INNER JOIN Cursos ON Cursos.codCurso=Series.codCurso
				WHERE codMatricula=$codMatricula ";
$rsAluno = mysql_query($sqlAluno);

$codCurso = mysql_result($rsAluno, 0, "codCurso");
$modulo = mysql_result($rsAluno, 0, "modulo");
$codEtapa = mysql_result($rsAluno, 0, "codEtapa");
$codSerie = mysql_result($rsAluno, 0, "codSerie");
$codAluno = mysql_result($rsAluno, 0, "codAluno");
$rm = mysql_result($rsAluno, 0, "RM");
$rg = mysql_result($rsAluno, 0, "rg");
$cpf = mysql_result($rsAluno, 0, "cpf");
$uf = mysql_result($rsAluno, 0, "orgaoExpeditor");
$sexo = mysql_result($rsAluno, 0, "sexo");
$nomeAluno = mysql_result($rsAluno, 0, "nomeAluno");
$data_nascimento = implode("/", array_reverse( explode("-", mysql_result($rsAluno, 0, "nascimento"))));
$local_nascimento = utf8_encode( mysql_result($rsAluno, 0, "cidadeNascimento")." - ".mysql_result($rsAluno, 0, "estadoNascimento"));
$curso = mysql_result($rsAluno, 0, "habilitacao");
$turma = mysql_result($rsAluno, 0, "turma");
$periodo = mysql_result($rsAluno, 0, "descricaoPeriodo");
$endereco = mysql_result($rsAluno, 0, "endereco").", ". mysql_result($rsAluno, 0, "numero").". ".mysql_result($rsAluno, 0, "bairro").". ".mysql_result($rsAluno, 0, "cidade");
$complemento = mysql_result($rsAluno, 0, "complemento");
$cep = "CEP: ".mysql_result($rsAluno, 0, "cep");
$email = "E-mail: ". mysql_result($rsAluno, 0, "email");
$telefone1 = "tel.: (".mysql_result($rsAluno, 0, "ddd1").") ".mysql_result($rsAluno, 0, "telefone1");
$telefone2 = "tel.: (".mysql_result($rsAluno, 0, "ddd2").") ".mysql_result($rsAluno, 0, "telefone2");

$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo";
$rsDisciplina = mysql_query($sqlDisciplinas);

?>
<style>
table {
	font-size: 8px;
}
td {
	padding: 1px;
}
.espacado td {
	padding: 2px 1px;
}
.avaliacoes, .resumo {
	float: left;
	margin: 8px;
	text-align: center;
	border: 1px solid #000;
	padding: 15px;
}
.maior {
	font-size: 150%;
}
.box {
	height: 25px;
	border: solid 1px;
	text-align: center;
	text-transform: bold;
	font-size: 12pt;
	padding-top: 7px;
}
.cel {
	border: solid 1px;
	text-align: left;
	font-size: 10pt;
	padding: 7px;
}
.cel td{
	font-size: 8pt;
}
td{
	font-size: 9pt;
	height: 15px;
}
.pqno td{
	font-size: 8pt;
}

.square{
	border: solid 3px;
	width: 15px;
	height: 15px;
}
.bodered{
	border: solid 3px;
}
</style>
</head>
<body>
	<table>
		<tr class="pqno">
			<td rowspan=2><img src="../../logo_relatorio.png" /></td>
			<td>Estuda atualmente na ETEC?</td>
			<td class='square'></td>
			<td>sim</td>			
			<td class='square'></td>
			<td>não</td>
			<td>Curso:_____________________</td>
		</tr>
		<tr class="pqno">
			<td>Já estudou na ETEC?</td>
			<td class='square'></td>
			<td>sim</td>			
			<td class='square'></td>
			<td>não</td>
			<td>Curso:_____________________</td>
		</tr>
	</table>

<div class="row-fluid">
	<div class="span10">.</div>
  <div class="span2 offset2">
  	<table class="bodered">
		<tr><td><strong>RM: </strong></td>
			<td><?php echo $rm;?></td>
		</tr>
	</table></div>
</div>

<div class="box">REQUERIMENTO DE MATRÍCULA NA ETEC "MARTINHO DI CIERO" - 086 - ITU</div>

<div class="cel">
	<p>Ilmo Sr. Diretor da ETEC "MARTINHO DI CIERO":</p>
	<p><strong>Nome do Aluno:</strong> <?php echo $nomeAluno; ?></p>
</div>
<div class="row-fluid">
	<div class="span2 cel">
		<p><strong>RG</strong></p>
		<?php echo $rg; ?>
	</div> 
	<div class="span2 cel">
		<p><strong>UF</strong></p>
		<?php echo $uf; ?>
	</div> 
	<div class="span1 cel">
		<p><strong>Sexo</strong></p>
		<?php echo $sexo; ?>
	</div> 
	<div class="span2 cel">
		<p><strong>Afrodecendente</strong></p>
		<table><tr><td class="square"></td><td>sim.</td><td> </td><td class="square"></td><td>não</td></tr></table>
	</div> 
	<div class="span2 cel">
		<p><strong>Escolaridade pública</strong></p>
		<table><tr><td class="square"></td><td>sim.</td><td> </td><td class="square"></td><td>não</td></tr></table>
	</div> 
</div>
<div class="row-fluid">
	<div class="span5 cel">
		<p><strong>CPF do aluno</strong></p>
		<?php echo $cpf; ?>
	</div>
	<div class="span5 cel">
		<p><strong>CPF pai/mãe</strong></p>
	</div>
</div>
<div class="row-fluid">
	<div class="span5 cel">
		<p><strong>Data de Nascimento</strong></p>
		<?php echo $data_nascimento; ?>
	</div>
	<div class="span5 cel">
		<p><strong>Local de nascimento</strong></p>
		<?php echo $local_nascimento; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6 cel">
		<p><strong>Curso / Habilitação</strong></p>
		<?php echo $curso; ?>
	</div>
	<div class="span2 cel">
		<p><strong>Série / Modulo</strong></p>
		<?php echo $turma; ?>
	</div>
	<div class="span2 cel">
		<p><strong>Período</strong></p>
		<?php echo $periodo; ?>
	</div>
</div>
<br>
<p>Requer sua matricula para o Curso/Habilitação e período acima citados, para o _____________________________</p>
<p>Declaro estar ciente da existência do Regimento Comum das ETECs do CEETEPS e das Normas de Convivência disponíveis para consulta no site www.etecitu.com.br. Declaro ainda,  que as informações constantes neste documento representam a verdade.</p>
<p>Nestes termos, pede <strong>Deferimento</strong></p>
<div class="row-fluid">
	<div class="span8">.</div>
	<div class="span4 offset4">
		<table>
			<tr>
				<td class="square"></td>
				<td>Deferido</td>
				<td class="square"></td>
				<td>Indeferido</td>
			</tr>
		</table>
	</div>
</div>
<p>Itu, ________ de ____________________________ de _______________.</p>

<br><br>
<div class="row-fluid">
	<div class="span4">
		______________________________________
	</div>
	<div class="span2">
		.
	</div>
	<div class="span4">
		_______________________________________
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		Assinatura do Aluno ou Responsável
	</div>
	<div class="span2">
		.
	</div>
	<div class="span4">
		Diretor de Serviço - Área Acadêmica
	</div>
</div>
<br>
<div class="cel">
<table>
	<tr>
		<td>Raça/cor, conforme Portaria INEP 156 de 20/10/2004:</td>
		<td class="square"></td>
		<td>branca</td>
		<td class="square"></td>
		<td>preta</td>
		<td class="square"></td>
		<td>parda</td>
		<td class="square"></td>
		<td>amarela</td>
		<td class="square"></td>
		<td>indígena</td>
		<td class="square"></td>
		<td>não declarada</td>
	</tr>
	<tr>
		<td>Quantas pessoas compõe a família (incluindo o aluno)? </td>
		<td class="square"></td>
		<td>um</td>
		<td class="square"></td>
		<td>dois</td>
		<td class="square"></td>
		<td>três</td>
		<td class="square"></td>
		<td>quatro</td>
		<td class="square"></td>
		<td>cinco</td>
		<td class="square"></td>
		<td>seis ou mais</td>
	</tr>
	<tr>
		<td>Quantas pessoas da família exercem atividade remunerada? </td>
		<td class="square"></td>
		<td>um</td>
		<td class="square"></td>
		<td>dois</td>
		<td class="square"></td>
		<td>três</td>
		<td class="square"></td>
		<td>quatro</td>
		<td class="square"></td>
		<td>cinco</td>
		<td class="square"></td>
		<td>seis ou mais</td>
	</tr>
	<tr>
		<td>Qual é a renda famíliar (em salário mínimo nacional) ? </td>
		<td class="square"></td>
		<td>um</td>
		<td class="square"></td>
		<td>dois</td>
		<td class="square"></td>
		<td>três</td>
		<td class="square"></td>
		<td>quatro</td>
		<td class="square"></td>
		<td>cinco</td>
		<td class="square"></td>
		<td>seis ou mais</td>
	</tr>
</table>
</div>

<div class="row-fluid cel">
	<div class="span7">
		<p><strong>Endereço</strong></p>
		<p><?php echo $endereco. " ". $complemento. " ". $cep; ?></p>
		<p><?php echo $telefone1. " ". $telefone2. " ". $email; ?></p>
	</div>
</div>
<div class="cel">
	<p align="center"><strong>SITUAÇÃO ESCOLAR</strong></p>
	<table>
		<tr>
			<td class="square"></td>
			<td>Promovido no Vestibulinho</td>
			<td class="square"></td>
			<td>Transferido para este Estabelecimento de Ensino</td>
			<td class="square"></td>
			<td>Vaga Remanescente</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>Concluiu o Ensino Médio?</td>
			<td class="square"></td>
			<td>Sim - Ano de Conclusão: </td>
			<td class="square"></td>
			<td>Não - Série que está cursando:</td>
		</tr>
	</table>
	<p align="center">Escola onde estudou ou onde está estudando o Ensino Médio:</p>
	<div class="row-fluid">
		<div class="span7">Nome da Escola:</div>
		<div class="span2">Cidade:</div>
		<div class="span2">Série:</div>
	</div>

</div>
<img src="ficha_verso.jpg" />	
</body></html>
