<?php
if (isset($_SESSION['carrinho'])) {

    include_once 'class/Carrinho.php';
    $ca = new Carrinho();
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <?php $ca->listarCarrinho(); ?>

    <?php
} else {
    echo "<div id='semCarrinho'>Não há nada no carrinho...<br /><br />"
    . "Clique em <button class='botoes'>Comprar</button> para comprar o produto diretamente ou<br />"
    . "clique em <button class='botoes'>Carrinho</button> para inseir o produto no carrinho!</div>";
}
?>