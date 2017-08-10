<?php

$codencontro = $_REQUEST['edit_cod'];
$conteudo = $_REQUEST['edit_conteudo'];
$data = $_REQUEST['edit_data'];

$data = implode("-",array_reverse(explode("/",$data)));

include '../conexao/conn.php';

$sql = "UPDATE Encontros SET " .
		"data='$data', ".
		"conteudo='$conteudo' ".
		"WHERE codEncontro=$codencontro".
	"";

$result = @mysql_query($sql);

echo json_encode(array('msg'=>$sql));



?>