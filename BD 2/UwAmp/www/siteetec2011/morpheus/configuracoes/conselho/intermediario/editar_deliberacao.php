<?php
session_name('jcLogin');
session_start();

include '../../../conexao/conn.php';

$retorno = $_GET["retorno"];
$codMatricula = $_GET["codMatricula"];
$codDisciplina = $_GET["codDisciplina"];

//Buscar dados do aluno
$sql = "SELECT Alunos.codAluno, Alunos.nomeAluno, Alunos.foto, Turmas.modulo, Series.serie, Alunos.rg, Alunos.RM, Cursos.habilitacao, Periodos.descricaoPeriodo, Matriculas.status, Matriculas.codMatricula, Cursos.codCurso FROM Alunos 
		INNER JOIN Matriculas ON Matriculas.codAluno=Alunos.codAluno
		INNER JOIN Turmas ON Turmas.codTurma = Matriculas.codTurma
		INNER JOIN Series ON Series.codSerie=Turmas.codSerie
		INNER JOIN Cursos ON Cursos.codCurso=Series.codCurso
		INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
		WHERE Matriculas.codMatricula=$codMatricula";
$rs = mysql_query($sql);
echo mysql_error();

$aluno = mysql_fetch_assoc($rs);
$codAluno = $aluno["codAluno"];
$codMatricula = $aluno["codMatricula"];
$status = $aluno["status"];
$foto = $aluno["foto"];
$diretorio = "../../alunos/fotos/";


?>

<html><head>
<meta charset="utf-8">
<title>ETECIA - Conselho</title>
<link type="text/css" href="../../../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../../jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="../../../includes/bootstrap.css">

<script type="text/javascript">

	$(function() {
		$(":checkbox").change(function(){
			var codMatricula = <?php echo $codMatricula; ?>;
			var codDisciplina = <?php echo $codDisciplina; ?>;
			var cod = $(this).attr("cod");
			var tabela = $(this).attr("tabela");
			var acao;
			if ($(this).is(":checked")) {
				acao = "insert";
			}else{
				acao = "delete";
			}
			$.post("gravar_deliberacao.php", {codMatricula: codMatricula, codDisciplina: codDisciplina, tabela: tabela, acao: acao, cod: cod})
				.error(function(){
					alert("Erro ao gravar deliberacao 11");
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
  <div class="span2"><br><br>
  	<?php
  	if (isset($_GET["retorno"])){
  		echo "<a class='btn btn-primary' href='../../../system.php#ui-tabs-$retorno' >Gravar e voltar</a>";
  	}else{
  		echo "<a class='btn btn-primary' href='javascript:window.history.go(-1)' >Gravar e voltar</a>";
  	}
	?>
	</div>
</div>


<?php 

$rsDificuldades = mysql_query("SELECT * FROM Dificuldades");
$rsRecomendacoes = mysql_query("SELECT * FROM Recomendacoes");
$rsProvidencias = mysql_query("SELECT * FROM Providencias");

?>
<div class="row">
  <div class="span5">
  	<table class="table table-hover">
  		<tr><th colspan=2>Dificuldades</th></tr>
  		<?php
  		$tabela = "Dificuldade";
  		while ($rDificuldade=mysql_fetch_array($rsDificuldades)){
  			$codDificuldade=$rDificuldade["codDificuldade"];
  			$dificuldade=$rDificuldade["descricaoDificuldade"];
  			$rsDelibDificuldade = mysql_query("SELECT * FROM Deliberacao11Dificuldade 
  												WHERE codDificuldade=$codDificuldade
  												AND codMatricula=$codMatricula
  												AND codDisciplina=$codDisciplina");
  			$checked = (mysql_num_rows($rsDelibDificuldade)>0)?"checked":"";
  			echo "<tr>";
  			echo "<td><input type=checkbox $checked tabela=$tabela cod=$codDificuldade></td>";
  			echo "<td>$dificuldade</td>";
  			echo "</tr>";
  		}
  		?>
  	</table>
  </div>
  <div class="span5">
  	<table class="table table-hover">
  		<tr><th colspan=2>Recomendações</th></tr>
  		<?php
  		$tabela = "Recomendacao";
  		while ($rRecomendacoes=mysql_fetch_array($rsRecomendacoes)){
  			$codRecomendacao=$rRecomendacoes["codRecomendacao"];
  			$recomendacao=$rRecomendacoes["descricaoRecomendacao"];
  			$rsDelibRecomendacao = mysql_query("SELECT * FROM Deliberacao11Recomendacao 
  												WHERE codRecomendacao=$codRecomendacao
  												AND codMatricula=$codMatricula
  												AND codDisciplina=$codDisciplina");
  			$checked = (mysql_num_rows($rsDelibRecomendacao)>0)?"checked":"";
  			echo "<tr>";
  			echo "<td><input type=checkbox $checked tabela=$tabela cod=$codRecomendacao></td>";
  			echo "<td>$recomendacao</td>";
  			echo "</tr>";
  		}
  		?>
  	</table>
  </div>
  <div class="span5">
  	<table class="table table-hover">
  		<tr><th colspan=2>Providências</th></tr>
  		<?php
  		$tabela = "Providencia";
  		while ($rProvidencia=mysql_fetch_array($rsProvidencias)){
  			$codProvidencia=$rProvidencia["codProvidencia"];
  			$providencia=$rProvidencia["descricaoProvidencia"];
  			$rsDelibProvidencia = mysql_query("SELECT * FROM Deliberacao11Providencia 
  												WHERE codProvidencia=$codProvidencia
  												AND codMatricula=$codMatricula
  												AND codDisciplina=$codDisciplina");
  			$checked = (mysql_num_rows($rsDelibProvidencia)>0)?"checked":"";
  			echo "<tr>";
  			echo "<td><input type=checkbox $checked tabela=$tabela cod=$codProvidencia></td>";
  			echo "<td>$providencia</td>";
  			echo "</tr>";
  		}
  		?>
  	</table>
  </div>
</div>

</body>
</html>