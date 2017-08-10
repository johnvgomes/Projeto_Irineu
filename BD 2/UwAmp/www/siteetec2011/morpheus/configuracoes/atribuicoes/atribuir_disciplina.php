<?php

$codDisciplina = intval($_REQUEST['codDisciplina']);
$codProfessor = intval($_REQUEST['codProfessor']);
$codSerie = intval($_REQUEST['codSerie']);
$codEtapa = intval($_REQUEST['codEtapa']);

include '../../conexao/conn.php';

$sql = "INSERT INTO Atribuicoes (codAtribuicao, codDisciplina, codProfessor, codEtapa, codSerie) VALUES (0, $codDisciplina, $codProfessor, $codEtapa, $codSerie)";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao atribuir disciplina.'));
}
?>