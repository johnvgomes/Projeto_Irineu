<?php
//@session_start();
//if (!isset($_SESSION['sessao'])) {
  //  echo 'Sem acesso!';
//} else {
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <?php include_once 'head.php'; ?>
        </head>
        <body>
             <?php include_once 'menulateral.php'; ?>  
            
            <nav>
                <?php include_once 'nav.php'; ?>            
            </nav>
            <div class="geral">
                <div class="content">
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

                    if ($p != "") {
                        include_once $p . ".php";
                    } else {
                        include_once 'pagina-inicial.php';
                    }
                    ?>
                </div>
            </div>
        </body>
    </html>
    <?php
//}
?>