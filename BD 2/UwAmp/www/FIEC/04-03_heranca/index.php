<html lang="pt-br">
    <head>
        <?php include_once 'head.php'; ?>
        <!--ALT SHIFT F-->
    </head>
    <body onload="time()">
        <div class="container">
            <div class="barranav">
                <?php include_once 'barranav.php'; ?>
            </div>
            <div class="header">
                
                <div id="hora"></div>

                <img src="imagem/logo.png">
            </div>
            <div class="content">
                <?php
                @$page = $_GET['p'];

                if (empty($page) || $page == "index" || $page == "index.php") {
                    include_once 'pagina-inicial.php';
                } else {
                    include_once $page . ".php";
                }
                ?>
            </div>
        </div>

        <div class="footer">
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>