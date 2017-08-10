<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
// admin/eixo/consultar.php

include_once '../class/Eixo.php';
$e = new Eixo();

$e->consultar();
}
?>
