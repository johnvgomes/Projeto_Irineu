<?php

include "../../conexao/conn.php";

for ($i=1;$i<=3;$i++){
	for($j=1;$j<=17;$j++){
		$sql = "INSERT INTO escalaFestaJunina (codTurno, codVaga) VALUES ($i, $j)";
		mysql_query($sql);
		echo mysql_error()."<br>";
	}
}

?>