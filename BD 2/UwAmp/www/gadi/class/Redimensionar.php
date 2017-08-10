<?php

class Redimensionar {

    public function __construct() {
        
    }

    public function aplicar($imagem, $largura, $pasta, $name) {//indicar uns 400px
        if ($imagem['type'] == "image/jpeg") {
            $img = imagecreatefromjpeg($imagem['tmp_name']);
        } else if ($imagem['type'] == "image/gif") {
            $img = imagecreatefromgif($imagem['tmp_name']);
        } else if ($imagem['type'] == "image/png") {
            $img = imagecreatefrompng($imagem['tmp_name']);
        }
        $x = imagesx($img);
        $y = imagesy($img);
        $altura = ($largura * $y) / $x;

        $nova = imagecreatetruecolor($largura, $altura);
        imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);

        if ($imagem['type'] == "image/jpeg") {
            $local = "$pasta/$name" . ".jpg";
            imagejpeg($nova, $local);
        } else if ($imagem['type'] == "image/gif") {
            $local = "$pasta/$name" . ".gif";
            imagejpeg($nova, $local);
        } else if ($imagem['type'] == "image/png") {
            $local = "$pasta/$name" . ".png";
            imagejpeg($nova, $local);
        }

        imagedestroy($img);
        imagedestroy($nova);

        return $local;
    }

}

?>