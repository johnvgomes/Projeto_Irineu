<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

    require_once "../class/Epa.php";

    $e = new Epa;

    $e->consultar();

}
?>