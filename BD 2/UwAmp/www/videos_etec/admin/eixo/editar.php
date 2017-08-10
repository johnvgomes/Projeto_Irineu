<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Eixo.php';
    include_once '../class/Controles.php';
    $e = new Eixo();
    $ct = new Controles();

    $vetor = $e->carregar($ct->limparTexto((int) $_GET['id']));
    ?>

    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar Eixo</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Eixo Tecnológico:</label> <br />
                    <input name="txtnome" maxlength="100" type="text"
                           value="<?php echo $vetor[1]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Alterar Eixo">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtnome'])) {

            extract($_POST, EXTR_OVERWRITE);
            //noticia

            $e->setId($vetor[0]);
            $e->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            
            $e->editar();
            echo "<script language='javaScript'>window.location.href='?p=eixo/cadastrar'</script>";
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
















