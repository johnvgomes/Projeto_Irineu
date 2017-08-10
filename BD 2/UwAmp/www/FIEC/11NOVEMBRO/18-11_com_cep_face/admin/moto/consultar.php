<?php

session_start();
if(!isset($_SESSION['sessao'])){
    echo "Sem acesso!";
}else{
//consultar.php de admin/moto

include_once '../class/Moto.php';

$m = new Moto();

$m->consultar("admin");
}
?>
