<?php

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Moto.php';
    $m = new Moto();
    ?>
    <table>
        <form method="post">
            <tr>
                <td><h3>Pesquisar Like Moto</h3></td>
            </tr>
            <tr>
                <td>
                    <label>Indique o modelo: </label>
                    <input type="text" name="txtmodelo" maxlength="4" size="30" />
                    <input type="submit" name="btnlike" value="Pesquisar" />
                </td>
            </tr>
        </form>
    </table>

    <?php

    if (!empty($_POST['txtmodelo']) && isset($_POST['btnlike'])) {
        $m->pesquisarLike(strtoupper($_POST['txtmodelo']) . "%", "adm");
    } else {
        echo "Preencha o modelo";
    }
}//fim login 
?>

