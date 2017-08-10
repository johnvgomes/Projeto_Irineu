<?php
include_once 'class/Buscar.php';
include_once 'class/Marcas.php';

$b = new Buscar();
$m = new Marcas();

$busca = urldecode($url->getURL(1));

$result = $b->exibirProdutos($busca, "");

if (empty($busca)) {
    echo '404';
} else if ($result) {
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <div class="<?php echo $busca; ?>" id="resultTitle">
        <h1><?php echo 'Resultado da busca "' . $busca . '"' ?></h1>
    </div>

    <div id="buscaFilt" class="resultFilter">
        <div id="resNum">
            <?php echo $numReg = $b->numReg($busca, ""); ?> registro(s)
            <?php
            if ($numReg > 20) {
                echo " - <a id='showAll' onclick='mostrarTudo();'>Mostrar tudo</a>";
            }
            ?>
        </div>
        <div id="resOrder">
            <label>Ordenar por:</label>
            <select name="cboOrder" id="ordem">
                <option value="0" selected>Mais recentes</option>
                <option value="1">Maior preço</option>
                <option value="2">Menor preço</option>
                <option value="3">A-Z</option>
                <option value="4">Z-A</option>
            </select>
        </div>
        <div id="resBetween">
            <label><a id='labelPreco'>Preço:</a></label>
            <div><input type="checkbox" class="preco" name="preco[]" value="49" checked />De R$ 0,00 a R$ 49,99</div>
            <div><input type="checkbox" class="preco" name="preco[]" value="99" checked />De R$ 50,00 a R$ 99,99</div>
            <div><input type="checkbox" class="preco" name="preco[]" value="499" checked />De R$ 100,00 a R$ 499,99</div>
            <div><input type="checkbox" class="preco" name="preco[]" value="999" checked />De R$ 500,00 a R$ 999,99</div>
            <div><input type="checkbox" class="preco" name="preco[]" value="4999" checked />De R$ 1.000,00 a R$ 4.999,99</div>
            <div><input type="checkbox" class="preco" name="preco[]" value="5000" checked />Mais de R$ 5.000,00</div>
        </div>
        <div id="resIn">
            <label><a id='labelMarca'>Marca:</a></label>
            <?php $m->listaMarcas(); ?>
        </div>
    </div>

    <div id="resultBox">
        <?php echo $result; ?>
    </div>
    <?php
} else {
    ?>
    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <div class="<?php echo $busca; ?>" id="resultTitle">
        <div id="noResult"><h1>Nenhum resultado encontrado para "<?php echo $busca; ?>"...</h1></div>
    </div>
    <?php
}
?>
