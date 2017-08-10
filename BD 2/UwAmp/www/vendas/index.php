<?php
session_start();

include_once "class/Url.php";
$url = new Url();
include_once "class/Paginar.php";
$pag = new Paginar();

//define("BASEURL", "http://localhost/vendas/");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="Artigos eletrônicos de qualidade, preço baixo e rápida entrega é no BuyOn!" />
        <meta name="keywords" content="e-commerce, eletrônicos, informática" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>BuyOn - Compras online é no BuyOn</title>

        <link rel="shortcut icon" href="<?php echo $url->getBase(); ?>img/client.ico" />
        <link href="<?php echo $url->getBase(); ?>css/estilo.css" rel="stylesheet" type="text/css" />

        <script language="javascript" type="text/javascript" src="<?php echo $url->getBase(); ?>js/interatividade.js"></script>

        <link href="<?php echo $url->getBase(); ?>css/cssmenu/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url->getBase(); ?>js/jquery/banner/engine1/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url->getBase(); ?>js/jquery/owl-carousel/owl.carousel.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url->getBase(); ?>js/jquery/owl-carousel/owl.theme.css" />
        <link rel="stylesheet" href="<?php echo $url->getBase(); ?>js/jquery/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />

        <script src='<?php echo $url->getBase(); ?>js/jquery/jquery-1.11.0.min.js' charset='utf-8'></script>
        <script language="javascript" type="text/javascript" src="<?php echo $url->getBase(); ?>js/jquery/js_menu.js"></script>
        <script type="text/javascript" src="<?php echo $url->getBase(); ?>js/jquery/banner/engine1/jquery.js"></script>
        <script src="<?php echo $url->getBase(); ?>js/jquery/owl-carousel/owl.carousel.js"></script>
        <script src="<?php echo $url->getBase(); ?>js/jquery/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="<?php echo $url->getBase(); ?>js/jquery/cycle2/jquery.cycle2.min.js"></script>
        <script src="<?php echo $url->getBase(); ?>js/jquery/cycle2/jquery.cycle2.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo $url->getBase(); ?>js/jquery/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script src="<?php echo $url->getBase(); ?>js/jquery/jquery.maskedinput.js" charset='utf-8'></script>
    </head>

    <body>
        <header id="header">
            <div id="topo">
                <a href="<?php echo $url->getBase(); ?>home">
                    <div id="logo" title="Logo - BuyOn"></div>
                </a>

                <div id="pesquisar">
                    <form id="formBuscar" action="" method="post">
                        <input type="search" name="srcBusca" id="srcBusca" alt="Buscar" placeholder="Buscar" />
                        <input type="submit" name="btnBuscar" id="btnBuscar" value="" />
                    </form>

                    <?php
                    if (isset($_POST['btnBuscar']) && !empty($_POST['srcBusca'])) {
                        header('Location: ' . $url->getBase() . 'pesquisa/' . $_POST['srcBusca']);
                        echo '<meta http-equiv="refresh" content="1;URL=' . $url->getBase() . 'pesquisa/' . $_POST['srcBusca'] . '">';
                    }
                    ?>
                </div>

                <div id="helloText">
                    <?php
                    if (isset($_SESSION['clienteNome'])) {
                        echo "Olá, " . $_SESSION['clienteNome'];
                    }
                    ?>
                </div>

                <div id="contBtns">
                    <?php if (isset($_SESSION['cliente'])) { ?>
                        <a id="minhaConta" href="<?php echo $url->getBase(); ?>minhaconta">
                            <div class="btn">
                                <div class="btnImagem"><img src="<?php echo $url->getBase(); ?>img/pessoal.png" width="40" height="40" title="Minha conta" alt="Minha conta" /></div>
                                <p>Minha conta</p>
                            </div>
                        </a>
                    <?php } else { ?>
                        <a id="entrar" href="#Entrar">
                            <div class="btn">
                                <div class="btnImagem"><img src="<?php echo $url->getBase(); ?>img/login.png" width="40" height="40" title="Login" alt="Login" /></div>
                                <p>Entrar</p>
                            </div>
                        </a>
                    <?php } ?>

                    <a id="carrinho" href="<?php echo $url->getBase(); ?>carrinho">
                        <div class="btn">
                            <div id="countCarrinho">
                                <?php
                                if (isset($_SESSION['carrinho'])) {
                                    echo count($_SESSION['carrinho']);
                                } else {
                                    echo "0";
                                }
                                ?>
                            </div>
                            <div class="btnImagem"><img src="<?php echo $url->getBase(); ?>img/carrinho.png" width="50" height="40" title="Carrinho" alt="Carrinho" /></div>
                            <p>Carrinho</p>
                        </div>
                    </a>

                    <?php if (isset($_SESSION['cliente'])) { ?>
                        <a id="sair" href="<?php echo $url->getBase(); ?>logout">
                            <div class="btn">
                                <div class="btnImagem"><img src="<?php echo $url->getBase(); ?>img/logout.png" width="40" height="40" title="Logout" alt="Logout" /></div>
                                <p>Sair</p>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </header>

        <div id="contMenu">
            <div id="menu">
                <div id='cssmenu'>
                    <ul>
                        <li class='active'><a href="<?php echo $url->getBase(); ?>home"><span>Home</span></a></li>
                        <?php $pag->menuCatego(); ?>
                    </ul>
                </div>
            </div>
        </div>

        <section id="container">
            <?php
            $modulo = $url->getURL(0);

            if ($modulo == null)
                $modulo = "home";

            if (file_exists($modulo . ".php")) {
                include_once $modulo . ".php";
            } else {
                include_once "home.php";
                echo '<meta http-equiv="refresh" 
            content="1;URL=' . $url->getBase() . 'home" />';
            }
            ?>
        </section>

        <footer id="contRodape">
            <div id="faixaRodape"></div>
            <div class="rodape">
                <div id="textos">
                    <ul><?php $pag->menuTxt(); ?></ul>
                </div>

                <div id="missao">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <div id="social">
                        <h3>Nos siga nas redes sociais:</h3>
                        <div class="sociais">
                            <a href="https://twitter.com/"><img src="<?php echo $url->getBase(); ?>img/icon/twitter.png" width="30" height="30" alt="Twitter icon" title="Twitter" /></a>
                        </div>
                        <div class="sociais">
                            <a href="http://instagram.com/"><img src="<?php echo $url->getBase(); ?>img/icon/instagram.png" width="30" height="30" alt="Instagram icon" title="Instagram" /></a>
                        </div>
                        <div class="sociais">
                            <a href="https://foursquare.com/"><img src="<?php echo $url->getBase(); ?>img/icon/foursquare.png" width="30" height="30" alt="Foursquare icon" title="Foursquare" /></a>
                        </div>
                        <div class="sociais">
                            <a href="https://plus.google.com/"><img src="<?php echo $url->getBase(); ?>img/icon/gplus.png" width="30" height="30" alt="Google+ icon" title="Google+" /></a>
                        </div>
                        <div class="sociais">
                            <a href="http://www.youtube.com/"><img src="<?php echo $url->getBase(); ?>img/icon/youtube.png" width="30" height="30" alt="Youtube icon" title="Youtube" /></a>
                        </div>
                        <div class="sociais">
                            <a href="https://www.facebook.com/"><img src="<?php echo $url->getBase(); ?>img/icon/facebook.png" width="30" height="30" alt="Facebook icon" title="Facebook" /></a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="faixaPgt">
                <div id="formasPgt">
                    <h3>Formas de Pagamento</h3>
                    <div class="formas">
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/boleto.gif" alt="Boleto" title="Boleto bancário" />
                    </div>
                    <div class="formas">
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/deposito.gif" alt="Depósito" title="Depósito"  />
                    </div>
                    <div class="formas">
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/visa.gif" alt="Visa" title="Visa" />
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/master.gif" alt="MasterCard" title="MasterCard" />
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/amex.gif" alt="American Expresss" title="American Express" />
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/hipercard.gif" alt="Hipercard" title="Hipercard" />
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/aura.gif" alt="Aura" title="Aura" />
                    </div>
                    <div class="formas">
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/bbrasil.gif" alt="Banco do Brasil" title="Banco do Brasil" />
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/itau.gif" alt="Itaú" title="Itaú" />
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/bradesco.gif" alt="Bradesco" title="Bradesco" />
                    </div>
                    <div class="formas">
                        <img src="<?php echo $url->getBase(); ?>img/tipospagamento/pp.gif" alt="PayPal" title="PayPal" />
                    </div>
                </div>
            </div>

            <div class="rodape">
                <div id="telefones">
                    <p>
                        São Paulo: 4024-5695 | Blumenau: 4024-5695 | Salto: 4024-5695 | Porto Feliz: 4024-5695 | Sorocaba: 4024-5695
                    </p>
                </div>
                <div id="endereco">
                    <p>
                        Rua Blumenau, nº 5040 | Centro | Santa Catarina - buyon-commerce@outlook.com
                    </p>
                </div>
            </div>
        </footer>

        <div id="loginBox">
            <div id="Entrar">
                <div id="logoFancy"></div>

                <div class="formFancy">
                    <h1>Faça seu login</h1>
                    <form method="post" action="" name="frmLogin">
                        <div id="formLogin">
                            <label>E-mail</label>
                            <input type="email" name="emailCli" id="loginEmail" placeholder="name@example.com" required />
                            <label class="marginInput">Senha</label>
                            <input type="password" name="senhaCli" id="loginSenha" required />
                        </div>

                        <input type="button" name="sbmLoginCli" id="loginSbm" value="Entrar" onclick="login();" />
                        <div id="esqueci">
                            <a href="<?php echo $url->getBase(); ?>recuperarSenha">Esqueci minha senha!</a>
                        </div>
                    </form>
                </div>

                <div id="divisor"></div>

                <div class="formFancy">
                    <h1>ou Cadastre-se</h1>
                    <form method="post" action="<?php echo $url->getBase(); ?>cadastrar" name="frmNovoCad">
                        <div id="formNovoCad">
                            <label>Digite seu nome:</label>
                            <input type="text" name="nomeNovoCad" placeholder="Fulano de Tal" required />
                            <label class="marginInput">E seu e-mail:</label>
                            <input type="email" name="emailNovoCad" placeholder="name@example.com" required />
                        </div>

                        <input id="sbmNovoCad" type="submit" name="sbmNovoCad" value="Continuar cadastro..." />
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#entrar").fancybox({
                    'titlePosition': 'inside',
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'centerOnScroll': 'true',
                    'padding': '0',
                    'opacity': 'true',
                    'overlayOpacity': '0.75',
                    'overlayColor': '#000',
                    'scrolling': 'no',
                    'speedIn': '100',
                    'speedOut': '100',
                    'easingIn': 'swing',
                    'autoScale': 'true',
                    'autoDimensions': 'true'
                });
            });
        </script>

    </body>
</html>