<!--light box inicio-->
<script type="text/javascript" src="<?php echo $url->getBase(); ?>js/prototype.js"></script>
<script type="text/javascript" src="<?php echo $url->getBase(); ?>js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="<?php echo $url->getBase(); ?>js/lightbox.js"></script>
<link rel="stylesheet" href="<?php echo $url->getBase(); ?>css/lightbox.css" type="text/css" media="screen" />
<!--light box fim-->
<?php
include_once 'class/Url.php';
$url = new Url();

@$pagina = $url->getURL(1);
include_once 'class/Foto.php';
$f = new Foto();



$f->consultar("{$url->getBase()}");
?>
<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-2196019-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>