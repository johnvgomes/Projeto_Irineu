<?php

extract($_POST, EXTR_OVERWRITE);

require_once '../class/Paginar.php';
$p = new Paginar();

require_once '../class/' . $tabela . '.php';
$x = new $tabela();

$filtro = $p->filtrar($marca, $preco, $ordem);
echo $x->numReg($arg, $filtro);
?>