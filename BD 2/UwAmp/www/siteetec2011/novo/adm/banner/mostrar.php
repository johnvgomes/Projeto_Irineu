<table>
<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

    require_once '../class/Banner.php';
    $b = new Banner();
    $b->mostrar("adm");
}

?>
</table>