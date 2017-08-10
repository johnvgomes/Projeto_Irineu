<?php
$pagina = $_GET['np'];
include_once '../class/Noticia.php';
$n = new Noticia;
echo '<table><tr><td><h3>ETEC Itu news</h3></td></tr></table>';
$n->mostrar($pagina,"adm");
?>