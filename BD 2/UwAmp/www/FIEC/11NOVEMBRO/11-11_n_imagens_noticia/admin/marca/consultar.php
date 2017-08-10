<?php

session_start();
if(!isset($_SESSION['sessao'])){
    echo "Sem acesso!";
}else{
    
//consultar.php de admin/marca

include_once '../class/Marca.php';

$ma = new Marca();

$ma->consultar();

}
?>
