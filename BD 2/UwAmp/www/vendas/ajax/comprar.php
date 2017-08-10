<?php

session_start();

require_once "../class/Carrinho.php";
require_once "../class/Controles.php";

$ca = new Carrinho();
$co = new Controles();

$id = (int) $co->limparTexto($_POST['id']);

echo $ca->comprar($id);
?>