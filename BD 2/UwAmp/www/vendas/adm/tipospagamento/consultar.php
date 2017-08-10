<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Tipospagamento.php';

    $tp = new Tipospagamento();
    ?>

    <h1 id="infoTitle">Exibir tipos de pagamento</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por nome:</label>
            <input id="tipSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="tipOrder">
                <option value="tp.id" selected>ID</option>
                <option value="tp.nome">Nome</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Descri&ccedil;&atilde;o</td>
                <td>[editar]</td>
                <td>[excluir]</td>
            </tr>
        </thead>
        <?php $tp->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="tipBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="tipAfter" class="after<?php
        if ($tp->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="tipListing" class="listing">
        <input id="tipNumber" class="numero" type="number" value="1" min="1" max="<?php echo $tp->quantPg(); ?>" />
        de <label id="tipMaximo" class="maximo"><?php echo $tp->quantPg(); ?></label>
    </div>
    <?php
}
?>