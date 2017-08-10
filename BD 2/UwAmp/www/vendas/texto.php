<?php
include_once 'class/Textos.php';
require_once 'class/Controles.php';

$t = new Textos();
$co = new Controles();

$id = (int) $co->limparTexto($url->getURL(1));

$vetor = $t->carregar($id);

if (!empty($vetor)) {
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>
    <nav id="txtNav">
        <ul><?php $pag->menuTxt(); ?></ul>
    </nav>

    <section id="txtBox">
        <!--<div id="txtTitle">
            <?php echo utf8_encode($vetor[1]); ?>
        </div>-->

        <div id="txtContent">
            <?php echo utf8_encode($vetor[2]); ?>
        </div>
    </section>
    <?php
} else {
    echo "404";
}
?>