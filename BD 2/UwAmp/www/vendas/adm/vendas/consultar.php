<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Vendas.php';

    $v = new Vendas();
    ?>

    <h1 id="infoTitle">Exibir vendas</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por data:</label>
            <input id="vendSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="vendOrder">
                <option value="v.id" selected>ID</option>
                <option value="v.total">Pre&ccedil;o total</option>
                <option value="v.data">Data</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Pre&ccedil;o total</td>
                <td>Frete</td>
                <td>Data</td>
                <td>Hora</td>
                <td>Obs.</td>
                <td>Status</td>
                <td>[detalhes]</td>
                <td>[itens]</td>
                <td>[excluir]</td>
            </tr>
        </thead>
        <?php $v->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="vendBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="vendAfter" class="after<?php
        if ($v->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="vendListing" class="listing">
        <input id="vendNumber" class="numero" type="number" value="1" min="1" max="<?php echo $v->quantPg(); ?>" />
        de <label id="vendMaximo" class="maximo"><?php echo $v->quantPg(); ?></label>
    </div>
    <?php
}
?>