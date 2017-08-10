<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    require_once '../class/Categorias.php';
    require_once '../class/Subcategorias.php';
    require_once '../class/Controles.php';

    $c = new Categorias();
    $s = new Subcategorias();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);

    $vetor = $s->carregar($id);
    ?>

    <form id="frmSCat" action="" method="post" >
        <h1>Editar subcategoria <?php echo $vetor[0]; ?></h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" maxlength="50" value="<?php echo $vetor[1]; ?>" autofocus /></td>
            </tr>
            <tr>
                <td><label>Categoria-pai:</label></td>
                <td><select name="cboCat" id="<?php echo $vetor[3]; ?>">
                        <?php
                        $c->carregarCombo();
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmEditar" type="submit" value="Editar" /></td>
            </tr>
        </table>
    </form>

    <script type="text/javascript">
        $('option[value="' + $('select').attr('id') + '"]').attr('selected', true);
    </script>

    <?php
    if (isset($_POST['sbmEditar'])) {
        if (!empty($_POST['txtNome'])) {

            extract($_POST, EXTR_OVERWRITE);

            $exist = $s->verifNome($txtNome, $cboCat);

            if ($exist) {
                echo 'Subcategoria j&aacute; cadastrada.';
            } else {
                $s->setId($id);
                $s->setNome($txtNome);
                $s->setId_catego($cboCat);
                $s->editar();
            }

            header('Location:?p=subcategorias/consultar');
            echo '<meta http-equiv="refresh" content="1;URL=?p=subcategorias/consultar">';
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>
