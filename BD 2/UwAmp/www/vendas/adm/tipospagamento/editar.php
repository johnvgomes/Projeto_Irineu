<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    require_once '../class/Tipospagamento.php';
    require_once '../class/Controles.php';

    $tp = new Tipospagamento();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);

    $vetor = $tp->carregar($id);
    ?>

    <form id="frmTPag" action="" method="post" >
        <h1>Editar tipo de pagamento <?php echo $vetor[0]; ?></h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" maxlength="50" value="<?php echo $vetor[1]; ?>" autofocus /></td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><label>Descri&ccedil;&atilde;o:</label></td>
                <td><textarea name="txtDesc"><?php echo $vetor[2]; ?></textarea></td>
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

            $tp->setId($id);
            $tp->setNome($txtNome);
            $tp->setObs($txtDesc);
            $tp->editar();

            header('Location:?p=tipospagamento/consultar');
            echo '<meta http-equiv="refresh" content="1;URL=?p=tipospagamento/consultar">';
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>
