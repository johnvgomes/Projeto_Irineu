<?php

session_start();

require_once "../class/Favoritos.php";
require_once "../class/Controles.php";

$fa = new Favoritos();
$co = new Controles();

$fa->setId_produto((int) $co->limparTexto($_POST['produto']));
$fa->setId_cliente((int) $co->limparTexto($_SESSION['clienteId']));

echo $fa->favoritar();
?>