<?php

include '../../conexao/conn.php';
$rs = mysql_query("select nomeProfessor as professor, sum(cargaHoraria) as ch from Professores INNER JOIN Atribuicoes ON Professores.codProfessor=Atribuicoes.codProfessor INNER JOIN Disciplinas ON Disciplinas.codDisciplina=Atribuicoes.codDisciplina GROUP BY nomeProfessor");
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>