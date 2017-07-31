<?php
include_once 'class/Url.php';
$url = new Url();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once 'head.php'; ?>
    </head>
    <body>
        <?php
        /* O MENU PODE SER INSERIDO FORA DO GERAL
        <nav>
            <?php include_once 'nav.php'; ?>            
        </nav>
         
         */
        ?>
        <div class="geral">
            <header>

            </header>

            <nav>
                <?php include_once 'nav.php'; ?>            
            </nav>

            <section>
                <?php
                $p = $url->getURL(0);

                if ($p == null)
                    $p = "pagina-inicial";

                if (!file_exists($p . ".php")) {
                    echo "<h3>Erro 404</h3>
                    <p>Página não encontrada</p>";
                } else {
                    include_once $p . ".php";
                }
                ?>
            </section>
        </div>
    </body>
</html>
<?php ?>