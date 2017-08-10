<?php
if (isset($_SESSION['cliente'])) {

    include_once 'class/Clientes.php';
    include_once 'class/Controles.php';

    $cl = new Clientes();
    $co = new Controles();

    $id = (int) $co->limparTexto($_SESSION['clienteId']);
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <div id="minhaContaNav">
        <a href="<?php echo $url->getBase(); ?>minhaconta"><div id="minhaContaLink" class="imgLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>pedidos"><div id="meusPedidosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>favoritos"><div id="favoritosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>historico"><div id="historicoLink" class="imgLink offLink"></div></a>
        <hr />
    </div>

    <div id="meusDados">
        <div id='hMinhaConta'><div></div><h1>Minha conta</h1></div>
        <div id="topBtns">
            <a href="<?php echo $url->getBase(); ?>editar"><button type="button" class="linkBtn">Editar dados</button></a>
        </div>
        <?php $cl->minhaConta($id); ?>
    </div>

    <div id="bottomBtns">
        <a href="<?php echo $url->getBase(); ?>trocarSenha"><button type="button" class="linkBtn">Trocar senha</button></a>
        <a href="<?php echo $url->getBase(); ?>excluir"><button type="button" class="linkBtn">Excluir conta</button></a>
    </div>

    <?php
} else {
    include_once 'home.php';
    echo '<meta http-equiv="refresh" 
            content="1;URL=' . $url->getBase() . 'home" />';
}
?>