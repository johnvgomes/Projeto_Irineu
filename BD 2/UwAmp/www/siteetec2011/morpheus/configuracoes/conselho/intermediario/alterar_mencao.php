<?php
session_name('jcLogin');
session_start();

include '../../../conexao/conn.php';

if(!($_SESSION['id']) || $_SESSION['perfil']!= 1){
	header("Location: ../../../index.php");
	exit;
}


$codAluno = $_GET["codaluno"];
$codDisciplina = $_GET["codDisciplina"];
$codTurma = $_GET["codTurma"];
$nChamada = $_GET["nChamada"];
$codEtapa = $_GET["codEtapa"];

if ($_GET["confirm"]==1){
	$mi = $_GET["mi"];
	$mf = $_GET["mf"];
		$sql = "REPLACE Mencoes SET mencaoIntermediaria='$mi', mencaoFinal='$mf' ,
				codAluno=$codAluno,
				codDisciplina=$codDisciplina,
				codEtapa=$codEtapa";
	$rs = mysql_query($sql);
	if ($_GET["tipo"]=="conselho"){
		if ($_GET["alterarMI"]==1){
			mysql_query("UPDATE Mencoes SET MIalteradaPeloConselho=1 
							WHERE codAluno=$codAluno
							AND codDisciplina=$codDisciplina
							AND codEtapa=$codEtapa");
		}
		if ($_GET["alterarMF"]==1){
			mysql_query("UPDATE Mencoes SET MFalteradaPeloConselho=1 
							WHERE codAluno=$codAluno
							AND codDisciplina=$codDisciplina
							AND codEtapa=$codEtapa");
		}
	}
	if ($rs){
		if ($_GET["retorno"]==2){
			header("Location: conselho_intermediario2.php?codturma=$codTurma&nchamada=$nChamada");
		}else{
			header("Location: conselho_intermediario.php?codturma=$codTurma&nchamada=$nChamada");
		}
		
	}else{
		echo "Erro ao alterar nota.";
		echo mysql_error();
		echo "<br>".$sql;
	}
	exit();
}


$sql = "SELECT * FROM Alunos WHERE codAluno=$codAluno";
$rs = mysql_query($sql);
$nome = mysql_result($rs, 0, "nomeAluno");

$sql = "SELECT * FROM Disciplinas WHERE codDisciplina=$codDisciplina";
$rs = mysql_query($sql);
$disciplina = mysql_result($rs, 0, "disciplina");

$sql = "SELECT * FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa";
$rs = mysql_query($sql);
$MI = mysql_result($rs, 0, "mencaoIntermediaria");
$MF = mysql_result($rs, 0, "mencaoFinal");


?>

<html><head>
<meta charset="utf-8">
<title>ETECIA - Conselho Final</title>
<link type="text/css" href="../../../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../../jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="../../../includes/bootstrap.css">
<style type="text/css">
p, label{
	font-size: 1.2 em ;
}
body{
	margin: 50px 200px 0px 200px;
}
</style>
<script type="text/javascript">

	$(function(){
		$("#blocomi").hide();
		$("#blocomf").hide();
		$("#alterarMI").click(function(){
			$("#blocomi").toggle("slow");
		})	
		$("#alterarMF").click(function(){
			$("#blocomf").toggle("slow");
		})	
	});
</script>
</head>
<body>


	<h1>Alteração de Menção</h1><p></p>
	<p class="lead">Você está prestes a alterar a menção do aluno <strong><?php echo $nome?></strong> na disciplina de <strong><?php echo $disciplina?></strong>.</p>
	<p class="lead">Selecione o motivo da alteração, digite a nova menção e clique em gravar</p>
	
	<form>
	  <fieldset>
		<label class="radio">
		  <input type="radio" name="tipo" id="optionsRadios1" value="conselho" checked>
			  Alteração solicitada pelo conselho
		</label>
		<label class="radio">
		  <input type="radio" name="tipo" id="optionsRadios2" value="professor">
		  Alteração solicitada pelo professor da disciplina
		</label><br>
		<p><input type="checkbox" name="alterarMI" id="alterarMI" value=1>
		Alterar menção Intermediária <span id="blocomi">de <strong><?php echo $MI ?></strong> para 
			<select class="input-small" name="mi" id="mi">
			  <option value="I" <?php if ($MI=="I") echo "selected=selected";?> >I</option>
			  <option value="R" <?php if ($MI=="R") echo "selected=selected";?> >R</option>
			  <option value="B" <?php if ($MI=="B") echo "selected=selected";?> >B</option>
			  <option value="MB" <?php if ($MI=="MB") echo "selected=selected";?> >MB</option>
			</select></span>
		</p>
		<p><input type="checkbox" name="alterarMF" id="alterarMF" value=1>
		Alterar menção Final <span id="blocomf"> de <strong><?php echo $MF ?></strong> para 
			<select class="input-small" name="mf" id="mf">
			  <option value="I" <?php if ($MF=="I") echo "selected=selected";?> >I</option>
			  <option value="R" <?php if ($MF=="R") echo "selected=selected";?> >R</option>
			  <option value="B" <?php if ($MF=="B") echo "selected=selected";?> >B</option>
			  <option value="MB" <?php if ($MF=="MB") echo "selected=selected";?> >MB</option>
			</select></span>
		</p>
		<input type=hidden name=confirm value=1>
		<input type=hidden name=codaluno value=<?php echo $codAluno; ?> >
		<input type=hidden name=codDisciplina value=<?php echo $codDisciplina; ?> >
		<input type=hidden name=codEtapa value=<?php echo $codEtapa; ?> >
		<input type=hidden name=codTurma value=<?php echo $codTurma; ?> >
		<input type=hidden name=nChamada value=<?php echo $nChamada; ?> >
		<input type=hidden name=retorno value=<?php echo $_GET["retorno"]; ?> >

	    <button type="submit" class="btn btn-large btn-primary">Gravar</button>
	    <a href="<?php echo 'conselho_intermediario.php?codturma='.$codTurma.'&nchamada='.$nChamada;?>" class="btn btn-large">Cancelar</a>
	  </fieldset>
	</form>
	

	
</body>
</html>