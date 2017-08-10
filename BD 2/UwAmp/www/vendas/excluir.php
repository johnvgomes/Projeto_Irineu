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
        <div id='hMinhaConta'><h1>Tem certeza que deseja excluir sua conta? :(</h1></div>
        <form method="post" action="" name="frmExcluir" id="frmExcluir">
            <table>
                <tr>
                    <td><label>Senha:</label></td>
                    <td><input name="txtSenha" type="password" maxlength="25" required /></td>
                </tr>
                <tr>
                    <td><label>Confirmar senha:</label></td>
                    <td><input name="txtConf" type="password" maxlength="25" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><input name="sbmExcluir" id="sbmExcluir" type="submit" value="Confirmar" /></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    if (isset($_POST['sbmExcluir'])) {
        if (!empty($_POST['txtSenha']) && ($_POST['txtSenha'] == $_POST['txtConf'])) {

            extract($_POST, EXTR_OVERWRITE);

            if (sha1($txtSenha) != $vetor[2]) {
                echo '<div id="respostaExcluir">Senha incorreta.</div>';
            } else {
                $cl->setSenha($txtSenha);

                $cl->excluir($id);
                $cl->excluidoEmail($vetor[13]);

                echo '<meta http-equiv="refresh" content="3;URL=' . URL::getBase() . 'logout" />';
            }
        } else {
            echo '<div id="respostaExcluir">Preencha todos os campos corretamente.</div>';
        }
    }
} else {
    include_once 'home.php';
    echo '<meta http-equiv="refresh" 
            content="1;URL=' . URL::getBase() . 'home" />';
}
?>