<?php

$conn = @mysql_connect('localhost','root','pedreira');
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
$db="morpheus";
$user="root";
$pass="vertrigo";
$version="0.8";
$pgport=5432;
$pchartfolder="./class/pchart2";

?>