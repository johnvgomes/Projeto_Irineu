<?php


$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nomeAluno';  
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';  
$offset = ($page-1)*$rows;

$result = array();

include '../../conexao/conn.php';

$rs = mysql_query("select count(*) from Alunos");
$row = mysql_fetch_row($rs);
$result["total"] = $row[0];

$rs = mysql_query("select Alunos.*, date_format(nascimento, '%d/%m/%Y') AS dataNascimento, Cidades.cidade, Cidades.estado, Cidades.pais from Alunos INNER JOIN Cidades ON Alunos.codCidadeNascimento=Cidades.codCidade order by $sort $order limit $offset,$rows");
$rows = array();
while($row = mysql_fetch_object($rs)){
	array_push($rows, $row);
}
$result["rows"] = $rows;
echo json_encode($result);

?>