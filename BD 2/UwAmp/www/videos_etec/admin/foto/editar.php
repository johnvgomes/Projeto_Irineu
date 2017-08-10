<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Foto.php';
    include_once '../class/Controles.php';
    $f = new Foto();
    $ct = new Controles();

    $vetor = $f->carregar($ct->limparTexto((int) $_GET['id']));
    ?>

    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar foto</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Legenda:</label> <br />
                    <input name="txtlegenda" maxlength="50" type="text"
                           value="<?php echo $vetor[3]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Alterar Foto">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtlegenda'])) {

            extract($_POST, EXTR_OVERWRITE);
            //noticia

            $f->setId($vetor[0]);
            $f->setLegenda(strtr(strtoupper($txtlegenda), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            $f->setUrl($ct->retirarAcentos(strtolower($txtlegenda)));
            
            $f->editar();
            echo "<script language='javaScript'>window.location.href='?p=foto/cadastrar'</script>";
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
















