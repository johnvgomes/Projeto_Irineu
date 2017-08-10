<?php
include_once 'class/Url.php';
include_once 'class/Pagina.php';

$url = new Url();
$p = new Pagina();

$p->visualizar($url->getBase(), $url->getURL(0),"");

echo "</div>";

?>