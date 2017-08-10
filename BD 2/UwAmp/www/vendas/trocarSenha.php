<?php
if (isset($_SESSION['cliente'])) {

    include_once 'class/Clientes.php';
    include_once 'class/Controles.php';

    $cl = new Clientes();
    $co = new Controles();

    $id = (int) $co->limparTexto($_SESSION['clienteId']);

    $vetor = $cl->carregar($id);
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <div id="minhaContaNav">
        <a href="<?php echo URL::getBase(); ?>minhaconta"><div id="minhaContaLink" class="imgLink"></div></a>
        <a href="<?php echo URL::getBase(); ?>pedidos"><div id="meusPedidosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo URL::getBase(); ?>favoritos"><div id="favoritosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo URL::getBase(); ?>historico"><div id="historicoLink" class="imgLink offLink"></div></a>
        <hr />
    </div>

    <div id="meusDados">
        <div id='hMinhaConta'><div></div><h1>Trocar senha</h1></div>
        <form method="post" action="" name="frmTrocaSenha" id="frmTrocaSenha">
            <table>
                <tr>
                    <td><label>Senha atual:</label></td>
                    <td><input name="txtSenha" type="password" maxlength="25" required /></td>
                </tr>
                <tr>
                    <td><label>Senha nova:</label></td>
                    <td><input name="txtNSenha" type="password" maxlength="25" required /></td>
                </tr>
                <tr>
                    <td><label>Confirmar senha nova:</label></td>
                    <td><input name="txtNConf" type="password" maxlength="25" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="sbmTrocar" id="sbmTrocar" type="submit" value="Salvar alterações" /></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    if (isset($_POST['sbmTrocar'])) {
        if (!empty($_POST['txtSenha']) && !empty($_POST['txtNSenha']) && ($_POST['txtNSenha'] == $_POST['txtNConf'])) {

            extract($_POST, EXTR_OVERWRITE);

            if (sha1($txtSenha) != $vetor[2]) {
                echo '<div id="respostaTroca">Senha incorreta.</div>';
            } else {
                $cl->setId($id);
                $cl->setSenha($txtNSenha);

                $cl->trocarSenha();
                $cl->trocadoEmail($vetor[13]);

                echo '<meta http-equiv="refresh" content="1;URL=' . URL::getBase() . 'minhaconta" />';
            }
        } else {
            echo '<div id="respostaTroca">Preencha todos os campos corretamente.</div>';
        }
    }
} else {
    include_once 'home.php';
    echo '<meta http-equiv="refresh" 
            content="1;URL=' . URL::getBase() . 'home" />';
}
?>