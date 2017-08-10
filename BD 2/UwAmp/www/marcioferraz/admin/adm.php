<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
    <!DOCTYPE HTML>
    <html lang="pt-br">
        <head>

            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="keywords" content="Informatica, Informatica para Internet, WEB, Administracao, Escola Tecnica, Itu, Sao Paulo, Brasil, Web Sites, Softwares, Programação" />
            <meta name="description" content="Site da Marcio Ferraz - softwares e sites sob medida" />
            <title>Marcio Ferraz</title>

            <link rel="shortcut icon" href="imagem/icone.fw.png" />		

            <script src="js/lightbox/js/modernizr.custom.js"></script>

            <link href="css/estilo.css" type="text/css" rel="stylesheet" />


            <link rel="stylesheet" href="js/lightbox/css/lightbox.css" media="screen"/>

            <link rel='stylesheet' type='text/css' href='css/styles.css' />
            <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>

            <script type="text/javascript" src="editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
            <script type="text/javascript">
                tinyMCE.init({
                    // General options
                    mode: "textareas",
                    theme: "simple",
                    plugins: "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
                    // Theme options
                    theme_advanced_buttons1: "newdocument,styleselect,formatselect,fontselect,fontsizeselect ,bold,italic,underline,strikethrough",
                    theme_advanced_buttons2: "bullist,numlist,|,undo,redo,|,charmap,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,code,styleprops,|,media,image,advhr,|,fullscreen",
                    theme_advanced_buttons3: "",
                    theme_advanced_toolbar_location: "top",
                    theme_advanced_toolbar_align: "left",
                    theme_advanced_statusbar_location: "bottom",
                    theme_advanced_resizing: true,
                    // Example content CSS (should be your site CSS)
                    content_css: "css/content.css",
                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url: "lists/template_list.js",
                    external_link_list_url: "lists/link_list.js",
                    external_image_list_url: "lists/image_list.js",
                    media_external_list_url: "lists/media_list.js",
                    // Style formats
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ],
                    // Replace values for the template plugin
                    template_replace_values: {
                        username: "Some User",
                        staffid: "991234"
                    }
                });
            </script>
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
                                <li class='has-sub'><a href='#'><span>Pagina</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=pagina/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>

                                <li class='has-sub'><a href='#'><span>Usuário</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=login/cadastrar'><span>Efetuar Cadastro</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class='has-sub'><a href='#'><span>Consulta</span></a>
                            <ul>
                                <li class='has-sub'><a href='#'><span>Pagina</span></a>
                                    <ul>
                                        <li class='last'><a href='?p=pagina/consultar'><span>Consultar</span></a></li>
                                        <li class='last'><a href='pagina/pdf.php' target="_blank"><span>PDF</span></a></li>
                                        
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Moto</span></a>
                                    <ul>
                                        <li><a href='?p=moto/consultar'><span>Consultar</span></a></li>
                                        <li><a href='?p=moto/pesquisarLike'><span>Pesquisar LIKE</span></a></li>
                                        <li><a href='?p=moto/pesquisarBetween'><span>Pesquisar Between</span></a></li>
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'><span>Noticia</span></a>
                                    <ul>
                                        <li><a href='?p=noticia/consultar'><span>Consultar</span></a></li>
                                        <li><a href='?p=noticia/pesquisarData'><span>Pesquisar por Data</span></a></li>
                                        <li><a href='?p=noticia1/consultar'><span>Consultar teste</span></a></li>
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

                <footer>
                    <div id="rodape">
                        <h3>Rodape</h3>
                    </div>
                </footer>

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