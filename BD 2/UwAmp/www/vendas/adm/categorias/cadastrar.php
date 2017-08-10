<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>

    <form id="frmCat" action="" method="post" >
        <h1>Cadastrar categoria</h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" maxlength="50" style="text-transform:uppercase;" autofocus /></td>
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

            require_once '../class/Categorias.php';
            $c = new Categorias();
            $exist = $c->verifNome(mb_strtoupper($txtNome));

            if ($exist) {
                echo 'Categoria j&aacute; cadastrada.';
            } else {
                $c->setNome(mb_strtoupper($txtNome));
                $c->inserir();
            }
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>