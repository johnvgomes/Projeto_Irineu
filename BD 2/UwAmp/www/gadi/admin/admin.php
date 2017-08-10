<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
    <!DOCTYPE HTML>
    <html lang="pt-br">
        <head>

            <?php
            include_once 'head.php';
            ?>
        </head>

        <body>
            <div id="container">
                <header>      
                    <img src="../imagem/logo.fw.png" width="150px" />
                </header>

                <div id='cssmenu'>
                    <ul>
                        <li><a href='?p=home'><span>Home</span></a></li>
                        <li class='has-sub'><a href='#'><span>Cadastro</span></a>
                            <ul>
                                <li class='has-sub'><a href='#'><span>Categoria</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=categoria/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Produto</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=produto/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Usuário</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=login/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                            
                        </li>
                    </ul>
                    
                    <li class='has-sub'><a href='#'><span>Consulta</span></a>
                        <ul>
                            <li class='has-sub'><a href='#'><span>Produto</span></a>
                                <ul>
                                    <li class='last'><a href='?p=produto/consultar'><span>Consultar</span></a></li>

                                </ul>
                            </li>



                        </ul>
                    </li>

                    <li class='has-sub'><a href='#'><span>Sair</span></a>
                        <ul>

                            <li><a href='?p=logout'><span>Efetuar</span></a></li>
                        </ul>
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

            <script src="../js/lightbox/js/jquery-1.10.2.min.js"></script>
            <script src="../js/lightbox/js/lightbox-2.6.min.js"></script>

            <script>
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-2196019-1']);
                _gaq.push(['_trackPageview']);

                (function () {
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