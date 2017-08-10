<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Marcas.php';

    $m = new Marcas();
    ?>

    <h1 id="infoTitle">Exibir marcas</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por nome:</label>
            <input id="marSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="marOrder">
                <option value="m.id" selected>ID</option>
                <option value="m.nome">Nome</option>
                <option value="m.origem">Pa&iacute;s de Origem</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Pa&iacute;s de Origem</td>
                <td>[editar]</td>
                <td>[excluir]</td>
            </tr>
        </thead>
        <?php $m->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="marBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="marAfter" class="after<?php
        if ($m->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="marListing" class="listing">
        <input id="marNumber" class="numero" type="number" value="1" min="1" max="<?php echo $m->quantPg(); ?>" />
        de <label id="marMaximo" class="maximo"><?php echo $m->quantPg(); ?></label>
    </div>
    <?php
}
?>