<?php
include_once "class/Url.php";
$url = new Url();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" /> 
        <title>Marcio Ferraz | Itu/SP</title>
        <link href="<?php echo $url->getBase(); ?>css/estilo.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo $url->getBase(); ?>css/box.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo $url->getBase(); ?>css/formatacao.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo $url->getBase(); ?>css/templatemo_style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $url->getBase(); ?>css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />

        <meta name="description" content="Marcio Ferraz - Desenvolvimento" />
        <meta name="keywords" content="HTML,CSS,Site,JavaScript,PHP,
              Itu,Desenvolvimento,XHTML,manutenção, cartão,panfleto,corel,
              fireworks" />
        <meta name="author" content="Marcio Ferraz" />
        <link rel="shortcut icon" href="<?php echo $url->getBase(); ?>imagem/icone.fw.png" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script type="text/javascript">
            $(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 300) {
                        $('.navegacao').fadeIn();
                    } else {
                        $('.navegacao').fadeOut();
                    }
                });
            });
        </script>    

    </head>
    <body>
        <section class="container">
            <header>
                <a href="<?php echo $url->getBase(); ?>home" title="Pagina Principal"><img src="imagem/logo.fw.png"></a>
            </header>
            <nav >
                <ul>

                    <li><a href="<?php echo $url->getBase(); ?>home" title="Pagina Principal" ><img src="imagem/home.png" alt="Página Inicial" /></a> </li>
                    <li><a href="<?php echo $url->getBase(); ?>sites-e-softwares" title="Desenvolvimento de Softwares e Sites" ><img src="imagem/desenvolvimento.png" alt="Desenvolvimento de sites e softwares" /></a> </li>
                    <li><a href="<?php echo $url->getBase(); ?>manutencao-em-computadores-notebooks" title="Manutenção em Computadores" ><img src="imagem/manutencao.png" alt="Manutenção em Computadores" /></a> </li>

                    <li><a href="<?php echo $url->getBase(); ?>aulas-particulares" title="Aulas Particulares" ><img src="imagem/aulas.png" alt="Aulas Particulares" /></a> </li>

                    <li><a href="<?php echo $url->getBase(); ?>cartoes-panfletos-cartazes-logos" title="Sobre o desenvolvedor" ><img src="imagem/sobre.png" alt="Sobre o desenvolvedor" /></a> </li>
                    <li><a href="<?php echo $url->getBase(); ?>contato" title="Fale Conosco" ><img src="imagem/contato.png" alt="Fale Conosco" /></a> </li>

                </ul>

            </nav>

            <section class="content">
                <article>




                    <?php
                    $modulo = $url->getURL(0);

                    if ($modulo == null)
                        $modulo = "home";

                    if (file_exists($modulo . ".php"))
                        include_once $modulo . ".php";
                    else {
                        include_once "class/Pagina.php";
                        $p = new Pagina();

                        $p->mostrar($modulo, $url->getBase());
                    }
                    ?>


                    <!--Fim do Box-->   
                </article>
            </section>

        </section>
        <footer>
            <article>
                <div class="rodape">
                    <div class="mapadosite1">
                        <img src ="imagem/logo2.fw.png" alt="mferraz desenvolvimento">
                        <p><strong>E-mail:</strong><br><span class="email">marcio.ferraz@etec.sp.gov.br</span></p>
                        <p><strong>Telefone:</strong><br>(11) 4025-4264 | (11) 96411-0175</p>
                        <p><strong>Endereço:</strong><br>Rua Tercio Paes Leite, 153 - Jd. Aeroporto - Itu/SP - CEP 13304-640</p>

                    </div>
                    <div class="mapadosite">
                        <h3>Mapa do Site</h3>
                        <ul>
                            <li><a href="<?php echo $url->getBase(); ?>home" title="Pagina Principal" >* Página Inicial</a> </li>
                            <li><a href="<?php echo $url->getBase(); ?>sites-e-softwares" title="Desenvolvimento de Softwares e Sites" >* Desenvolvimento de Sites e Softwares</a> </li>
                            <li><a href="<?php echo $url->getBase(); ?>manutencao-em-computadores-notebooks" title="Manutenção em Computadores" >* Manutenção em Computadores</a> </li>

                            <li><a href="<?php echo $url->getBase(); ?>aulas-particulares" title="Aulas Particulares" >* Aulas Particulares</a> </li>

                            <li><a href="<?php echo $url->getBase(); ?>cartoes-panfletos-cartazes-logos" title="Sobre o desenvolvedor" >* Sobre o desenvolvedor</a> </li>
                            <li><a href="<?php echo $url->getBase(); ?>contato" title="Fale Conosco" >* Fale Conosco</a> </li>

                        </ul>

                    </div>
                    <div class="mapadosite">
                        <h3>Redes Sociais</h3>
                        <ul>
                            <li><a href="https://www.facebook.com/profile.php?id=100007925864149&ref=tn_tnmn" target="_blank" title="facebook"><img src="imagem/face.fw.png" border="0"></a></li>

                            <li><a href="http://www.linkedin.com/profile/view?id=286039216&trk=nav_responsive_tab_profile" target="_blank" title="linkedin"><img src="imagem/link.fw.png" border="0"></a></li>
                        </ul><br><br>
                        <h3>Newsletter</h3>
                        <form name="formemail" id="formemail" method="post">
                            <input type="email" name="txtemail" id="txtemail"
                                   maxlength="70" size="20%"><br>
                            <input type="submit" name="btnemail" id="btnemail"
                                   value="Enviar">                            
                        </form>
                        <?php
                        if (isset($_POST['btnemail'])) {
                            extract($_POST, EXTR_OVERWRITE);
                            include_once 'class/Email.php';
                            $email = new Email();
                            $email->setEmail($txtemail);
                            $email->cadastrar();
                        }
                        ?>
                    </div>
                    <div class="mapadosite2">
                        <h3>Acesso fácil</h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3665.0083280093427!2d-47.2784516!3d-23.2791471!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cf455b5c6f1b73%3A0x121ce283b1a33fc7!2sR.+T%C3%A9rcio+Paes+Leite%2C+153+-+Jardim+Aeroporto+I%2C+Itu+-+SP%2C+Rep%C3%BAblica+Federativa+do+Brasil!5e0!3m2!1spt-BR!2s!4v1407846997778" width="220" height="200" frameborder="0" style="border:0"></iframe>
                    </div>



                    <div class="barrainferior">
                        COPYRIGHT 2014 - Todos os Direitos Reservados ao Professor Marcio Ferraz.
                    </div>
                </div>

            </article>
        </footer>
    </body>
</html>
