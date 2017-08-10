<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    include_once '../class/Curso.php';
    $c = new Curso();
    ?>

    <form method="post" name="ftcc" id="ftcc">
        <label>Ano: </label>
        <select name="cboano">
            <option>Escolha o ano</option>
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

        <label>Curso: </label>
        <select name="cbocurso">
            <option>Escolha o Curso</option>
            <?php $c->carregarSelect(); ?>
        </select>

        <input type="submit" name="btnpesquisar" id="cadastrar" value="Pesquisar"><br>
    </form>

    <?php
    if (isset($_POST['btnpesquisar'])) {
        include_once '../class/TCC.php';

        $t = new TCC();
        $t->consultar($_POST['cbocurso'],$_POST['cboano']);
    }
}
?>