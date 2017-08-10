<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {


    include_once '../class/Pagina.php';
    include_once '../class/Controles.php';

    $p = new Pagina();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);

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
                        <label>Url amigavel:</label><br />
                        <input name="txturl" size="50" maxlength="100" type="text" value="<?php echo $vetor[1]; ?>" /> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Titulo:</label><br /> 
                        <input name="txttitulo" size="50" maxlength="100" type="text" value="<?php echo $vetor[2]; ?>" /> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Conteudo:</label><br /> 
                        <textarea rows="3" name="txtconteudo" placeholder="Conteúdo aqui">
                            <?php echo $vetor[3]; ?>
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
        $p->setUrl($txturl);
        $p->setTitulo(strtr(strtoupper($txttitulo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $p->setConteudo($txtconteudo);

        $p->editar();

        header('Location:?p=pagina/consultar');
        echo '<meta http-equiv="refresh" content="1;URL=?p=pagina/consultar">';
    }
}
?>
