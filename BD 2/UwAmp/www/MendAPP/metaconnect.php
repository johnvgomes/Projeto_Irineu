<?php

$host = "127.0.0.1";
$dbname = "mendapp";
$user = "root";
$pass = "";
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass) or die ("erro ao conectar");

//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
