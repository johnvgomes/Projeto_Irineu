<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Banner.php';
    include_once '../class/Controles.php';
    $b = new Banner();
    $ct = new Controles();

    $vetor = $b->carregar($ct->limparTexto((int) $_GET['id']));
    ?>

    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar banner</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Título:</label> <br>
                    <input name="txttitulo" maxlength="100" type="text"
                           value="<?php echo $vetor[1]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Link:</label> <br>
                    <input name="txtlink" maxlength="100" type="text"
                           value="<?php echo $vetor[3]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Destino:</label> <br>
                    <input name="txtlegenda" maxlength="50" type="text"
                           value="<?php echo $vetor[4]; ?>"> 
                    <select name="cbodestino">
                        <optgroup>Selecionado</optgroup>
                        <option value="<?php echo $vetor[4]; ?>" selected>
                            <?php echo $vetor[4]; ?>
                        </option>
                        <optgroup>Para alterar</optgroup>
                        <option value="_self">SELF</option>
                        <option value="_blank">BLANK</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Alterar Banner">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['txttitulo'])) {

            extract($_POST, EXTR_OVERWRITE);
            //noticia

            $b->setId($vetor[0]);
            $b->setTitulo(strtr(strtoupper($txttitulo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            $b->setLink($txtlink);
            $b->setDestino($cbodestino);
            
            $b->editar();
            echo "<script language='javaScript'>window.location.href='?p=banner/cadastrar'</script>";
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
















