<?php
session_name('jcLogin');
session_start();

include '../../../conexao/conn.php';

if(!($_SESSION['id']) || $_SESSION['perfil']!= 1){
	header("Location: ../../../index.php");
	exit;
}

$codTurma = $_GET["codTurma"];

$sqlAlunos = "SELECT Alunos.codAluno, Alunos.nomeAluno, Alunos.rg, Matriculas.nChamada, Matriculas.codMatricula, Matriculas.status FROM Alunos
			INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno
			WHERE Matriculas.codTurma=$codTurma
			ORDER BY nChamada" ;

$rsAlunos = mysql_query($sqlAlunos);
echo mysql_error();



while ($aluno = mysql_fetch_array($rsAlunos)){
	$nChamada = $aluno["nChamada"];

	//Buscar a quantidade de alunos na turma
	$sqlQtde = "SELECT COUNT(codMatricula) AS total FROM Matriculas WHERE codTurma=$codTurma";
	$rsQtde = mysql_query($sqlQtde);
	$qtdeAlunos = mysql_result($rsQtde, 0, "total");

	// pegar a etapa atual;
	$rsEtapaAtual = mysql_query("SELECT Turmas.*, Etapas.etapa FROM Turmas INNER JOIN Etapas ON Etapas.codEtapa=Turmas.codEtapa WHERE codTurma=$codTurma");
	$codEtapa = mysql_result($rsEtapaAtual, 0, "codEtapa");
	$etapa = mysql_result($rsEtapaAtual, 0, "etapa");

	//verificar se o curso é semestral ou anual
	$rsPeriodicidade = mysql_query("SELECT * FROM Etapas WHERE codEtapa=$codEtapa");
	if (mysql_result($rsPeriodicidade, 0, "semestre")==0) $periodicidade="anual"; else $periodicidade="semestral";


	//Buscar dados do aluno
	$sql = "SELECT Alunos.codAluno, Alunos.nomeAluno, Turmas.modulo, Series.serie, Alunos.rg, Cursos.habilitacao, Periodos.descricaoPeriodo, Matriculas.status, Matriculas.codMatricula, Cursos.codCurso FROM Alunos 
			INNER JOIN Matriculas ON Matriculas.codAluno=Alunos.codAluno
			INNER JOIN Turmas ON Turmas.codTurma = Matriculas.codTurma
			INNER JOIN Series ON Series.codSerie=Turmas.codSerie
			INNER JOIN Cursos ON Cursos.codCurso=Series.codCurso
			INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
			WHERE Matriculas.codTurma=$codTurma
			AND Matriculas.nChamada=$nChamada ";
	$rs = mysql_query($sql);
	echo mysql_error();

	$aluno = mysql_fetch_assoc($rs);
	$codAluno = $aluno["codAluno"];
	$codMatricula = $aluno["codMatricula"];
	$status = $aluno["status"];
	$modulo = $aluno["modulo"];
	$codCurso = $aluno["codCurso"];

	$sqlQualificacao = "SELECT * FROM Qualificacoes WHERE codCurso=$codCurso AND modulo=$modulo";
	$rsQualificacao = mysql_query($sqlQualificacao);
	$qualificacao = mysql_result($rsQualificacao, 0, "qualificacao");

	//Buscas as PPs do aluno no modulo 1
	$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
				INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
				INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
				INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
				WHERE Alunos.codAluno=$codAluno
				AND pendente=1
				AND modulo=1";
	$rsPP = mysql_query($sqlPP);
	$pp1 = "";
	$cont=0;
	while ($r=mysql_fetch_array($rsPP)){
		if ($cont>0) $pp1 .=", ";
		$pp1 .= $r["sigla"];
		$cont++;
	}
	//Buscas as PPs do aluno no modulo 2
	$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
				INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
				INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
				INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
				WHERE Alunos.codAluno=$codAluno
				AND pendente=1
				AND modulo=2";
	$rsPP = mysql_query($sqlPP);
	$pp2 = "";
	$cont=0;
	while ($r=mysql_fetch_array($rsPP)){
		if ($cont>0) $pp2 .=", ";
		$pp2 .= $r["sigla"];
		$cont++;
	}
	//Buscas as PPs do aluno no modulo 3
	$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
				INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
				INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
				INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
				WHERE Alunos.codAluno=$codAluno
				AND pendente=1
				AND modulo=3";
	$rsPP = mysql_query($sqlPP);
	$pp3 = "";
	$cont=0;
	while ($r=mysql_fetch_array($rsPP)){
		if ($cont>0) $pp3 .=", ";
		$pp3 .= $r["sigla"];
		$cont++;
	}

	?>

	<html><head>
	<meta charset="utf-8">
	<title>ETECIA - Conselho Final</title>
	<link type="text/css" href="../../../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="../../../jquery/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
	<link rel="stylesheet" href="../../../includes/bootstrap.css">
	<link rel="stylesheet" href="style_certificado.css">

	<script type="text/javascript">

		$(function() {
		});

	</script>
	</head>
	<body>

	<div class="centro"><img src="../../conselho/ata/logoPaulaSouza.png"></div>
	<div class="titulo">CERTIFICADO</div>

	<p class="texto">O Diretor da Escola Técnica Estadual <strong>Irmã Agostina</strong> confere a <i><?php echo $aluno["nomeAluno"];?></i>, 
		RG <?php echo $aluno["rg"];?>, de Nacionalidade <?php echo $aluno["nacionalidade"];?>, natural de <?php echo $aluno["cidade_nascimento"];?>,
		Estado de <?php echo $aluno["estado"];?>, nascido em <?php echo $aluno["nascimento"];?> o presente <strong>CERTIFICADO</strong>
		por haver concluído em <?php echo $data_conclusao;?> a <strong>QUALIFICAÇÃO PROFISSIONAL de </strong><?php echo utf8_encode($qualificacao); ?> referente
		a conclusão do <?php echo $aluno["modulo"];?>&ordm; módulo do itinerário formativo do Curso Técnico de Habilitação Profissional
		de Nível Médio de Técnico em <?php echo $aluno["habilitacao"];?>
	</p>
	<p><?php echo $lei; ?></p>

	<p>São Paulo, data</p>




	<div class="row-fluid">
	  <div class="span9">
		<div class="boxEsquerda">ANO LETIVO / SEMESTRE</div>
		<div class="boxDireita"><?php echo $etapa; ?></div>
	  </div>
	  <div class="span3">
		<div class="boxEsquerda">RM</div>
		<div class="boxDireita"><?php echo $aluno["rg"]; ?></div>
	  </div>
	</div>
	<div class="row-fluid">
	  <div class="span9">
		<div class="boxEsquerda">NOME DO ALUNO</div>
		<div class="boxDireita"><?php echo $aluno["nomeAluno"]; ?></div>
	  </div>
	  <div class="span3">
		<div class="boxEsquerda">N.</div>
		<div class="boxDireita"><?php echo $nChamada; ?></div>
	  </div>
	</div>
	<div class="row-fluid">
	  <div class="span4">
		<div class="boxEsquerda">SÉRIE / MÓDULO</div>
		<div class="boxDireita"><?php echo $aluno["modulo"].$aluno["serie"] ?></div>
	  </div>
	  <div class="span4">
		<div class="boxEsquerda">CURSO</div>
		<div class="boxDireita"><?php echo $aluno["habilitacao"];  ?></div>
	  </div>
	  <div class="span4">
		<div class="boxEsquerda">TURNO</div>
		<div class="boxDireita"><?php echo $aluno["descricaoPeriodo"];  ?></div>
	  </div>
	</div>

	<table class="tableNotas">
		<tr>
			<td rowspan=3 class="vertical">MENÇÕES OBTIDAS</td>
			<td class="centro" style="width:200px">DISCIPLINAS</td>

	<?php

			//Buscar disciplinas do módulo
			$codCurso = $aluno["codCurso"];
			$modulo = $aluno["modulo"];
			$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ORDER BY numeroPlanoDeCurso";
			$rsDisciplinas = mysql_query($sqlDisciplinas);
			echo mysql_error();

			while ($disciplina = mysql_fetch_array($rsDisciplinas)) { 
				$codDisciplina = $disciplina["codDisciplina"];

				echo "<td class='vertical'>".$disciplina["disciplina"]."</td>";
			}

			?>
		</tr>
		<tr>
			<td style="height:40px;">Carga Horária</td>
			<?php
			$soma_CH = 0;
			//Buscar a carga horária digitada pela secretaria
			$rsDisciplinas = mysql_query($sqlDisciplinas);
			while ($disciplina = mysql_fetch_array($rsDisciplinas)) { 
				$codDisciplina = $disciplina["codDisciplina"];
				$sqlAulasDadas = "SELECT (aulasDadas) as aulasDadas FROM AulasDadas 
							WHERE codTurma=$codTurma
							AND codDisciplina=$codDisciplina";
				$rsAulasDadas = mysql_query($sqlAulasDadas);
				$total_aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");
				$total_aulas_dadas = number_format($total_aulas_dadas,1);
				echo "<td class='centro'>".$total_aulas_dadas."</td>";
				$soma_CH +=$total_aulas_dadas;
			}
			?>
		</tr>
		<tr>
			<td style="height:50px;">Conceito Final</td>
			<?php
			//Buscar a mençao
			$tem_I = false;
			$PP_count = 0;
			$situacao_final="";
			$rsDisciplinas = mysql_query($sqlDisciplinas);
			while ($disciplina = mysql_fetch_array($rsDisciplinas)) { 
				$codDisciplina = $disciplina["codDisciplina"];
				$sigla = $disciplina["disciplina"];
				$sqlMencoes = "SELECT * FROM Mencoes 
								WHERE codDisciplina=$codDisciplina
								AND codAluno=$codAluno
								AND codEtapa=$codEtapa";
				$rsMencoes = mysql_query($sqlMencoes);
				$mencaoFinal = mysql_result($rsMencoes, 0, "mencaoFinal");
				$MFalteradoPeloConselho = (mysql_result($rsMencoes, 0, "MFalteradaPeloConselho")==0)?"":"*";
				echo "<td class='centro'>".$mencaoFinal.$MFalteradaPeloConselho."</td>";
				if ($mencaoFinal=="I"){
					if ($PP_count==0) $situacao_final = "Promovido com PP em "; else $situacao_final.=", ";
					$situacao_final .= $sigla;
					$tem_I = true;
					$PP_count++;
				}
			}
			?>
		</tr>
	</table>

	<?php
		$limite = $soma_CH * 0.25;
		$limite = number_format($limite, 1);

		$sqlFreq = "SELECT SUM(faltas) as faltas FROM Frequencia 
				WHERE codMatricula=$codMatricula 
				AND codDisciplina=$codDisciplina";
		$rsFreq = mysql_query($sqlFreq);
		//echo mysql_error();
		if (mysql_num_rows($rsFreq)>0) $total_faltas = mysql_result($rsFreq, 0, "faltas"); else $total_faltas = 0;
		//se for turma do técnico multiplicar por 1.25
		if ($periodicidade=="semestral") $total_faltas = $total_faltas*1.25;

		$freq = (1 - ($total_faltas / $soma_CH) )* 100;
		$freq = number_format($freq, 1);

	?>

	<table class="tableFaltas">
		<tr><th colspan=4>ASSIDUIDADE</th></tr>
		<tr>
			<td>AULAS DADAS</td>
			<td><?php echo $soma_CH; ?></td>
			<td>LIMITE DE FALTAS</td>
			<td><?php echo $limite; ?></td>
		</tr>
		<tr>
			<td>TOTAL DE FALTAS</td>
			<td><?php echo $total_faltas; ?></td>
			<td>% DE FREQUÊNCIA</td>
			<td><?php echo $freq; ?>%</td>
		</tr>
	</table>

	<?php
		 	if($freq<75){
		 		//verificar se já foi aprovado pelo art 52
		 		$sqlArt52 = "SELECT * FROM SituacaoFinal WHERE codMatricula=$codMatricula";
		 		$rsArt52 = mysql_query($sqlArt52);
		 		if(mysql_num_rows($rsArt52)>0){
		 			$situacao_final=mysql_result($rsArt52, 0, "situacao");
		 		}else{
					$situacao_final="Retido por falta";
				}
			}else{
			 	if(!$tem_I){ 
			 		$situacao_final="Promovido";
			 	}else{
			 		if ($PP_count > 3) $situacao_final = "Retido";
			 	}
		 	}
		
		 if ($status!="MA") $situacao_final = $status;

	?>

	<table class="tableFaltas">
		<tr><th>RESULTADO FINAL</th></tr>
		<tr><td class="centro"><?php echo $situacao_final; ?></td></tr>
	</table>

	<table class="tableNotas">
		<tr>
			<td rowspan=4 style="width:300px;">Observações Progressão Parcial (PP)</td>
			<td style="width:200px;">1<sup>o</sup> Módulo</td>
			<td><?php echo $pp1; ?></td>
		</tr>
		<tr>
			<td>2<sup>o</sup> Módulo</td>
			<td><?php echo $pp2; ?></td>
		</tr>
		<tr>
			<td>3<sup>o</sup> Módulo</td>
			<td><?php echo $pp3; ?></td>
		</tr>
		<tr>
			<td>4<sup>o</sup> Módulo</td>
			<td></td>
		</tr>
	</table>

	<table class="tableFaltas">
		<tr>
			<th rowspan=2>Legenda</th>
			<td>CM = Cancelamento de Matricula</td>
			<td>TE = Transferência de Escola</td>
			<td>D = Dispensa</td>
			<td>DM = Destrancamento de matrícula</td>
		</tr>
		<tr>
			<td>MP = Mudança de Período</td>
			<td>PV = Pedido de Vaga</td>
			<td>TM = Trancamento de Matrícula</td>
			<td>MAC = Matrícula por Avaliação de Competência</td>
		</tr>	
	</table>
	<br><br>
	<div class="centro">São Paulo, 19 de Dezembro de 2012</div>
	<div class="centro"><img src="../../../assinaturas/fausto.jpg"></div>
	<div class="assinatura">Fausto Henrique Dos Santos Lima<br>Diretor de Serviços Acadêmicos</div>
	<div class="quebraPagina"></div>
<?php 

}

?>

</body>
</html>