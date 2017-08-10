<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

    require_once "../class/Curso.php";

    $c = new Curso;

    $c->consultar();

}
?>