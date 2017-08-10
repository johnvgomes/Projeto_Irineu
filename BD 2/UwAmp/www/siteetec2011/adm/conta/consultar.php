<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

    require_once "../class/Conta.php";

    $c = new Conta;

    $c->consultarAdm();

}
?>