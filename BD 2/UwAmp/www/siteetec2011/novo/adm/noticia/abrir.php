<?php


require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){
    require_once '../class/Noticia.php';
    require_once '../class/Controles.php';
    $co = new Controles();
    
    $n = new Noticia();
    echo '<tr><td><h3>Exibi&ccedil;&atilde;o de Not&iacute;cia</h3></td></tr>';
    $n->carregarNoticia($co->limparTexto($_GET['id']),"adm");
}

?>
