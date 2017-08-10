<?php

require_once '../../../class/Fotos.php';
require_once '../../../class/Controles.php';
$f = new Fotos();
$co = new Controles();

$id = (int) $co->limparTexto($_POST['id']);

$f->exibirFotos($id);
?>