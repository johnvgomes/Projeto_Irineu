<?php
session_name('jcLogin');
session_start();

include '../../../conexao/conn.php';

if(!($_SESSION['id']) || $_SESSION['perfil']!= 1){
	header("Location: ../../../index.php");
	exit;
}

$codTurma = $_GET["codturma"];
$nChamada = $_GET["nchamada"];

//Buscar a quantidade de alunos na turma
$sqlQtde = "SELECT COUNT(codMatricula) AS total FROM Matriculas WHERE codTurma=$codTurma";
$rsQtde = mysql_query($sqlQtde);
$qtdeAlunos = mysql_result($rsQtde, 0, "total");

// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Turmas WHERE codTurma=$codTurma");
$codEtapa = mysql_result($rsEtapaAtual, 0, "codEtapa");

//verificar se o curso é semestral ou anual
$rsPeriodicidade = mysql_query("SELECT * FROM Etapas WHERE codEtapa=$codEtapa");
if (mysql_result($rsPeriodicidade, 0, "semestre")==0) $periodicidade="anual"; else $periodicidade="semestral";


//Buscar dados do aluno
$sql = "SELECT Alunos.codAluno, Alunos.nomeAluno, Turmas.modulo, Series.serie, Alunos.rg, Alunos.RM, Cursos.habilitacao, Periodos.descricaoPeriodo, Matriculas.status, Matriculas.codMatricula, Cursos.codCurso FROM Alunos 
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
$foto = $aluno["RM"];
$diretorio = "../../alunos/fotos/";

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
<style type="text/css">
.vermelho {
	color: red;
	font-weight: bold;
}
.mencao{
	cursor: pointer;
}
</style>

<script type="text/javascript">

	$(function() {
		$("#desfazer").hide();
		$(".mencao").click(function(){
			var disciplina = $(this).attr("id");
			var url = "alterar_mencao.php?codEtapa=<?php echo $codEtapa?>&codDisciplina="+disciplina+"&codaluno=<?php echo $codAluno;?>&codTurma=<?php echo $codTurma;?>&nChamada=<?php echo $nChamada;?>";
			$(window.document.location).attr('href',url);
		});
		$("#art52").click(function(){
			var codmatricula = <?php echo $codMatricula; ?>;
			$.post("gravar_situacao.php", {codMatricula: codmatricula, situacao: 'Promovido pelo artigo 52'})
				.success(function(){
					$("#situacao_final").hide('highlight');
					$("#situacao_final").html('Aprovado pelo artigo 52');
					$("#desfazer").show();
					$("#situacao_final").show('highlight');
					$("#art52").hide();
				})
				.error(function(){
					alert("Erro ao gravar situação final");
				});
		});
		$("#despromover").click(function(){
			var codmatricula = <?php echo $codMatricula; ?>;
			$.post("despromover.php", {codMatricula: codmatricula})
				.success(function(){
					$("#situacao_final").hide('highlight');
					$("#situacao_final").html('Retido por falta');
					$("#situacao_final").show('highlight');
					$("#desfazer").hide();
					$("#art52").show();
				})
				.error(function(){
					alert("Erro ao gravar situação final");
				});
		});
		$("#reprovar").click(function(){
			var codmatricula = <?php echo $codMatricula; ?>;
			$.post("gravar_situacao.php", {codMatricula: codmatricula, situacao: 'Retido'})
				.success(function(){
					$("#situacao_final").hide('highlight');
					$("#situacao_final").html('Retido');
					$("#situacao_final").show('highlight');
					$("#reprovar").hide();
				})
				.error(function(){
					alert("Erro ao gravar situação final");
				});
		});
		$("#resumo").change(function(){
			var codmatricula = <?php echo $codMatricula; ?>;
			var resumo = $(this).val();
			$.post("gravar_resumo.php", {codMatricula: codmatricula, resumo: resumo})
				.error(function(){
					alert("Erro ao gravar resumo de discussões");
				});
		});
	});

</script>
</head>
<body>

<div class="row-fluid">
  <div class="span2	">
  	<?php 
  		if (file_exists($diretorio.$foto.".jpg")){
  			echo "<img src='$diretorio$foto".".jpg' class='img-polaroid' width=118 height=116 />";
  		}elseif (file_exists($diretorio.$foto.".jpeg")){
  			echo "<img src='$diretorio$foto".".jpeg' class='img-polaroid' width=118 height=116 />";
  		}else{
  			echo "<img src='$diretorio"."sem_foto.gif' class='img-polaroid' />";
  		}
  	?>
  </div>
  <div class="span6">

  	<h1><?php echo $aluno["nomeAluno"]; ?></h1>
  		<h4><strong>Turma:</strong> <?php echo $aluno["modulo"].$aluno["serie"] ?>  </h4>
  		<h4><strong>N. Chamada:</strong> <?php echo $nChamada; ?></h4>
  		<h4><strong>RM:</strong> <?php echo $aluno["RM"]; ?></h4>
  		<h4><strong>Curso:</strong> <?php echo $aluno["habilitacao"]; ?> </h4>
  		<h4><strong>Período:</strong> <?php echo $aluno["descricaoPeriodo"]; ?> </h4>
  		<h4><strong>Status:</strong> <?php echo $status; ?> </h4>
  </div>
  <div class="span4">
  	<h4>Progressão Parcial Módulo 1:</h4><?php echo $pp1; ?>
  	<h4>Progressão Parcial Módulo 2:</h4><?php echo $pp2; ?>
  	<h4>Progressão Parcial Módulo 3:</h4><?php echo $pp3; ?>
  	<?php
  	$sqlResumo = "SELECT * FROM DecisoesConselho WHERE codMatricula=$codMatricula";
  	$rsResumo = mysql_query($sqlResumo);
  	$resumo = mysql_result($rsResumo, 0, "resumo"); 
  	?>
  	<textarea id="resumo" class="input-large" placeholder="Resumo das discussões"><?php echo $resumo;?></textarea>
  </div>

</div>

<div class="row-fluid">
	<?php if ($nChamada > 1) { ?>
		<div class="span1">
			<a href="conselho_final.php?codturma=<?php echo $codTurma?>&nchamada=<?php echo $nChamada-1?>" class="btn"><</a>
		</div>
	<?php } else { ?>
		<div class="span1">&nbsp;</div>
	<?php }?>
	<?php if ($nChamada < $qtdeAlunos) { ?>
		<div class="span1">
			<a href="conselho_final.php?codturma=<?php echo $codTurma?>&nchamada=<?php echo $nChamada+1?>" class="btn">></a>
		</div>
	<?php } ?>
</div>

<?php 

//Buscar disciplinas do módulo
$codCurso = $aluno["codCurso"];
$modulo = $aluno["modulo"];
$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ORDER BY numeroPlanoDeCurso";
$rsDisciplinas = mysql_query($sqlDisciplinas);
echo mysql_error();

?>

<table class="table table-hover">
	<thead>
	<tr>
		<th>Sigla</th>
		<th>Disciplina</th>
		<th>Aulas</th>
		<th>Faltas</th>
		<th>%</th>
		<?php 
		if ($periodicidade=="anual"){
			echo "<th>MI</th><th>MI</th>";
		}
		?>
		<th>MI</th>
		<th>MF</th>
		<th>Situação</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$soma_aulas = 0;
	$soma_faltas = 0;
	$situacao_final ="";
	$tem_PP = false;
	$PP_count=0;
	$tem_Indefinido = false;
	while ($disciplina = mysql_fetch_array($rsDisciplinas)) { 
		$codDisciplina = $disciplina["codDisciplina"];

		//Verificar se o aluno tem dispensa na disciplina
		$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula AND codDisciplina=$codDisciplina";
		$rsDispensa = mysql_query($sqlDispensa);
		if (mysql_num_rows($rsDispensa)>0){
			echo "<tr>";
			echo "<td>".$disciplina["sigla"]."</td>";
			echo "<td>".$disciplina["disciplina"]."</td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td>Dispensado</td>";
			echo "</tr>";
			continue;
		}

		//Buscar aulas dadas
		$sqlAulasDadas = "SELECT SUM(qtdeAulas) as aulasDadas FROM Encontros 
								WHERE codTurma=$codTurma 
								AND codDisciplina=$codDisciplina";

		$rsAulasDadas = mysql_query($sqlAulasDadas);
		$total_aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");
		if ($periodicidade=="semestral") $total_aulas_dadas*=1.25;	
		$total_aulas_dadas = number_format($total_aulas_dadas,1);
		$soma_aulas += $total_aulas_dadas;

		//Pegar as faltas digitadas
			$sqlTotalFaltas = "SELECT count(codChamada) as faltas, Encontros.codDisciplina FROM Faltas
										INNER JOIN Aulas ON Aulas.codAula=Faltas.codAula
										INNER JOIN Encontros ON Encontros.codEncontro=Aulas.codEncontro
										INNER JOIN Turmas ON Turmas.codTurma=Encontros.codTurma
										INNER JOIN Disciplinas ON Disciplinas.codDisciplina = Encontros.codDisciplina
										WHERE codAluno=$codAluno
										AND Encontros.codTurma=$codTurma
										AND Disciplinas.codDisciplina=$codDisciplina";

			$rsTotalFaltas = mysql_query($sqlTotalFaltas);
			$total_faltas = mysql_result($rsTotalFaltas, 0 , "faltas");
			$total_faltas = number_format($total_faltas, 1);

			if ($periodicidade=="semestral") $total_faltas = $total_faltas*1.25;

		$soma_faltas += $total_faltas;
		$freq_p = (1 - ($total_faltas / $total_aulas_dadas) )* 100; 	
		$freq_p = number_format($freq_p,2);

		//Buscar menções
		$sqlMencoes = "SELECT * FROM Mencoes 
						WHERE codDisciplina=$codDisciplina
						AND codAluno=$codAluno
						AND codEtapa=$codEtapa";
		$rsMencoes = mysql_query($sqlMencoes);
		$mencaoIntermediaria = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
		$mencaoFinal = mysql_result($rsMencoes, 0, "mencaoFinal");
		$MIalteradoPeloConselho = (mysql_result($rsMencoes, 0, "MIalteradaPeloConselho")==0)?"":"*";
		$MFalteradoPeloConselho = (mysql_result($rsMencoes, 0, "MFalteradaPeloConselho")==0)?"":"*";

		//Se for Ensino Médio buscar outras menções
		if ($periodicidade=="anual"){
			$sqlMencoesEM = "SELECT * FROM Mencoes
							WHERE codDisciplina=$codDisciplina
							AND codAluno=$codAluno
							AND codEtapa=5";
			$rsMencoesEm = mysql_query($sqlMencoesEM);
			$mencaoIntermediaria1 = mysql_result($rsMencoesEm, 0, "mencaoIntermediaria");
			$mencaoIntermediaria2 = mysql_result($rsMencoesEm, 0, "mencaoFinal");
		}

		//Calcular situação final da disciplina
		$situacao = "";
		if ($mencaoFinal==""){
			$situacao = "Indefinido";
			$tem_Indefinido=true;
		}else{
			if($mencaoFinal=="I"){
				$situacao = "Reprovado";
				$tem_PP=true;
				if ($PP_count==0) $situacao_final.="PP em "; else $situacao_final.=", ";
				$situacao_final.=$disciplina["sigla"];
				$PP_count++;

			}else{
				$situacao = "Aprovado";
			}
		}
		if ($status!="MA") $situacao=$status;

		echo "<tr>";
		echo "<td>".$disciplina["sigla"]."</td>";
		echo "<td>".$disciplina["disciplina"]."</td>";
		echo "<td>".$total_aulas_dadas."</td>";
		echo "<td>".$total_faltas."</td>";
		$cor = ($freq_p < 75)?"vermelho":"preto";
		echo "<td><div class=$cor>".$freq_p."%</div></td>";
		if ($periodicidade=="anual"){
			$cor = ($mencaoIntermediaria1=="I")?"vermelho":"preto";
			echo "<td><div class='$cor mencao' id=$codDisciplina>".$mencaoIntermediaria1."</div></td>";	
			$cor = ($mencaoIntermediaria2=="I")?"vermelho":"preto";
			echo "<td><div class='$cor mencao' id=$codDisciplina>".$mencaoIntermediaria2."</div></td>";	
		}
		$cor = ($mencaoIntermediaria=="I")?"vermelho":"preto";
		echo "<td><div class='$cor mencao' id=$codDisciplina>".$mencaoIntermediaria.$MIalteradoPeloConselho."</div></td>";
		$cor = ($mencaoFinal=="I")?"vermelho":"preto";
		echo "<td><div class='$cor mencao' id=$codDisciplina>".$mencaoFinal.$MFalteradoPeloConselho."</div></td>";
		$cor = ($situacao=="Reprovado")?"vermelho":"preto";
		echo "<td><div class=$cor>".$situacao."</div></td>";
		echo "</tr>";
	 } 


	 $freq_total = (1 - ($soma_faltas / $soma_aulas) ) * 100;
	 $freq_total = number_format($freq_total,1);

	 //Definir situação final do aluno
	 if ($tem_Indefinido) $situacao_final="Indefinido";
	 else{
	 	if($freq_total<75){
	 		//verificar se já foi aprovado pelo art 52
	 		$sqlArt52 = "SELECT * FROM SituacaoFinal WHERE codMatricula=$codMatricula";
	 		$rsArt52 = mysql_query($sqlArt52);
	 		if(mysql_num_rows($rsArt52)>0){
	 			$situacao_final=mysql_result($rsArt52, 0, "situacao");
	 		}else{
				$situacao_final="Retido por falta";
			}
		}else{
		 	if(!$tem_PP){ 
		 		$situacao_final="Aprovado";
		 	}else{
		 		if ($PP_count > 3) $situacao_final = "Retido";
		 	}
	 	}
	 }
	 if ($status!="MA") $situacao_final = $status;

	 $cor = ($freq_total<75)?"vermelho":"preto";

	 if ($periodicidade=="anual") $span=4; else $span=2;

	 ?>
	 <tr>
	 	<th colspan=2 style="text-align:right">TOTAL</th>
	 	<th><?php echo $soma_aulas; ?></th>
	 	<th><?php echo $soma_faltas; ?></th>
	 	<th><div class=<?php echo $cor; ?> ><?php echo $freq_total; ?>%</div></th>
	 	<th colspan=<?php echo $span; ?>>Situação Final</th>
	 	<th><div id="situacao_final"><?php echo $situacao_final; ?></div></th>
	 </tr>

	 <tr id="desfazer"><td colspan=10 style="text-align:right">
	 	<a href="#" class="btn" id="despromover">Desfazer</a>
	 </td></tr>

 	<?php
		if($situacao_final=="Retido por falta"){
 			echo "<tr><th colspan=10 style='text-align:right'>";
 			echo "<a href='#' class='btn btn-primary' id='art52'>Promover pelo artigo 52</a>";
 			echo "</th></tr>";
 		}
 		if($tem_PP){
 			echo "<tr><td colspan=10 style='text-align:right'>";
 			echo "<a href='#' class='btn btn-danger' id='reprovar'>Reprovar</a>";
 			echo "</td></tr>";

 		}
 	?>

	</tbody>
</table>

	<div class="pagination pagination-centered pagination-mini">
	  <ul>
	  	<?php
	  	for ($i=1;$i<=$qtdeAlunos;$i++){
	  		if ( $nChamada==$i ) $classe = "class='active'"; else $classe="";
	    	echo "<li $classe><a href='conselho_final.php?codturma=$codTurma&nchamada=$i'>$i</a></li>";
	  	}
	?>
	  </ul>
	</div>

</body>
</html>