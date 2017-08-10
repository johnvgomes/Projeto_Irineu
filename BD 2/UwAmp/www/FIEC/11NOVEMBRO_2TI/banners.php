<?php

echo $hora = date('H')."<br />";

$imagens = array("teste1.png","teste2.png","teste3.png");

$contar = count($imagens)-1;

$aleatorio = rand(0, $contar);

echo $imagens[$aleatorio];

?>
