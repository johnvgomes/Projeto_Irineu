<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>
    <!DOCTYPE HTML>
    <html lang="pt-br">
        <head>
            <link rel='stylesheet' type='text/css' href='../../../css/preview.css' />

            <script src='../../../js/produtos.js'></script>
            <script src='../../../js/preview.js'></script>

            <script src='../../../js/jquery/jquery-1.11.0.min.js' charset='utf-8'></script>
        </head>
        <body>
        </body>
    </html>
    <?php
}
?>