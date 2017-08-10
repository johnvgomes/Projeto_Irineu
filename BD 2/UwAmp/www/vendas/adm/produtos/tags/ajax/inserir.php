<?php

extract($_POST, EXTR_OVERWRITE);

require_once '../../../../class/Tags.php';
$t = new Tags();

$t->setNome($txtNome);

session_start();
$t->setId_produto($_SESSION['idProduto']);

$t->inserir();
?>