<?php
include_once "class/Url.php";
$url = new Url();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once 'head.php'; ?>
    </head>
    <body>

        <?php //include_once 'menuTeste.php'; ?>
        <?php //require_once('loaderscreen.php'); ?>
        <div class="barranav">
            <?php include_once 'barranav.php'; ?>
            <div class="barralink">
                <img src="<?php echo $url->getBase(); ?>imagem/etec2.fw.png">
            </div>
        </div>


        <div class="tudo">
            <section class="container">

                <section class="content">
                    <article>
                        <?php
                        $modulo = $url->getURL(0);

                        if ($modulo == null)
                            $modulo = "pagina-inicial";


                        if (file_exists($modulo . ".php"))
                            include_once
                                    $modulo . ".php";
                        else {
                            //include_once "class/Pagina.php";
                            $modulo = "pagina-inicial";
                            /* $p = new Pagina();

                              $p->mostrar($modulo, $url->getBase());
                             * 
                             */
                        }
                        ?>
                        <!--Fim do Box-->   
                    </article>
                </section>

            </section>
            <img src="<?php echo $url->getBase(); ?>imagem/barra.fw.png" width="8%">
            <footer>
                <article>
                    <div class="rodape">
                        <?php include_once 'rodape.php'; ?>
                    </div>

                </article>
            </footer>
        </div>

        <script src="<?php echo $url->getBase(); ?>js/pushy.min.js"></script>
    </body>
</html>
