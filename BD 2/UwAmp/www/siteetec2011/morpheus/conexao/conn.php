<?php

$conn = @mysql_connect('186.202.152.67','site13710592332','u7p2x6z71981');
if (!$conn) {
	die('Erro ao conectar com banco de dados: ' . mysql_error());
}
mysql_select_db('site13710592332', $conn);
//mysql_select_db('etecia', $conn);

mysql_query("SET NAMES 'latin1'");
mysql_query("SET character_set_connection=latin1");
mysql_query("SET character_set_client=latin1");
mysql_query("SET character_set_results=latin1");

$server="localhost";
$db="etecia";
$user="root";
$pass="";
$version="0.8";
$pgport=5432;
$pchartfolder="./class/pchart2";

?>