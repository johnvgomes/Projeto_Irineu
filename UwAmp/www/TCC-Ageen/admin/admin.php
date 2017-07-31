<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Carregando Acesso Administrativo...';
    session_destroy();
    //Limpa
    unset($_SESSION['sessao']);
   // Redireciona para a página de autenticação
echo "<script language='javaScript'>window.location.href='index.php'</script>";
}
include_once '../class/Conectar.php';
        //instancia Conectar
        $con = new Conectar();
        
 $user_admin= $_SESSION["usuario_admin"];
        $pegaUser = $con->prepare(" SELECT * from login_admin WHERE user = '$user_admin'");
        $pegaUser->execute(array($_SESSION['usuario_admin']));
	$dadosUser = $pegaUser->fetch();
        
        

 if('admin'!=($dadosUser['nivel'])) {
    echo 'Sem acesso...';
    session_destroy();
    //Limpa
    unset($_SESSION['usuario_admin']);
    //Redireciona para a página de autenticação
  echo "<script language='javaScript'>window.location.href='index.php'</script>";
}


?>

     
    <!DOCTYPE html>
    <html>
        <head>
            <?php include_once 'head.php'; ?>
        </head>
        <body>
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
    