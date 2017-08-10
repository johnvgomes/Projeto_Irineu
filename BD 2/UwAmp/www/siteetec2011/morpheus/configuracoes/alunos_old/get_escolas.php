<?php

include '../../conexao/conn.php';
$rs = mysql_query("select Escolas.codEscola, Escolas.nomeEscola, Cidades.cidade From Escolas INNER JOIN Cidades ON Escolas.codCidadeEscola=Cidades.codCidade");
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>