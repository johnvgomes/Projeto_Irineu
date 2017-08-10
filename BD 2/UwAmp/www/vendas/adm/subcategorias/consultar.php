<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Subcategorias.php';

    $s = new Subcategorias();
    ?>

    <h1 id="infoTitle">Exibir subcategorias</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por nome:</label>
            <input id="scatSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="scatOrder">
                <option value="s.id" selected>ID</option>
                <option value="s.nome">Nome</option>
                <option value="c.nome">Categoria-pai</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Categoria-pai</td>
                <td>[editar]</td>
                <td>[excluir]</td>
            </tr>
        </thead>
        <?php $s->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="scatBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="scatAfter" class="after<?php
        if ($s->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="scatListing" class="listing">
        <input id="scatNumber" class="numero" type="number" value="1" min="1" max="<?php echo $s->quantPg(); ?>" />
        de <label id="scatMaximo" class="maximo"><?php echo $s->quantPg(); ?></label>
    </div>
    <?php
}
?>