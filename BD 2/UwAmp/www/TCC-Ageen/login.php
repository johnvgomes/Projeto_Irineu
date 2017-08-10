<?php
include_once 'class/Url.php';
$url = new Url();
?>

<html>
    <head>
        <?php include_once 'head.php'; ?>
    </head>

<link href="css/login.css" type="text/css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="js/scriptvideo.js">
</script>
<div class="geral">
    <div class="content">
        <form name="formlogin" method="post" action="">
            <table width="200" border="0" align="center" cellpadding="1" cellspacing="1">


                <h3 class="starti_texto">Check IT</h3>
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
                <input placeholder="E-mail" name="email" type="email" id="search-text" title="Insira seu E-mail aqui" 
                       value="" size="40" maxlength="100">

                <!--
                     <label class="labels">Senha: </label>
                -->
                <input placeholder="Senha" name="senha" type="password" id="senha" title="Insira sua senha aqui"
                       value="" size="40" maxlength="20">

                <input name="enviar" type="submit" id="Enviar" value="Logar">


                <div id="criar_conta">

                    <link href="Usuario/cadastrar.php"  />
                    <a href="Usuario/cadastrar.php"> <h2 class="criarconta_text">Criar uma conta</h2></a>



                </div>
        </form> 

    </div>

</div>


<div id="site">

    <div id="conteudo">
        <div id="topo">
            <!--
            <h1 class="cabeçalho_um">Corinthians</h1>
            -->
            <h1 class="cabecalho_um"> Ganhe tempo</h1>
           
        </div>
        <h1 class="conteudo">
            <video src="video/Checkit_video.mp4" id="theVideo" controls autoplay >
                This browser or mode doesn't support HTML5 video.
            </video>

        </h1>
    </div>

    <div id="rodape">
        <h2 class="format">
            <pre>Desenvolvido pelo StarTI
                                
            </pre></h2>
    </div>

</div>

<?php
if (isset($_POST['enviar'])) {
    try {
        
        
        //inicia sessão no S.O.
        @session_start();
        //inclue a classe Conectar
        include_once 'class/Conectar.php';
        //instancia Conectar
        $con = new Conectar();
        
        // Preparando statement
        $stmt = $con->prepare("SELECT * from usuario WHERE email=? AND senha=?");
        $stmt->bindParam(1, $_POST['email'], PDO::PARAM_STR);
        @$stmt->bindParam(2, sha1($_POST['senha']), PDO::PARAM_STR); 
                $stmt->execute();
        
        //obter número de registros retornados
        $num = $stmt->rowCount();

        if ($num > 0) {
            //guarda o numero da sessão
            $_SESSION['sessao'] = sha1(time());
            $_SESSION['usuario'] = $_POST['email'];
			
            //acessa a página adm.php
            $url = new Url();
            //header("Location:" . $url->getBase() . "index"); 
            
              
        $email_user= $_SESSION["usuario"];
        $pegaUser = $con->prepare(" SELECT * from usuario WHERE email = '$email_user'");
        $pegaUser->execute(array($_SESSION['usuario']));
	$dadosUser = $pegaUser->fetch();
            
        try{
                    
                    $dadosUser['acesso']=$dadosUser['acesso']+1;
                    
            $sql = "UPDATE usuario SET acesso = ? WHERE email = '$email_user'";
            $sqlprep = $con->prepare($sql);
            $sqlprep->bindParam(1, $dadosUser['acesso'], PDO::PARAM_INT);
            
            if ($sqlprep->execute() == 1) {
                echo "Acesso alterado efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao editar acesso do usuario "
            . $exc->getMessage();
        }
            if($dadosUser['acesso']==1)
            {
                
        
         echo "<script language='javaScript'>window.location.href='Perfil/editar.php'</script>";
  
        }
         if($dadosUser['acesso']!=1){
             
             
            echo "<script language='javaScript'>window.location.href='PaginaInicial/paginainicial.php'</script>";
        } 
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