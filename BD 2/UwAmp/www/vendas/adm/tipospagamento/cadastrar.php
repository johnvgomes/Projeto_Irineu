<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>
    <form id="frmTPag" action="" method="post" >
        <h1>Cadastrar tipo de pagamento</h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" maxlength="50" autofocus /></td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><label>Descri&ccedil;&atilde;o:</label></td>
                <td><textarea name="txtDesc"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmCadastrar" type="submit" value="Cadastrar" /></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['sbmCadastrar'])) {
        if (!empty($_POST['txtNome'])) {

            extract($_POST, EXTR_OVERWRITE);

            require_once '../class/Tipospagamento.php';
            $tp = new Tipospagamento();

            $tp->setNome($txtNome);
            $tp->setObs($txtDesc);
            $tp->inserir();
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>