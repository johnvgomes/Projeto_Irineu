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
                <td><h3>Pesquisar Between Moto</h3></td>
            </tr>
            <tr>
                <td>
                    <label>Valor inicial: </label>
                    <select name="cboinicial">
                        <option value="0">R$ 0,00</option>
                        <option value="1000">R$ 1.000,00</option>
                        <option value="2000">R$ 2.000,00</option>
                        <option value="3000">R$ 3.000,00</option>
                    </select>

                    <label>Valor final: </label>
                    <select name="cbofinal">
                        <option value="2500">R$ 2.500,00</option>
                        <option value="5000">R$ 5.000,00</option>
                        <option value="20000">R$ 20.000,00</option>
                        <option value="30000">R$ 30.000,00</option>
                    </select>

                    <input type="submit" name="btnbetween" value="Pesquisar" />
                </td>
            </tr>
        </form>
    </table>

    <?php

    if (isset($_POST['btnbetween'])) {
        $m->pesquisarBetween($_POST['cboinicial'], $_POST['cbofinal'], "adm");
    } else {
        echo "Preencha o valor";
    }
}//fim login 
?>

