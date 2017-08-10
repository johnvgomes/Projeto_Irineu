<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Categorias.php';
    $c = new Categorias();
    ?>
    <form id="frmSCat" action="" method="post" >
        <h1>Cadastrar subcategoria</h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" maxlength="50" autofocus /></td>
            </tr>
            <tr>
                <td><label>Categoria-pai:</label></td>
                <td><select name="cboCat">
                        <?php
                        $c->carregarCombo();
                        ?>
                    </select></td>
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

            require_once '../class/Subcategorias.php';
            $s = new Subcategorias();
            $exist = $s->verifNome($txtNome, $cboCat);

            if ($exist) {
                echo 'Subcategoria j&aacute; cadastrada.';
            } else {
                $s->setNome($txtNome);
                $s->setId_catego($cboCat);
                $s->inserir();
            }
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>