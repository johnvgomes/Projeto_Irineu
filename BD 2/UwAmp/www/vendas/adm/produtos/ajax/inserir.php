<?php

extract($_POST, EXTR_OVERWRITE);

require_once '../../../class/Produtos.php';
$p = new Produtos();

$p->setNome($txtNome);

$p->setPreco($p->mudaFormato($numPreco));
$p->setPeso($p->mudaFormato($numPeso));

$p->setEstoque($numEstoque);

$p->controlaEstoque($numEstoque);

$p->setDescricao($txtDesc);

$chkDest = $chkDest === 'true' ? true : false;
$p->setDestaque($chkDest);

$p->setId_marca($cboMarca);
$p->setId_subcatego($cboSubcat);

$p->inserir();
?>