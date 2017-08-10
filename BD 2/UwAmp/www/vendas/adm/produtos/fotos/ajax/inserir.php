<?php

extract($_POST, EXTR_OVERWRITE);

require_once '../../../../class/Fotos.php';
$f = new Fotos();

$local = $_FILES['arqImagem']['name'];
$localtemp = $_FILES['arqImagem']['tmp_name'];

$f->setLocal($local);
$f->setTplocal($localtemp);

$f->setDescricao($txtDescImg);

$chkPadrao = $chkPadrao === 'true' ? true : false;
$f->setPadrao($chkPadrao);

session_start();
$f->setId_produto($_SESSION['idProduto']);

$f->inserir();
?>