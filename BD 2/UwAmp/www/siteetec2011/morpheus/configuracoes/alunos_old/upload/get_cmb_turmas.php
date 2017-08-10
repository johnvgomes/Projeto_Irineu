<select name="turma">
<?php

include '../../../conexao/conn.php';
$rs = mysql_query("select CONCAT(modulo,Series.serie) AS turma, codTurma, modulo, Series.serie, Etapas.etapa, Periodos.descricaoPeriodo AS periodo from Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie INNER JOIN Etapas ON Turmas.codEtapa=Etapas.codEtapa INNER JOIN Periodos ON Series.codPeriodo=Periodos.codPeriodo;");
$result = array();
while($row = mysql_fetch_array($rs)){
	echo "<option value=" . $row["codTurma"]. ">";
	echo $row["turma"] . " - " . $row["periodo"];
	echo "</option>";
}

?>
</select>