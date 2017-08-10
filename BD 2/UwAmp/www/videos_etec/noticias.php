<?php

include_once 'class/Url.php';
$url = new Url();

@$pagina = $url->getURL(1);
include_once 'class/Noticia.php';
include_once 'class/Paginar.php';
$n = new Noticia();

echo "<h3>Notícias</h3>";

$n->paginar($pagina, "noticia", "imagem_noticia", "{$url->getBase()}imagem_noticia/", "{$url->getBase()}noticias/");
?>