<?php
include_once 'class/Noticia.php';
$n = new Noticia();

include_once 'class/Url.php';
$url = new Url();

include_once 'class/Video.php';
$v = new Video();
?>

<div class='pghome'>
    <?php //include_once 'banner.php'; ?>
</div>
<div class='pghomedir'>  
    <?php //$v->visualizar(); ?>
</div>

<div class='pgbarra'>
    <?php $n->ultimasNoticias($url->getBase()); ?>
</div>




