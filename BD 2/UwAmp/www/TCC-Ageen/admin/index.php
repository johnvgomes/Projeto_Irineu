<?php
include_once '../class/Url.php';
?>
<html>
    <head>
        <?php include_once 'head.php'; ?>
    </head>

<link href="../css/login_admin.css" type="text/css" rel="stylesheet">
<div class="geral">
    <div class="content">
        <form name="formlogin" method="post" action="">
            <table width="200" border="0" align="center" cellpadding="1" cellspacing="1">


                <h3 class="starti_texto">Acesso Administrativo</h3>
                <div id="imagem_user">

                    <!--
                    <img src="imagem/blue-user-icon.png">
                    -->
                </div>
                <h3 class="starti_texto">Entrar</h3>


                <!--
                         <label class="labels">E-mail: </label>
                -->

                <!--
                 
                <input type="search" id="parametro" name="parametro" placeholder="Pesquisar" title="Pesquise por: Animes, episódios, filmes e ovas" value="" style="width:100%; height:45px; float:left; padding-left:10px;"/>
                -->
                <input placeholder="Usuario" name="user" type="text" id="user" title="Insira seu nome de usuario aqui" 
                       value="" size="40" maxlength="100">

                <!--
                     <label class="labels">Senha: </label>
                -->
                <input placeholder="Senha" name="senha" type="password" id="senha" title="Insira sua senha aqui"
                       value="" size="40" maxlength="20">

                <input name="enviar" type="submit" id="Enviar" value="Logar">


               
        </form> 

    </div>

</div>


<?php
if (isset($_POST['enviar'])) {
    try {
        
        
        //inicia sessão no S.O.
        @session_start();
        //inclue a classe Conectar
        include_once '../class/Conectar.php';
        //instancia Conectar
        $con = new Conectar();
        // Preparando statement
        $stmt = $con->prepare("SELECT * from login_admin WHERE user=? AND senha=?");
        $stmt->bindParam(1, $_POST['user'], PDO::PARAM_STR);
        @$stmt->bindParam(2, sha1($_POST['senha']), PDO::PARAM_STR); 
                $stmt->execute();
        
        //obter número de registros retornados
        $num = $stmt->rowCount();

        if ($num > 0) {
            //guarda o numero da sessão
            $_SESSION['sessao'] = sha1(time());
            $_SESSION['usuario_admin'] = $_POST['user'];
			
            //acessa a página adm.php
            $url = new Url();
            //header("Location:" . $url->getBase() . "index"); 
            
              

             
             
            echo "<script language='javaScript'>window.location.href='admin.php'</script>";
        
        }else {

            echo ' <div id="imagem_user_red">'
            .'</div>'
            . ' <div id="login_incorreto">'
            . '<h3 class="login_incorreto">Login incorreto!</h3>'
            . '<h3 class="login_incorreto_verifique">Por favor verifique o campo email ou senha e tente novamente</h3>'
            . '</div>';
        }
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}
?> 
    </body>
</html>