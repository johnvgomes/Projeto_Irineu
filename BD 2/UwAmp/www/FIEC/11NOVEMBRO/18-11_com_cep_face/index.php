<?php
include_once "class/Url.php";
$url = new Url();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <?php include_once 'head.php'; ?>
    </head>
    <body>

        <?php //include_once 'menuTeste.php'; ?>
        <?php //require_once('loaderscreen.php'); ?>
        <div class="barranav">
            <?php include_once 'barranav.php'; ?>
        </div>



        <section class="container">


            <nav>
                <!--
                <label>
                    <select>     
                        <option selected>&#9776; Conheça nossos cursos aqui</option>
                        <option>Administração</option>
                        <option>Agenciamento de Viagem</option>
                        <option>Design de Interiores</option>
                        <option>Hospedagem</option>
                        <option>Informática</option>
                        <option>Informática para Internet</option>
                        <option>Logística</option>
                        <option>Meio Ambiente</option>
                        <option>Paisagismo</option>
                        <option>Secretariado</option>
                    </select>
                </label>
                -->
                <!--
                <ul>
                    
                    <li><a href="<?php //echo $url->getBase();       ?>administracao" title="Administração" ><img src="<?php //echo $url->getBase();       ?>imagem/adm.png" alt="Administração" /></a> </li>
                    <li><a href="<?php //echo $url->getBase();       ?>agenciamento-de-viagem" title="Agenciamento de Viagem / Turismo Receptivo" ><img src="<?php echo $url->getBase(); ?>imagem/turismo.png" alt="Agenciamento de Viagem / Turismo Receptivo" /></a> </li>
                    <li><a href="<?php //echo $url->getBase();       ?>design-de-interiores" title="Design de Interiores" ><img src="<?php //echo $url->getBase();       ?>imagem/design.png" alt="Design de Interiores" /></a> </li>

                    <li><a href="<?php //echo $url->getBase();       ?>hospedagem" title="Hospedagem" ><img src="<?php //echo $url->getBase();       ?>imagem/hosp.png" alt="Hospedagem" /></a> </li>

                    <li><a href="<?php //echo $url->getBase();       ?>informatica" title="Informática" ><img src="<?php //echo $url->getBase();       ?>imagem/info.png" alt="Informática" /></a> </li>
                    <li><a href="<?php //echo $url->getBase();       ?>informatica-para-internet" title="Informática para Internet" ><img src="<?php //echo $url->getBase();       ?>imagem/infonet.png" alt="Informática para Internet" /></a> </li>
                    <li><a href="<?php //echo $url->getBase();       ?>logistica" title="Logística" ><img src="<?php //echo $url->getBase();       ?>imagem/logistica.png" alt="Logística" /></a> </li>
                    <li><a href="<?php //echo $url->getBase();       ?>meio-ambiente" title="Meio Ambiente" ><img src="<?php //echo $url->getBase();       ?>imagem/mamb.png" alt="Meio Ambiente" /></a> </li>
                    <li><a href="<?php //echo $url->getBase();       ?>paisagismo" title="Paisagismo" ><img src="<?php //echo $url->getBase();       ?>imagem/paisagismo.png" alt="Paisagismo" /></a> </li>
                    <li><a href="<?php //echo $url->getBase();       ?>secretariado" title="Secretariado" ><img src="<?php //echo $url->getBase();       ?>imagem/secretariado.png" alt="Secretariado" /></a> </li>
                <!--
                <li><a href="<?php //echo $url->getBase();      ?>cursos" title="Cursos Etec itu" ><img src="imagem/cursos.png" alt="Cursos Etec" /></a> </li>
                -->
                </ul>
            </nav>    

            <header>
                <a href="<?php echo $url->getBase(); ?>home" title="Etec Itu"><img src="<?php echo $url->getBase(); ?>imagem/logo.fw.png" class="logo"></a>
            </header>

            <section class="content">
                <article>
                    <?php
                    $modulo = $url->getURL(0);

                    if ($modulo == null)
                        $modulo = "home";


                    if (file_exists($modulo . ".php"))
                        include_once
                                $modulo . ".php";
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
                    <?php include_once 'rodape.php'; ?>
                </div>

            </article>
        </footer>

        <script src="<?php echo $url->getBase(); ?>js/pushy.min.js"></script>
    </body>
</html>
