<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {

    require_once '../class/Admin.php';
    require_once '../class/Controles.php';

    $a = new Admin();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);

    $vetor = $a->carregar($id);
    ?>

    <form id="frmAdm" action="" method="post" >
        <h1>Editar administrador <?php echo $vetor[0]; ?></h1>
        <table>
            <tr>
                <td><label>Usu&aacute;rio:</label></td>
                <td><input name="txtUsuario" type="text" maxlength="50" value="<?php echo $vetor[1]; ?>" style="text-transform: uppercase;" autofocus /></td>
            </tr>
            <tr>
                <td><label>E-mail:</label></td>
                <td><input name="txtEmail" type="email" maxlength="100" value="<?php echo $vetor[3]; ?>" /></td>
            </tr>
            <tr>
                <td><label>Senha atual:</label></td>
                <td><input name="txtSenha" type="password" maxlength="25" /></td>
            </tr>
            <tr>
                <td><label>Nova senha:</label></td>
                <td><input name="txtNSenha" type="password" maxlength="25" /></td>
            </tr>
            <tr>
                <td><label>Confirmar senha:</label></td>
                <td><input name="txtConf" type="password" maxlength="25" /></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmEditar" type="submit" value="Editar" /></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['sbmEditar'])) {
        if (!empty($_POST['txtUsuario']) && !empty($_POST['txtEmail']) && !empty($_POST['txtSenha']) && !empty($_POST['txtNSenha']) && $_POST['txtNSenha'] == $_POST['txtConf']) {

            extract($_POST, EXTR_OVERWRITE);

            if (strtolower($txtEmail) != strtolower($vetor[3])) {
                $exist = $a->verifEmail(strtolower($txtEmail));
            }

            if ($exist) {
                echo 'E-mail j&aacute; cadastrado em outra conta.';
            } else if (sha1($txtSenha) != $vetor[2]) {
                echo 'Senha incorreta.';
            } else {
                $a->setId($id);
                $a->setNome(mb_strtoupper($txtUsuario));
                $a->setSenha($txtNSenha);
                $a->setEmail(strtolower($txtEmail));
                $a->editar();

                header('Location:?p=admin/consultar');
                echo '<meta http-equiv="refresh" content="1;URL=?p=admin/consultar">';

                /*
                  if ($_SESSION['lvl'] == 1) {
                  header('Location:?p=admin/consultar');
                  echo '<meta http-equiv="refresh" content="1;URL=?p=admin/consultar">';
                  } else {
                  header("Location:?p=adm");
                  echo '<meta http-equiv="refresh" content="1;URL=?p=adm" />';
                  } */
            }
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>
