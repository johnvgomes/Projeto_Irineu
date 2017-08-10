<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Textos.php';

    $t = new Textos();
    ?>

    <h1 id="infoTitle">Exibir textos</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por t&iacute;tulo:</label>
            <input id="txtSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="txtOrder">
                <option value="t.id" selected>ID</option>
                <option value="t.titulo">T&iacute;tulo</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>T&iacute;tulo</td>
                <td>[exibir]</td>
                <td>[editar]</td>
                <td>[excluir]</td>
            </tr>
        </thead>
        <?php $t->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="txtBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="txtAfter" class="after<?php
        if ($t->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="txtListing" class="listing">
        <input id="txtNumber" class="numero" type="number" value="1" min="1" max="<?php echo $t->quantPg(); ?>" />
        de <label id="txtMaximo" class="maximo"><?php echo $t->quantPg(); ?></label>
    </div>
    <?php
}
?>