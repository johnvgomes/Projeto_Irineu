<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//comentário
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Aula 1 de PHP</title>
        <meta charset="UTF-8">
        <link href="css/estilo.css" type="text/css" 
              rel="stylesheet">
        <script language="JavaScript" 
                type="text/javascript" 
                src="js/MascaraValidacao.js">
        </script>
    </head>
    <body>
        <div>
            <a href="?p=pagina-inicial">home</a>
            <a href="?p=contato">contato</a>
            <a href="?p=formdepartamento">depto</a>
            
        </div>
        <div>
            <?php 
            /*
                $valor = "Nome<br>";
                echo $valor;
                
                $valor = 1.0;
                echo $valor."<br>";
                
                @$valor = date("d/m/Y");
                echo $valor;
             * 
             */
            @$p = $_GET['p'];
            
            if($p != ""){
                include_once $p.".php";
            }else{
                include_once 'pagina-inicial.php';
            }
            
            ?>
        </div>
    </body>
</html>
<?php

?>