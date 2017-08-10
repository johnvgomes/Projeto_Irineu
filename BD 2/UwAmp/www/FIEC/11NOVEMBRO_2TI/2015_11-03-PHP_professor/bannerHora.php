<?php

$hora = @date("H");

if ($hora >= 6 && $hora < 12) {
    echo "Bom dia";
    echo "<img src='imagem/manha.png'>";   
} else if ($hora >= 12 && $hora < 19) {
    echo "Boa tarde";
    echo "<img src='imagem/tarde.png'>";
} else if ($hora >= 19 && $hora <= 23) {
    echo "Boa noite";
    echo "<img src='imagem/noite.png'>";
} else {
    echo "Madrugada";
    echo "<img src='imagem/madrugada.png'>";
}
?>
