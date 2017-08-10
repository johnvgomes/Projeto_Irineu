<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
// admin/curso/consultar.php

include_once '../class/Curso.php';
$c = new Curso();

$c->consultar();
}
?>
