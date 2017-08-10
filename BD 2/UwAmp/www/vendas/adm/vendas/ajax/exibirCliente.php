<?php

require_once '../../../class/Vendas.php';
require_once '../../../class/Controles.php';
$v = new Vendas();
$co = new Controles();

$id = (int) $co->limparTexto($_POST['id']);

$v->exibirCliente($id);
?>