<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Eixo.php';
$e = new Eixo();
?>


<table>
        <?php $e->consultar(); ?>
</table>


<?php
}
?>



