<?php 

$codAluno = $_POST["codaluno"];
$senha = $_POST["password"];
$email = $_POST["email"];

$sql = "UPDATE Alunos SET senha=md5('$senha'), email='$email' WHERE codAluno=$codAluno";

include '../../conexao/conn.php';

$result = @mysql_query($sql);

?>