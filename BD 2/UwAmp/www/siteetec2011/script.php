<?php
$texto="../../";
?>
<link href="<?php echo $texto.URL::getBase() ?>estilo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../<?php echo $texto.URL::getBase() ?>imagem/etec.ico" />

<!--In�cio do c�digo do Banner Rotativo-->
    <link rel="stylesheet" href="<?php echo $texto.URL::getBase() ?>themes/pascal/pascal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $texto.URL::getBase() ?>nivo-slider.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo $texto.URL::getBase() ?>scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $texto.URL::getBase() ?>jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
<!--Fim do c�digo do Banner Rotativo-->
<link rel="stylesheet" href="<?php echo $texto.URL::getBase() ?>01/lavalamp_test.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo $texto.URL::getBase() ?>01/jquery-1.1.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $texto.URL::getBase() ?>01/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo $texto.URL::getBase() ?>01/jquery.lavalamp.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#2").lavaLamp({
                fx: "backout", 
                speed: 700,
                click: function(event, menuItem) {
                    return false;
                }
            });
        });
    </script>
 