
<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Diário de classe</title>
		<link rel="stylesheet" href="bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>


<?php

include '../../conexao/conn.php';

$observacao = $_POST["observacao"];
$codTurma = $_POST["codTurma"];
$codDisciplina = $_POST["codDisciplina"];
$mes = $_POST["mes"];


$sql = "INSERT INTO ObservacoesDiarios (codObservacaoDiario, codTurma, codDisciplina, data, observacao, mes)
		VALUES (0, $codTurma, $codDisciplina, NOW(), '$observacao', $mes)";
$rs = mysql_query($sql);

if( mysql_errno() == 0){
?>
<div class="alert alert-success" data-alert="alert"><a class="close" data-dismiss="alert">×</a>Observação cadastrada com sucesso! Voltar para a <a href="diario.php">página anterior</a>.</div>
<?php
}else{
?>

<div class="alert alert-error" data-alert="alert"><a class="close" data-dismiss="alert">×</a>Erro ao cadastrar observação! Voltar para a <a href="diario.php">página anterior</a>.</div>

<?php
}

?>