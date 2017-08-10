<?php


$codAluno = $_POST["codaluno"];
$codAula = $_POST["codaula"];
$falta = $_POST["falta"];

include "../conexao/conn.php";

if ($falta=="false"){
	$sql = "INSERT INTO Faltas(".
			"codAluno, ".
			"codAula ".
			") ".
			"VALUES ( $codAluno, $codAula )";

}else{
	$sql = "DELETE FROM Faltas WHERE codAluno=$codAluno AND codAula=$codAula";
}


$rs = mysql_query($sql);


?>