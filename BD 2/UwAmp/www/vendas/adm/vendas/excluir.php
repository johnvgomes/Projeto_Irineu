<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>
    <form method="post">
        <h1>Deseja excluir esta venda?</h1>
        <table>
            <tr>
                <td>
                    <label for="sim">Sim</label>
                    <input type="radio" name="decision" value="s" id="sim" checked/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nao">N&atilde;o</label>
                    <input type="radio" name="decision" value="n" id="nao" />
                </td>
            </tr>
            <tr>
                <td class="right"><input type="submit" name="sbmConf" value="Confirmar" /></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['sbmConf'])) {
        if ($_POST['decision'] == "s") {

            header("Location:?p=vendas/verificar&id={$_GET['id']}");
            echo '<meta http-equiv="refresh" 
            content="1;URL=?p=vendas/verificar&id=' . $_GET['id'] . '" />';
        } else {
            header("Location:?p=vendas/consultar");
            echo '<meta http-equiv="refresh" 
            content="1;URL=?p=vendas/consultar" />';
        }
    }
}
?>