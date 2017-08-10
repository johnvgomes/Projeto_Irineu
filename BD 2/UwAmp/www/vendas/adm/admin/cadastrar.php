<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>

    <form id="frmAdm" action="" method="post" >
        <h1>Cadastrar administrador</h1>
        <table>
            <tr>
                <td><label>Usu&aacute;rio:</label></td>
                <td><input name="txtUsuario" type="text" maxlength="50" style="text-transform: uppercase;" autofocus /></td>
            </tr>
            <tr>
                <td><label>E-mail:</label></td>
                <td><input name="txtEmail" type="email" maxlength="100" /></td>
            </tr>
            <tr>
                <td><label>Senha:</label></td>
                <td><input name="txtSenha" type="password" maxlength="25" /></td>
            </tr>
            <tr>
                <td><label>Confirmar senha:</label></td>
                <td><input name="txtConf" type="password" maxlength="25" /></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmCadastrar" type="submit" value="Cadastrar" /></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['sbmCadastrar'])) {
        if (!empty($_POST['txtUsuario']) && !empty($_POST['txtEmail']) && !empty($_POST['txtSenha']) && $_POST['txtSenha'] == $_POST['txtConf']) {

            extract($_POST, EXTR_OVERWRITE);

            require_once '../class/Admin.php';
            $a = new Admin();
            $exist = $a->verifEmail(strtolower($txtEmail));

            if ($exist) {
                echo 'E-mail j&aacute; cadastrado.';
            } else {
                $a->setNome(mb_strtoupper($txtUsuario));
                $a->setSenha($txtSenha);
                $a->setEmail(strtolower($txtEmail));
                $a->inserir();
            }
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>
