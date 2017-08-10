<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {


    require_once '../class/Marca.php';
    require_once '../class/Controles.php';

    $m = new Marca();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);

    $vetor = $m->carregar($id);
    ?>

    <table>
        <form method="post">
            <tr>
                <td><h3>Editar Marca</h3></td>
            </tr>
            <tr>
                <td>
                    <label>Nome da marca:</label>
                    <input name="txtmarca" type="text" maxlength="70"
                           size="50" value="<?php echo $vetor[1]; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>País de Origem:</label>        
                    <select name="cborigem">
                        <optgroup label="Origem atual" />
                        <option value="<?php echo $vetor[2]; ?>">
                            <?php echo $vetor[2]; ?></option>

                        <optgroup label="Escolha um país" />
                        <option value="Alemanha">Alemanha</option>
                        <option value="Brasil">Brasil</option>
                        <option value="China">China</option>
                        <option value="Coréia">Coréia</option>
                        <option value="EUA">EUA</option> 
                        <option value="Japão">Japão</option> 
                    </select>

                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="btnenviar" 
                           value="Cadastrar" />
                </td>
            </tr>

        </form>
    </table>

    <?php
    if (isset($_POST['btnenviar'])) {

        $m->editar($id, $_POST['txtmarca'], $_POST['cborigem']);

        header('Location:?p=marca/consultar');

        echo '<meta http-equiv="refresh" 
        content="1;URL=?p=marca/consultar">';
    }
}
?>
