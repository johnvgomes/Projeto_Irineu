<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Produtos.php';

    $p = new Produtos();
    ?>

    <h1 id="infoTitle">Exibir produtos</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por nome:</label>
            <input id="prodSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="prodOrder">
                <option value="p.id" selected>ID</option>
                <option value="p.nome">Nome</option>
                <option value="p.preco">Pre&ccedil;o</option>
                <option value="p.peso">Peso</option>
                <option value="p.estoque">Estoque</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Pre&ccedil;o</td>
                <td>Peso</td>
                <td>Estoque</td>
                <td>Destaque</td>
                <td>[detalhes]</td>
                <td>[fotos]</td>
                <td>[tags]</td>
                <td>[editar]</td>
                <td>[excluir]</td>
            </tr>
        </thead>
        <?php $p->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="prodBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="prodAfter" class="after<?php
        if ($p->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="prodListing" class="listing">
        <input id="prodNumber" class="numero" type="number" value="1" min="1" max="<?php echo $p->quantPg(); ?>" />
        de <label id="prodMaximo" class="maximo"><?php echo $p->quantPg(); ?></label>
    </div>
    <?php
}
?>