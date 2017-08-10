<?php
// admin/moto/consultarValor
session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
} else {
    ?>
    <div class="form">
        <!--form para consultar por valor-->
        <form method="post" name="fmoto" id="fmoto">
            <label>Valor inicial: </label>
            <select name="cboinicial">
                <option value="0">R$ 0,00</option>
                <option value="2000">R$ 2.000,00</option>
                <option value="5000">R$ 5.000,00</option>
                <option value="10000">R$ 10.000,00</option>
            </select>

            <label>Valor final: </label>
            <select name="cbofinal">
                <option value="5000">R$ 5.000,00</option>
                <option value="10000">R$ 10.000,00</option>
                <option value="20000">R$ 20.000,00</option>
                <option value="50000">R$ 50.000,00</option>
            </select>

            <input type="submit" name="btnpesquisar" value="Pesquisar"><br>
        </form>
        <?php
        if (isset($_POST['btnpesquisar'])) {
            echo "<h3>Motos de R$ "
            . number_format($_POST['cboinicial'], 2, ',', '.')
            . " a " .
            "R$ " . number_format($_POST['cbofinal'], 2, ',', '.')."</h3>";
        }
        ?>
    </div>

    <?php
    if (isset($_POST['btnpesquisar'])) {



        include_once '../class/Moto.php';
        $m = new Moto();
        $m->consultarValor($_POST['cboinicial'], $_POST['cbofinal']);
    }
}
?>

