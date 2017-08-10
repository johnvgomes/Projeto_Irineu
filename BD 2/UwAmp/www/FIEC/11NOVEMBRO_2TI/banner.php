<?php

$hora = date('H');

/*
 * se hora >= 6 e < 12 manha.png
 * se hora >= 12 e < 18 tarde.png
 * se hora >= 18 e <= 23 noite.png
 * senão madrugada.png  
 */

if($hora>=6 && $hora<12){
    $imagem = "manha.fw.png";
}else if($hora>=12 && $hora<18){
    $imagem = "tarde.fw.png";
}else if($hora>=18 && $hora<=23){
    $imagem = "noite.fw.png";
}else{
    $imagem = "madrugada.fw.png";
}
//criar 4 banners no fireworks de 800X200px
echo "<img src='imagem/$imagem' alt='Banner' />";


?>
