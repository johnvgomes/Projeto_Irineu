<?php

$conn = @mysql_connect('187.45.196.160','etecia1','a1911d4N1');
if (!$conn) {
	die('Erro ao conectar com banco de dados: ' . mysql_error());
}
mysql_select_db('etecia', $conn);
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