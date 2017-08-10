<?php
include_once 'class/Noticia.php';
include_once 'class/Controles.php';
$n = new Noticia();
$ct = new Controles();
?>

<div class="posPesquisa">
    <div id='search-box'>
        <form action='' id='search-form' method='post' target='_top'>
            <div class="search">
                <input id='search-text' name='txtnoticia'  placeholder='Digite o titulo da noticia' type='text'required/>
                <input id ="botaobusca" name="botaobusca" type="submit" value="BUSCAR"/>
                
            </div>
            
            <style type="text/css">
                .ui-autocomplete {
                    max-height: 200px;
                    overflow-y: auto;
                    overflow-x: hidden;
                    padding-right: 20px;
                }
            </style>
            <script>
                $(document).ready(function() {
                    $(function() {
                        var noticia = [
<?php
$n->consultarTitulo();
?>

                        ];
                        $("#search-text").autocomplete({source: noticia});
                    });
                });

            </script>
        </form>
    </div>
</div>

<?php
if (isset($_POST['botaobusca'])) {
    $n->setUrl($ct->retirarAcentos(strtolower(utf8_encode($_POST['txtnoticia']))));
    ?>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!--light box inicio-->
    <script type="text/javascript" src="<?php echo $url->getBase(); ?>js/prototype.js"></script>
    <script type="text/javascript" src="<?php echo $url->getBase(); ?>js/scriptaculous.js?load=effects,builder"></script>
    <script type="text/javascript" src="<?php echo $url->getBase(); ?>js/lightbox.js"></script>
    <link rel="stylesheet" href="<?php echo $url->getBase(); ?>css/lightbox.css" type="text/css" media="screen" />
    <!--light box fim-->
    <?php
    include_once 'class/Url.php';

    $url = new Url();
   
    $n->visualizar($url->getBase(), $n->getUrl());
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
    <?php
}
?>