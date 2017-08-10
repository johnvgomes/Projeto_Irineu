<!-- bjqs.css contains the *essential* css needed for the slider to work -->
<link rel="stylesheet" href="jquery/bjqs.css">

<!-- some pretty fonts for this demo page - not required for the slider -->
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro|Open+Sans:300' rel='stylesheet' type='text/css'> 

<!-- demo.css contains additional styles used to set up this demo page - not required for the slider --> 
<link rel="stylesheet" href="jquery/demo.css">

<!-- load jQuery and the plugin -->
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="jquery/js/bjqs-1.3.min.js"></script>

<div id="banner-slide">

    <!-- start Basic Jquery Slider -->
    <ul class="bjqs">
        <li><a href=""><img src="imagem/banner2.fw.png" title="Precisa de ajuda com informática?"></a></li>
        <li><a href=""><img src="imagem/etec.fw.png" title="Faça um curso técnico gratuito"></a></li>

    </ul>
    <!-- end Basic jQuery Slider -->

</div>
<!-- End outer wrapper -->

<!-- attach the plug-in to the slider parent element and adjust the settings as required -->
<script class="secret-source">
    jQuery(document).ready(function($) {

        $('#banner-slide').bjqs({
            animtype: 'slide',
            height: 250,
            width: 800,
            responsive: true,
            randomstart: true
        });

    });
</script>
