<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {


    include_once '../class/Pagina.php';
    include_once '../class/Controles.php';

    $p = new Pagina();
    $ct = new Controles();

    $id = (int) $ct->limparTexto($_GET['id']);

    $vetor = $p->carregar($id);
    ?>

    <table>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <h3>Editar Pagina</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Titulo:</label><br /> 
                        <input name="txttitulo" size="50" maxlength="100" type="text" value="<?php echo $vetor[1]; ?>" /> 
                    </td>
                </tr>
                <?php if (!empty($vetor[3])) { ?>
                    <tr>
                        <td>
                            <label>Link:</label><br /> 
                            <input name="txtlink" size="50" maxlength="100" type="text" value="<?php echo $vetor[3]; ?>" /> 
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>
                        <label>Conteudo:</label><br /> 
                        <textarea rows="3" name="txtconteudo" placeholder="Conteúdo aqui">
                            <?php echo $vetor[4]; ?>
                        </textarea> 
                    </td>
                </tr>

                <tr>
                    <td><input type="submit" name="btn" value="editar" /></td>
                </tr>

            </table>

        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        extract($_POST, EXTR_OVERWRITE);
        $p->setId($id);
        
        $p->setTitulo(strtr(strtoupper($txttitulo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $p->setUrl($ct->retirarAcentos(strtolower($txttitulo)));
        $p->setLink($txtlink);
        $p->setConteudo($txtconteudo);

        $p->editar();

         echo "<script language='javaScript'>window.location.href='?p=pagina/consultar'</script>";
    }
}
?>
