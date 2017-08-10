<?php

require_once '../../../class/Produtos.php';
require_once '../../../class/Controles.php';
$p = new Produtos();
$co = new Controles();

$id = (int) $co->limparTexto($_POST['id']);

$p->exibirDetalhes($id);
?>