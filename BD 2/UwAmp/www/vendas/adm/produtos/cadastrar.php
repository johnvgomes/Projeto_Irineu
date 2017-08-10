<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    unset($_SESSION["idProduto"]);

    include_once '../class/Subcategorias.php';
    $s = new Subcategorias();

    include_once '../class/Marcas.php';
    $m = new Marcas();
    ?>

    <form id="frmProd" action="" method="post" >
        <h1>Cadastrar produto</h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" maxlength="80" autofocus /></td>
            </tr>
            <tr>
                <td><label>Pre&ccedil;o:</label></td>
                <td>
                    <input name="numPreco" id="numPreco" type="text" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="0" />
                    <span id="aviso1" class="aviso">Valor inv&aacute;lido</span>
                </td>
            </tr>
            <tr>
                <td><label>Peso:</label></td>
                <td>
                    <input name="numPeso" id="numPeso" type="text" pattern="[0-9]+([\.|,][0-9]+)?" step="0.001" min="0" />
                    <span id="aviso2" class="aviso">Valor inv&aacute;lido</span>
                </td>
            </tr>
            <tr>
                <td><label>Estoque:</label></td>
                <td>
                    <input name="numEstoque" type="number" pattern="[0-9]+" step="1" min="0" />
                    <span id="aviso3" class="aviso">Valor inv&aacute;lido</span>
                </td>
            </tr>
            <tr>
                <td><label>Descri&ccedil;&atilde;o:</label></td>
                <td><textarea name="txtDesc" class="jqte-test" placeholder="Descreva o produto para o cliente, com detalhes sobre a apar&ecirc;ncia, funcionalidade etc."></textarea></td>
            </tr>
            <tr>
                <td><label>Destacar produto?</label></td>
                <td><input type="checkbox" name="chkDest" /></td>
            </tr>
            <tr>
                <td><label>Marca:</label></td>
                <td><select name="cboMarca">
                        <?php
                        $m->carregarCombo();
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td><label>Subcategoria:</label></td>
                <td><select name="cboSubcat">
                        <?php
                        $s->carregarCombo();
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td colspan="2" class="right" id="btnProd"><input name="btnCadastrar" id="cadProduto" type="button" value="Cadastrar" /></td>
            </tr>
        </table>
    </form>

    <script type="text/javascript">
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

        header("Location:?p=produtos/cadastrar");
        echo '<meta http-equiv="refresh" 
            content="1;URL=?p=produtos/cadastrar" />';
    }
}
?>