<?php
    require_once 'class/Noticia.php';
    
    $n = new Noticia();
    echo '<tr><td><h3>Exibi&ccedil;&atilde;o de Not&iacute;cia</h3></td></tr>';
    $n->carregarNoticia(Url::getURL(1),"");


?>
