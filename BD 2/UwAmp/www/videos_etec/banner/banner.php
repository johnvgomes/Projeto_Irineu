
<?php
include_once 'class/Banner.php';
$b = new Banner();
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js" type="text/javascript"></script>

<script src="<?php echo $url->getBase(); ?>banner/js/jquery.chocoslider.js" type="text/javascript"></script>

<link rel="shortcut icon" href="favicon.ico">

<link href='http://fonts.googleapis.com/css?family=Open+Sans:800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url->getBase(); ?>banner/estilo.css">

<!--[if IE 7]>
 <link rel="stylesheet" type="text/css" media="screen" href="ie7.css">
<![endif]-->

<script type="text/javascript">
    $(window).load(function() {
        $('#slider').chocoslider();
    });
</script>



<div id="slider">
    <?php $b->consultar($url->getBase()); ?>
</div>


