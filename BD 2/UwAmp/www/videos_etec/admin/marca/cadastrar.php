<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
    <form name="cadastro" id="form" method="post" action="">
        <table>
            <tr>
                <td colspan="2"><h3>Cadastro de Marca</h3></td>
            </tr>
            <tr>
                <td>Marca: </td>
                <td><input name="txtmarca" maxlength="50" type="text" /> </td>
            </tr>
            <tr>
                <td>Origem: </td>
                <td><select name="cborigem">
                        <optgroup label="Escolha um país" />
                        <option value="Alemanha">Alemanha</option>
                        <option value="Brasil">Brasil</option>
                        <option value="China">China</option>
                        <option value="Coréia">Coréia</option>
                        <option value="EUA">EUA</option> 
                        <option value="Japão">Japão</option> 
                    </select></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="btn" /></td>
            </tr>

        </table>
    </form>

    <?php
    if (isset($_POST['btn'])) {
        include_once '../class/Marca.php';
        $m = new Marca();

        extract($_POST, EXTR_OVERWRITE);

        $m->setMarca(strtoupper($txtmarca));
        $m->setOrigem($cborigem);

        $m->salvar();
    }
}
?>
