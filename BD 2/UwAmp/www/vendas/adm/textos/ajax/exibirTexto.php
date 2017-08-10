<?php

require_once '../../../class/Textos.php';
require_once '../../../class/Controles.php';
$t = new Textos();
$co = new Controles();

$id = (int) $co->limparTexto($_POST['id']);

$t->exibirTexto($id);
?>