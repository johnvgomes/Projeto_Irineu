<style>
    article{
        float: left;
        border:1px #ccc solid;
        padding: 1%;
        border-radius: 10px;
        background: white;
        margin: 1%;
    }
    
    article a{
        text-decoration: none;
        color: red;
    }
    
</style>
<?php

include_once '../class/Departamento.php';
$d = new Departamento();

$d->consultar();

?>
