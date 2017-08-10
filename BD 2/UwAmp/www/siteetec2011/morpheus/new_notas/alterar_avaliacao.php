<?php

$codavaliacao = $_REQUEST['edit_cod'];
$sigla = $_REQUEST['edit_sigla'];
$descricao = $_REQUEST['edit_descricao'];
$data = $_REQUEST['edit_data_ava'];

include '../conexao/conn.php';

$sql = "UPDATE Avaliacoes SET 
		sigla='$sigla',
		descricao='$descricao',
		data='$data'
		WHERE codavaliacao=$codavaliacao
		";

$result = @mysql_query($sql);



?>