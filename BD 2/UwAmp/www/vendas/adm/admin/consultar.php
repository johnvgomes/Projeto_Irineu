<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {

    include_once '../class/Admin.php';

    $a = new Admin();
    ?>

    <h1 id="infoTitle">Exibir administradores</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por nome:</label>
            <input id="admSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="admOrder">
                <option value="a.id" selected>ID</option>
                <option value="a.nome">Nome</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>[editar]</td>
                <td>[excluir]</td>
            </tr>
        </thead>
        <?php $a->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="admBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="admAfter" class="after<?php
        if ($a->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="admListing" class="listing">
        <input id="admNumber" class="numero" type="number" value="1" min="1" max="<?php echo $a->quantPg(); ?>" />
        de <label id="admMaximo" class="maximo"><?php echo $a->quantPg(); ?></label>
    </div>

    <?php
}
?>