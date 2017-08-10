<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>

    <form id="frmVerif" action="" method="post">
        <h1>Insira sua senha</h1>
        <table>
            <tr>
                <td><label>Senha:</label></td>
                <td><input name="txtSenha" type="password" maxlength="25" /></td>
            </tr>
            <tr>
                <td><label>Confirmar senha:</label></td>
                <td><input name="txtConf" type="password" maxlength="25" /></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmVerif" type="submit" value="Confirmar" /></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['sbmVerif'])) {
        if ($_POST['txtSenha'] == $_POST['txtConf']) {
            require_once '../class/Admin.php';
            $a = new Admin();
            $verif = $a->verifSenha($_POST['txtSenha']);

            if ($verif) {

                require_once '../class/Vendas.php';
                require_once '../class/Controles.php';
                $v = new Vendas();
                $co = new Controles();

                $id = (int) $co->limparTexto($_GET['id']);

                $v->excluir($id);
                $v->enviaEmail($id);

                header("Location:?p=vendas/consultar");
                echo '<meta http-equiv="refresh" 
            content="1;URL=?p=vendas/consultar" />';
            } else {
                echo 'Senha incorreta.';
            }
        } else {
            echo 'Preencha os campos corretamente.';
        }
    }
}
?>