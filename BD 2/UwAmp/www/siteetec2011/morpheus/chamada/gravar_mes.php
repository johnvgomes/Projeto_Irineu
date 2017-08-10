<?php

$mes = $_POST["mes"];

session_name('jcLogin');
session_start();

$_SESSION["mes"] = $mes;

?>