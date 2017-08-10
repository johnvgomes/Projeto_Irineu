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
        <a href="<?php echo $url->getBase(); ?>minhaconta"><div id="minhaContaLink" class="imgLink offLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>pedidos"><div id="meusPedidosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>favoritos"><div id="favoritosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>historico"><div id="historicoLink" class="imgLink"></div></a>
        <hr />
    </div>

    <div id='hHistorico'><div></div><h1>Histórico</h1></div>

    <div id='exibirHistorico'>
        <?php
        if (isset($_SESSION['historico'])) {
            $p->exibirHistorico(array_reverse($_SESSION['historico']));
        } else {
            echo "<div id='semHistorico'>Não há nenhum registro no histórico! <br />"
            . "Dê uma volta pelo BuyOn e volte aqui de novo.</div>";
        }
        ?>
    </div>

    <?php
} else {
    include_once 'home.php';
    echo '<meta http-equiv="refresh" 
            content="1;URL=' . $url->getBase() . 'home" />';
}
?>