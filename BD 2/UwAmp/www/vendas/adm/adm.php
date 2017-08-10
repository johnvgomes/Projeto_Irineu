<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>
    <!DOCTYPE HTML>
    <html lang="pt-br">
        <head>            
            <title>BuyOn - &Aacute;rea Administrativa</title>

            <link rel="shortcut icon" href="../img/adm.ico" />		
            <link rel='stylesheet' type='text/css' href='../css/adm.css' />

            <link rel='stylesheet' type='text/css' href='../js/jquery/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css' />
            <link rel='stylesheet' type='text/css' href='../js/jquery/lightbox/css/lightbox.css' />

            <script src='../js/adm.js'></script>
            <script src='../js/paginar.js'></script>
            <script src='../js/produtos.js'></script>

            <script src='../js/jquery/jquery-1.11.0.min.js' charset='utf-8'></script>
            <script src='../js/jquery/lightbox/js/lightbox.min.js' charset='utf-8'></script>
            <script src='../js/jquery/jquery.price_format.2.0.min.js' charset='utf-8'></script>
            <script src='../js/jquery/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js' charset='utf-8'></script>
        </head>

        <body>
            <header id="header">
                <a href="?p=">
                    <div id="logoAdm" title="Logo - Administrativo BuyOn"></div>
                </a>
                <div id="logout">
                    <a href='?p=logout'><img src="../img/logoff.png" width="50" height="50" /></a>
                </div>
            </header>
            <div id="container">

                <menu id="menu">
                    <ul>
                        <li class='mButton'>
                            <?php
                            if ($_SESSION['lvl'] == 1) {
                                echo '<span class = "mSelect"><a href = "?p=admin/consultar">ADMIN</a></span>
                        <span class = "mAdd"><a href = "?p=admin/cadastrar">+</a></span>';
                            } else {
                                echo '<span class="mSelect mRestrict"><a href = "?p=admin/editar&id=' . $_SESSION['lvl'] . '">ADMIN</a></span>';
                            }
                            ?>

                        </li>
                    </ul>
                    <ul>
                        <li class='mButton'>
                            <span class="mSelect"><a href="?p=categorias/consultar">CATEGORIAS</a></span>
                            <span class="mAdd"><a href="?p=categorias/cadastrar">+</a></span>
                        </li>
                    </ul>
                    <ul>
                        <li class='mButton'>
                            <span class="mSelect mRestrict"><a href="?p=clientes/consultar">CLIENTES</a></span>
                        </li>
                    </ul>
                    <ul>
                        <li class='mButton'>
                            <span class="mSelect"><a href="?p=marcas/consultar">MARCAS</a></span>
                            <span class="mAdd"><a href="?p=marcas/cadastrar">+</a></span>
                        </li>
                    </ul>
                    <ul>
                        <li class='mButton'>
                            <span class="mSelect"><a href="?p=produtos/consultar">PRODUTOS</a></span>
                            <span class="mAdd"><a href="?p=produtos/cadastrar">+</a></span>
                        </li>
                    </ul>
                    <ul>
                        <li class='mButton'>
                            <span class="mSelect"><a href="?p=subcategorias/consultar">SUBCATEGORIAS</a></span>
                            <span class="mAdd"><a href="?p=subcategorias/cadastrar">+</a></span>
                        </li>
                    </ul>
                    <ul>
                        <li class='mButton'>
                            <span class="mSelect"><a href="?p=textos/consultar">TEXTOS</a></span>
                            <span class="mAdd"><a href="?p=textos/cadastrar">+</a></span>
                        </li>
                    </ul>
                    <ul>
                        <li class='mButton'>
                            <span class="mSelect"><a href="?p=tipospagamento/consultar">TIPOS DE PAGTO.</a></span>
                            <span class="mAdd"><a href="?p=tipospagamento/cadastrar">+</a></span>
                        </li>
                    </ul>
                    <ul>
                        <li class='mButton'>
                            <span class="mSelect mRestrict"><a href="?p=vendas/consultar">VENDAS</a></span>
                        </li>
                    </ul>
                </menu>

                <section id="section">
                    <div id="infoBox">
                        <?php
                        @$p = $_GET['p'];
                        if ($p == "" || $p == "index" || $p == "index.php") {
                            @include_once 'home.php';
                        } else {
                            @include_once $p . '.php';
                        }
                        ?>
                    </div>
                </section>
            </div>

            <footer id="footer">
                <div id="rodape">
                    <?php
                    @$p = $_GET['p'];
                    $crumb = preg_split('/\//', $p);

                    echo 'Home';

                    $i = 0;
                    while (@$crumb[$i]) {
                        echo ' &rsaquo; ' . $crumb[$i];
                        $i++;
                    }
                    ?>
                </div>
            </footer>
        </body>
    </html>
    <?php
}
?>