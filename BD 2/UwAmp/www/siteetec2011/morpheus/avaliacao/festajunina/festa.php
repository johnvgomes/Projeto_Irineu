<?php
include "../../conexao/conn.php";
session_name('jcLogin');
session_start();
?>

<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../../includes/bootstrap/css/bootstrap.css">
<link type="text/css" href="../../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../includes/jquery/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../includes/jquery/js/jquery-ui-1.8.21.custom.min.js"></script>
<script>
  $(function() {
    $( "#radio" ).buttonset();
  });
  </script>
</head>
<body style="margin:15px;">


<?php

if (isset($_POST["radio"])){
	$codTurno = $_POST["radio"];
	$codProfessor = $_SESSION['id'];
	$sqlInsert = "INSERT INTO escalaFestaJunina (codEscala, codTurno, codProfessor) VALUES (0, $codTurno, $codProfessor)";
	$rs = mysql_query($sqlInsert);
	if ($rs){
		?>
	<div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Horário inserido com sucesso.
    </div>	
	<?php
	}else{
	?>
	<div class="alert alert-error">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Erro ao inserir horário.
    </div>	
    <?php
	}
}

//Verificar se o usuário já gravou horário
$codProfessor = $_SESSION["id"];
$sqlConsulta = "SELECT * FROM escalaFestaJunina WHERE codProfessor=$codProfessor";
$rsConsulta = mysql_query($sqlConsulta);
if (mysql_num_rows($rsConsulta)>0){
	$codTurno = mysql_result($rsConsulta, 0, "codTurno");
	switch ($codTurno) {
		case '1':
			$turno = "11:00 até 14:00";
			break;
		case '2':
			$turno = "14:00 até 17:00";
			break;
		case '3':
			$turno = "17:00 até 20:00";
			break;
	}
	?>
	<div class="hero-unit">
  <h1>Horário Agendado</h1>
  <p>Você agendou seu horário para trabalhar das <strong><?php echo $turno; ?></strong>.</p>
  <p>Para alterar procure a coordenação.</p>
</div>
<?php
	exit();
}

$sqlPrimeiroTurno = "SELECT * FROM escalaFestaJunina WHERE codTurno=1";
$rsPrimeiroTurno = mysql_query($sqlPrimeiroTurno);
$ocupadoPrimeiroTurno = mysql_num_rows($rsPrimeiroTurno);
$vagasPrimeiroTurno = 17 - $ocupadoPrimeiroTurno;

$sqlSegundoTurno = "SELECT * FROM escalaFestaJunina WHERE codTurno=2";
$rsSegundoTurno = mysql_query($sqlSegundoTurno);
$ocupadoSegundoTurno = mysql_num_rows($rsSegundoTurno);
$vagasSegundoTurno = 17 - $ocupadoSegundoTurno;

$sqlTerceiroTurno = "SELECT * FROM escalaFestaJunina WHERE codTurno=3";
$rsTerceiroTurno = mysql_query($sqlTerceiroTurno);
$ocupadoTerceiroTurno = mysql_num_rows($rsTerceiroTurno);
$vagasTerceiroTurno = 17 - $ocupadoTerceiroTurno;

?>

<h1>Escala para Trabalho na Festa Junina </h1><h2>(sábado - 15 de junho)</h2>
<?php
if ( $vagasPrimeiroTurno<=0 && $vagasSegundoTurno<=0 && $vagasTerceiroTurno<=0){
	?>
	<div class="alert alert-error">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Não há mais horários disponíveis. Se você não agendou seu horário procure a cordenação.
    </div>	
 <?php
 exit();
}
?>
<h3>Selecione o horário que deseja trabalhar e clique em gravar</h3>
<div id="radio">
	<form action="festa.php" method="POST">
	<?php if ( $vagasPrimeiroTurno>0) {?>
    <input type="radio" id="radio1" name="radio" value="1"/><label for="radio1">11:00 - 14:00 (<?php echo $vagasPrimeiroTurno; ?> vagas)</label>
    <?php } if ( $vagasSegundoTurno>0) {?>
    <input type="radio" id="radio2" name="radio" value="2"/><label for="radio2">14:00 - 17:00 (<?php echo $vagasSegundoTurno; ?> vagas)</label>
    <?php } if ( $vagasTerceiroTurno>0) {?>
	<input type="radio" id="radio3" name="radio" value="3"/><label for="radio3">17:00 - 20:00 (<?php echo $vagasTerceiroTurno; ?> vagas)</label>
	<?php } ?>
 </div>
    <input type="submit" value="Gravar" class="btn btn-primary">
</form>