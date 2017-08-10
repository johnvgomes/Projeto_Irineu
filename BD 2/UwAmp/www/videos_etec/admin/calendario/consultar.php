<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <form method="post" name="fcalendario" id="fcalendario">
        <label>Ano Inicial: </label>
        <select name="cboinicial">
            <option>Escolha uma ano inicial</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
        </select>

        <label>Ano Final: </label>
        <select name="cbofinal">
            <option>Escolha uma ano inicial</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
            <option value="2031">2031</option>
            <option value="2032">2032</option>
            <option value="2033">2033</option>
            <option value="2034">2034</option>
            <option value="2035">2035</option>
        </select>

        <input type="submit" name="btnpesquisar" id="cadastrar" value="Pesquisar"><br>
    </form>

    <?php
    if (isset($_POST['btnpesquisar'])) {
        include_once '../class/Calendario.php';

        $c = new Calendario();
        $c->consultar($_POST['cboinicial'], $_POST['cbofinal']);
    }
}
?>