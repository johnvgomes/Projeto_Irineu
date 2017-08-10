<?php 

$id = intval($_POST['codEncontro']);

include '../conexao/conn.php';

$sql = "DELETE FROM Encontros WHERE codEncontro=$id";

$result = @mysql_query($sql);

$sql = "DELETE FROM Aulas WHERE codEncontro=$id";

$result = @mysql_query($sql);


?>