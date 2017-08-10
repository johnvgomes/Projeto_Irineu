<?php
//      admin/moto/ultimoId.php

session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
} else {
    include_once '../class/Moto.php';
    $m = new Moto();
    
    $m->capturarId();
}
?>

