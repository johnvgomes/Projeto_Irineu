<?php
//      admin/noticia/consultar.php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <form method="post" name="fnoticia" id="fnoticia">
        <label>Data Inicial: </label>
        <input type="date" name="txtinicio" id="txtinicio">

        <label>Data Final: </label>
        <input type="date" name="txtfim" id="txtfim">

        <input type="submit" name="btnpesquisar" value="Pesquisar"><br>
    </form>

    <?php
    if (isset($_POST['btnpesquisar'])) {
        include_once '../class/Noticia.php';

        echo "<h3>Data Inicial " .
                @date("d/m/Y", strtotime($_POST['txtinicio']))." <br> ".
                "Data Final " .
                @date("d/m/Y", strtotime($_POST['txtfim']))."<br><br><br>
                    Para alterar qualquer imagem, basta clicar sobre a mesma
                    </h3>";
        
        $n = new Noticia();
        $n->consultar($_POST['txtinicio'],$_POST['txtfim']);

    }
}
?>