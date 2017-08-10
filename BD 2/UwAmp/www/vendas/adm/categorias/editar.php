<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    require_once '../class/Categorias.php';
    require_once '../class/Controles.php';

    $c = new Categorias();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);

    $vetor = $c->carregar($id);
    ?>

    <form id="frmCat" action="" method="post" >
        <h1>Editar categoria <?php echo $vetor[0]; ?></h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" style="text-transform:uppercase;" maxlength="50" value="<?php echo $vetor[1]; ?>" autofocus /></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmEditar" type="submit" value="Editar" /></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['sbmEditar'])) {
        if (!empty($_POST['txtNome'])) {

            extract($_POST, EXTR_OVERWRITE);

            $exist = $c->verifNome(mb_strtoupper($txtNome));

            if ($exist) {
                echo 'Categoria j&aacute; cadastrada.';
            } else {
                $c->setId($id);
                $c->setNome(mb_strtoupper($txtNome));
                $c->editar();
            }

            header('Location:?p=categorias/consultar');
            echo '<meta http-equiv="refresh" content="1;URL=?p=categorias/consultar">';
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>
