<?php

require_once '../../../../class/Itens.php';
require_once '../../../../class/Controles.php';
$i = new Itens();
$co = new Controles();

$id = (int) $co->limparTexto($_POST['id']);

$i->exibirItens($id);
?>