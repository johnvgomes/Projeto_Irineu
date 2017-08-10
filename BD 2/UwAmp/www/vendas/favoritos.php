<?php
if (isset($_SESSION['cliente'])) {

    include_once 'class/Produtos.php';
    include_once 'class/Controles.php';

    $p = new Produtos();
    $co = new Controles();

    $id = (int) $co->limparTexto($_SESSION['clienteId']);
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <div id="minhaContaNav">
        <a href="<?php echo URL::getBase(); ?>minhaconta"><div id="minhaContaLink" class="imgLink offLink"></div></a>
        <a href="<?php echo URL::getBase(); ?>pedidos"><div id="meusPedidosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo URL::getBase(); ?>favoritos"><div id="favoritosLink" class="imgLink"></div></a>
        <a href="<?php echo URL::getBase(); ?>historico"><div id="historicoLink" class="imgLink offLink"></div></a>
        <hr />
    </div>

    <div id='hFavoritos'><div></div><h1>Favoritos</h1></div>

    <div id='exibirFavoritos'>
        <?php $p->exibirFavoritos($id); ?>
    </div>

    <?php
} else {
    include_once 'home.php';
    echo '<meta http-equiv="refresh" 
            content="1;URL=' . URL::getBase() . 'home" />';
}
?>