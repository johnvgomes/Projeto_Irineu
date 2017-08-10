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
                                <li class='has-sub'><a href='#'><span>Arquivo</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=arquivo/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Banner</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=banner/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Calendário</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=calendario/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Curso</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=curso/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Foto(s)</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=foto/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Eixo Tecnológico</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=eixo/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                
                                <li class='has-sub'><a href='#'><span>Noticia</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=noticia/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Página</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=pagina/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Unidade</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=unidade/cadastrar'><span>Efetuar Cadastro</span></a></li>
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
                                <li class='has-sub'><a href='#'><span>Vídeo</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=video/editar'><span>Efetuar Alteração</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class='has-sub'><a href='#'><span>Consulta</span></a>
                            <ul>
                                <li class='has-sub'><a href='#'><span>Arquivo</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=arquivo/consultar'><span>Consultar</span></a></li>

                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Calendário</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=calendario/consultar'><span>Consultar</span></a></li>

                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Curso</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=curso/consultar'><span>Consultar</span></a></li>

                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Página</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=pagina/consultar'><span>Consultar</span></a></li>

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