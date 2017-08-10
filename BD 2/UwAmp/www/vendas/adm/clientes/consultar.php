<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Clientes.php';

    $cl = new Clientes();
    ?>

    <h1 id="infoTitle">Exibir clientes</h1>

    <div id="filterTable">
        <div class="search">
            <label>Buscar por nome:</label>
            <input id="clieSearch" type="search" />
        </div>
        <div class="order">
            <label>Ordenar por:</label>
            <select id="clieOrder">
                <option value="cl.id" selected>ID</option>
                <option value="cl.nome">Nome</option>
                <option value="cl.dtnasc">Data de Nascimento</option>
            </select>
        </div>
    </div>

    <table class="infoTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>CPF</td>
                <td>Data de Nascimento</td>
                <td>Telefone</td>
                <td>Celular</td>
                <td>E-mail</td>
                <td>[endere&ccedil;o]</td>
            </tr>
        </thead>
        <?php $cl->consultar(); ?>
    </table>

    <div id="navTable">
        <div id="clieBefore" class="before hidden">&laquo;</div>
        <a href="#header"><div class="back"></div></a>
        <div id="clieAfter" class="after<?php
        if ($cl->quantPg() == 1) {
            echo ' hidden';
        }
        ?>">&raquo;</div>
    </div>

    <div id="clieListing" class="listing">
        <input id="clieNumber" class="numero" type="number" value="1" min="1" max="<?php echo $cl->quantPg(); ?>" />
        de <label id="clieMaximo" class="maximo"><?php echo $cl->quantPg(); ?></label>
    </div>

    <?php
}
?>