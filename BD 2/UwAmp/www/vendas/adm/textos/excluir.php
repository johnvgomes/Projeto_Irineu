<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>
    <form method="post">
        <h1>Deseja excluir este texto?</h1>
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

            require_once '../class/Textos.php';
            require_once '../class/Controles.php';
            $t = new Textos();
            $co = new Controles();

            $id = (int) $co->limparTexto($_GET['id']);

            $t->excluir($id);
        }

        header("Location:?p=textos/consultar");
        echo '<meta http-equiv="refresh" 
            content="1;URL=?p=textos/consultar" />';
    }
}
?>