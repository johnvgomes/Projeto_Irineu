<?php
//      admin/moto/pesquisar.php

session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
} else {
    include_once '../class/Moto.php';
    $m = new Moto();
    ?>

    <form method="post">
        <h3>Pesquisar moto - SELECT LIKE</h3>
        <label>Indique o modelo:</label>
        <input type="text" name="txtmodelo" maxlength="5" size="30">
        <input type="submit" name="botao" value="Pesquisar">    
    </form>

    <?php
    if (!empty($_POST['txtmodelo']) && isset($_POST['botao'])) {
        $m->consultarLike(strtoupper($_POST['txtmodelo']) . "%");
        // ta%
    } else {
        echo "Preencha os campos";
    }
}
?>

