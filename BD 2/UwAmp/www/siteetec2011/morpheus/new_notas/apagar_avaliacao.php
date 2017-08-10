<?php 

$id = intval($_POST['codAvaliacao']);

include '../conexao/conn.php';

$sql = "DELETE FROM Avaliacoes WHERE codAvaliacao=$id";

$result = @mysql_query($sql);

?>