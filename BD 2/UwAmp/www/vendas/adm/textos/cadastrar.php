<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    ?>
    <form id="frmTxt" action="" method="post" >
        <h1>Cadastrar texto</h1>
        <table>
            <tr>
                <td><label>T&iacute;tulo:</label></td>
                <td><input name="txtTitulo" type="text" maxlength="80" autofocus /></td>
            </tr>
            <tr>
                <td colspan="2"><label>Conte&uacute;do:</label></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="txtConteudo" class="jqte-test"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmCadastrar" type="submit" value="Cadastrar" /></td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['sbmCadastrar'])) {
        if (!empty($_POST['txtTitulo'])) {

            extract($_POST, EXTR_OVERWRITE);

            require_once '../class/Textos.php';
            $t = new Textos();

            $t->setTitulo($txtTitulo);
            $t->setConteudo($txtConteudo);
            $t->inserir();
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