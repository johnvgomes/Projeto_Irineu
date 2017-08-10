<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php include_once 'head.php'; ?>
    </head>
    <body>
        <?php include_once 'nav.php'; ?>

        <div class="container">

            <div class="content">
                <?php
                @$p = $_GET['p'];
                if ($p == "" || $p == "index" || $p == "index.php") {
                    @include_once 'home.php';
                } else {
                    @include_once $p . '.php';
                }
                ?>
            </div>
        </div><!--fim container-->
        
        <div class="footer">
            Aula de PHP - Etec Itu
        </div>


    </body>
</html>
<?php
}
?>