<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    unset($_SESSION["idProduto"]);

    require_once '../class/Produtos.php';
    require_once '../class/Marcas.php';
    require_once '../class/Subcategorias.php';
    require_once '../class/Tags.php';
    require_once '../class/Controles.php';

    $p = new Produtos();
    $m = new Marcas();
    $s = new Subcategorias();
    $t = new Tags();
    $co = new Controles();

    $_SESSION['idProduto'] = (int) $co->limparTexto($_GET['id']);
    $vetor = $p->carregar($_SESSION['idProduto']);
    ?>

    <form id="frmProd" action="" method="post" >
        <h1>Editar produto <?php echo $vetor[0]; ?></h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" maxlength="80" value="<?php echo utf8_decode($vetor[1]); ?>" autofocus /></td>
            </tr>
            <tr>
                <td><label>Pre&ccedil;o:</label></td>
                <td>
                    <input name="numPreco" id="numPreco" type="text" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="0" value="<?php echo $p->mudaPreco($vetor[2]); ?>" />
                    <span id="aviso1" class="aviso">Valor inv&aacute;lido</span>
                </td>
            </tr>
            <tr>
                <td><label>Peso:</label></td>
                <td>
                    <input name="numPeso" id="numPeso" type="text" pattern="[0-9]+([\.|,][0-9]+)?" step="0.001" min="0" value="<?php echo $p->mudaPeso($vetor[3]); ?>" />
                    <span id="aviso2" class="aviso">Valor inv&aacute;lido</span>
                </td>
            </tr>
            <tr>
                <td><label>Estoque:</label></td>
                <td>
                    <input name="numEstoque" type="number" pattern="[0-9]+" step="1" min="0" value="<?php echo $vetor[4]; ?>" />
                    <span id="aviso3" class="aviso">Valor inv&aacute;lido</span>
                </td>
            </tr>
            <tr>
                <td><label>Descri&ccedil;&atilde;o:</label></td>
                <td>
                    <textarea name="txtDesc" class="jqte-test" placeholder="Descreva o produto para o cliente, com detalhes sobre a apar&ecirc;ncia, funcionalidade etc."><?php echo utf8_decode($vetor[6]); ?></textarea>
                </td>
            </tr>
            <tr>
                <td><label>Destacar produto?</label></td>
                <td><input type="checkbox" name="chkDest" <?php echo $p->checkDestaque($vetor[7]); ?> /></td>
            </tr>
            <tr>
                <td><label>Marca:</label></td>
                <td><select name="cboMarca" id="<?php echo $vetor[8]; ?>">
                        <?php
                        $m->carregarCombo();
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td><label>Subcategoria:</label></td>
                <td><select name="cboSubcat" id="<?php echo $vetor[9]; ?>">
                        <?php
                        $s->carregarCombo();
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td colspan="2" class="right" id="btnProd"><input name="btnEditar" type="button" value="Editar" id="editProduto"></td>
            </tr>
        </table>
    </form>

    <p id="resposta"></p>

    <hr class="separaForm" />

    <h2 id="infoSTitle">Adicionar fotos</h2>
    <iframe src="produtos/fotos/previewEdit.php" height="200" id="previewBox">Por favor, atualize seu navegador para utilizar este recurso.</iframe>
    <div id="divFotos"></div>

    <hr class="separaForm" />

    <h2 id="infoSTitle">Adicionar tags</h2>
    <div id="showTags" onclick="mostrarTags();"></div>

    <?php $t->carregar($_SESSION['idProduto']); ?>

    <div class="right"><form method="post"><input name="sbmPronto" type="submit" value="Pronto!"></form></div>

    <script type="text/javascript">
        $('option').each(function() {
            if ($(this).val() == $(this).parents('select').attr('id')) {
                $(this).attr('selected', true);
            }
        });

        $('#numPreco').priceFormat({
            prefix: 'R$ ',
            centsSeparator: ',',
            thousandsSeparator: '.'
        });
        $('#numPeso').priceFormat({
            prefix: '',
            suffix: ' kg',
            centsSeparator: ',',
            thousandsSeparator: '.',
            centsLimit: 3
        });
        
        $('.jqte-test').jqte();

        // settings of status
        var jqteStatus = true;
        $(".status").click(function()
        {
            jqteStatus = jqteStatus ? false : true;
            $('.jqte-test').jqte({"status": jqteStatus})
        });
    </script>
    <?php
    if (isset($_POST['sbmPronto'])) {
        unset($_SESSION["idProduto"]);

        header("Location:?p=produtos/consultar");
        echo '<meta http-equiv="refresh" 
            content="1;URL=?p=produtos/consultar" />';
    }
}
?>
