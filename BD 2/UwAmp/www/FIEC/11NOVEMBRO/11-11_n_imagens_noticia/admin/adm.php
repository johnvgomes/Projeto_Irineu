<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
} else {
    ?>


    <!DOCTYPE HTML>
    <html lang="pt-br">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="keywords" content="ETEC Itu, Informatica, Informatica para Internet, WEB, Administracao, Meio Ambiente, Paisagismo, Hospedagem, Agenciamento de Viagem, Turismo, Escola Tecnica, Logistica, Integrado, Ensino Medio, Itu, Sao Paulo, Brasil, gratuito" />
            <meta name="description" content="Site da ETEC Itu - cursos tecnicos gratuitos" />
            <title>FIEC - Aulas de PHP</title>

            <link rel="shortcut icon" href="../imagem/etec.ico" />		

            <link href="../css/estilo.css" type="text/css" rel="stylesheet" />

            <link rel='stylesheet' type='text/css' href='../css/styles.css' />
            <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>

            <!--light box inicio-->
            <script type="text/javascript" src="../js/prototype.js"></script>
            <script type="text/javascript" src="../js/scriptaculous.js?load=effects,builder"></script>
            <script type="text/javascript" src="../js/lightbox.js"></script>
            <link rel="stylesheet" href="../css/lightbox.css" type="text/css" media="screen" />
            <!--light box fim-->
        </head>

        <body>
            <div id="container">
                <header>      
                    <img src="../imagem/logo.gif" />
                </header>

                <div id='cssmenu'>
                    <ul>
                        <li><a href='?p=home'><span>Home</span></a></li>
                        <li class='has-sub'><a href='#'><span>Cadastro</span></a>
                            <ul>
                                <li class='has-sub'><a href='#'><span>Marca</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=marca/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Moto</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=moto/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Noticia</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=noticia/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Usuário</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=login/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>TCC</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=tcc/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class='has-sub'><a href='#'><span>Consulta</span></a>
                            <ul>
                                <li class='has-sub'><a href='#'><span>Marca</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=marca/consultar'><span>Consultar</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Moto</span></a>
                                    <ul>
                                        <li><a href='?p=moto/consultar'><span>Consultar</span></a></li>
                                        <li><a href='?p=moto/consultarValor'><span>Consultar por Valor</span></a></li>
                                        <li><a href='?p=moto/pesquisar'><span>Pesquisar</span></a></li>
                                        <li><a href='?p=moto/ultimoId'><span>Último ID</span></a></li>
                                        <li class='last'><a href='?p=moto/mostrar'><span>Por marca</span></a></li>
                                        <li><a href='?p=moto/paginar'><span>Paginar</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Noticia</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=noticia/consultar'><span>Consultar</span></a></li>
                                        <li class='last'><a href='pagina/pdf.php' target="_blank"><span>PDF</span></a></li>

                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>TCC</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=tcc/consultar'><span>Consultar</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li><a href='?p=logout'><span>Logout</span></a></li>
                        <li class='last'><a href='#'><span>Fale Conosco</span></a></li>
                    </ul>
                </div>

                <article id="conteudo">

                    <?php
                    @$p = $_GET['p'];
                    if ($p == "" || $p == "index" || $p == "index.php") {
                        @include_once 'home.php';
                    } else {
                        @include_once $p . '.php';
                    }
                    ?>

                </article>



            </div>
            <script>
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-2196019-1']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();
            </script>
        </body>
    </html>
    <?php
}
?>