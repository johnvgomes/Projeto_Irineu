<?php 

$id = intval($_POST['codAvaliacao']);
$mostrar = intval($_POST['mostrar']);

include '../conexao/conn.php';

$sql = "UPDATE Avaliacoes SET mostrar=$mostrar WHERE codAvaliacao=$id";

$result = @mysql_query($sql);

?>