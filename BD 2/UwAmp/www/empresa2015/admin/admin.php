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
        

        <div class="container">
            
            <?php include_once 'nav.php'; ?>

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
        
        <div class="footer">Informações gerais do site / Mapa do Site</div>


    </body>
</html>
