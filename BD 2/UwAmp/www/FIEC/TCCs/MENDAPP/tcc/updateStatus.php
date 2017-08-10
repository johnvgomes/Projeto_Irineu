<?php
include_once "conectar.php";

$con = new Conectar();

$id_pagina = $_GET["queixa"];

$query = $con->prepare("UPDATE respostas SET status=0, WHERE id_queixa ='$id_pagina'");
 $query -> execute();
?>