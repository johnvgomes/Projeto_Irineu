<?php

include '../../conexao/conn.php';

$codTurma = $_POST["codturma"];
if (isset($_POST["codDisciplina"])){
	$codDisciplina = $_POST["codDisciplina"];
}else{
	$codDisciplina=0;
}

$sql = "SELECT Turmas.*, Series.codCurso FROM Turmas INNER JOIN Series ON Series.codSerie=Turmas.codSerie WHERE codTurma=$codTurma";
$rs = mysql_query($sql);
$modulo = mysql_result($rs, 0, "modulo");
$codCurso = mysql_result($rs, 0, "codCurso");

$sql = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo";
$totalBusca = mysql_query($sql);

while( $linha = mysql_fetch_assoc($totalBusca) ){
	$cod = $linha["codDisciplina"];
	$selected = ($codDisciplina==$cod)?"selected=selected":"";
     echo "<option value='".$cod."' $selected>".htmlentities($linha["sigla"])."</option>\n";
}

?>