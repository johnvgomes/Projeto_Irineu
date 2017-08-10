<?php

require_once '../../../../class/Tags.php';
require_once '../../../../class/Controles.php';
$t = new Tags();
$co = new Controles();

$id = (int) $co->limparTexto($_POST['id']);

$t->excluir($id);
?>