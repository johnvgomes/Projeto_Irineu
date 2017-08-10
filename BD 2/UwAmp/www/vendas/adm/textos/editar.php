<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    require_once '../class/Textos.php';
    require_once '../class/Controles.php';

    $t = new Textos();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);

    $vetor = $t->carregar($id);
    ?>

    <form id="frmTxt" action="" method="post" >
        <h1>Editar texto <?php echo $vetor[0]; ?></h1>
        <table>
            <tr>
                <td><label>T&iacute;tulo:</label></td>
                <td><input name="txtTitulo" type="text" maxlength="80" value="<?php echo $vetor[1]; ?>" autofocus /></td>
            </tr>
            <tr>
                <td colspan="2"><label>Conte&uacute;do:</label></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="txtConteudo" class="jqte-test"><?php echo $vetor[2]; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmEditar" type="submit" value="Editar" /></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['sbmEditar'])) {
        if (!empty($_POST['txtTitulo'])) {

            extract($_POST, EXTR_OVERWRITE);

            $t->setId($id);
            $t->setTitulo($txtTitulo);
            $t->setConteudo($txtConteudo);
            $t->editar();

            header('Location:?p=textos/consultar');
            echo '<meta http-equiv="refresh" content="1;URL=?p=textos/consultar">';
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
    ?>

    <script>
        $('.jqte-test').jqte();

        // settings of status
        var jqteStatus = true;
        $(".status").click(function()
        {
            jqteStatus = jqteStatus ? false : true;
            $('.jqte-test').jqte({"status": jqteStatus})
        });
    </script>

    <?php
}
?>