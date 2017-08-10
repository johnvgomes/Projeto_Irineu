<?php

require_once '../../../class/Clientes.php';
require_once '../../../class/Controles.php';
$cl = new Clientes();
$co = new Controles();

$id = (int) $co->limparTexto($_POST['id']);

$cl->exibirEndereco($id);
?>