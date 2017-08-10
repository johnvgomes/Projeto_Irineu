<?php
include '../../conexao/conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'disciplina';  
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
$offset = ($page-1)*$rows;

$result = array();

$rs = mysql_query("select count(*) from Disciplinas");  
$row = mysql_fetch_row($rs);  
$result["total"] = $row[0];  

$sql = "SELECT codDisciplina, numeroPlanoDeCurso, disciplina, sigla, cargaHoraria, Cursos.habilitacao AS curso, modulo FROM Disciplinas INNER JOIN Cursos ON Disciplinas.codCurso=Cursos.codCurso order by $sort $order limit $offset,$rows";
//echo $sql;
$rs = mysql_query($sql);

$rows = array();
while($row = mysql_fetch_object($rs)){
	array_push($rows, $row);
}
$result["rows"] = $rows;
echo json_encode($result);


?>