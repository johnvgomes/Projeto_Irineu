<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {

    include_once '../class/Categorias.php';

    $c = new Categorias();
    ?>

    <h1 id="infoTitle">Exibir categorias</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por nome:</label>
            <input id="catSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="catOrder">
                <option value="c.id" selected>ID</option>
                <option value="c.nome">Nome</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>[editar]</td>
                <td>[excluir]</td>
            </tr>
        </thead>
        <?php $c->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="catBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="catAfter" class="after<?php
        if ($c->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="catListing" class="listing">
        <input id="catNumber" class="numero" type="number" value="1" min="1" max="<?php echo $c->quantPg(); ?>" />
        de <label id="catMaximo" class="maximo"><?php echo $c->quantPg(); ?></label>
    </div>

    <?php
}
?>