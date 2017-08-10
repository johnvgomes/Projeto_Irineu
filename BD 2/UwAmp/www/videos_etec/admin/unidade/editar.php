<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Unidade.php';
    include_once '../class/Controles.php';
    $u = new Unidade();
    $ct = new Controles();

    $vetor = $u->carregar($ct->limparTexto((int) $_GET['id']));
    ?>

    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar Unidade</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Unidade:</label> <br />
                    <input name="txtnome" maxlength="100" type="text"
                           value="<?php echo $vetor[1]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Alterar Unidade">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtnome'])) {

            extract($_POST, EXTR_OVERWRITE);
            //noticia

            $u->setId($vetor[0]);
            $u->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            
            $u->editar();
            echo "<script language='javaScript'>window.location.href='?p=unidade/cadastrar'</script>";
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
















