<?php

//propaganda.php

$imagem = array("img1.jpg","img2.jpg","img3.jpg");

//echo $imagem[2]; acessando a 3ª posição do vetor

$maximo = count($imagem)-1;

$posicao = rand(0,$maximo);

echo "<img src='imagem/$imagem[$posicao]' 
		alt='$imagem[$posicao]'>";

?>