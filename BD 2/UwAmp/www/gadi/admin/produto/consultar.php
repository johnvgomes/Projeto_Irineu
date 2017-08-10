<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Categoria.php';

    $e = new Categoria();
    ?>

    <form method="post" name="fproduto" id="fproduto">
        <label>Categoria:</label>
        <select name="cbocat">
            <option>Escolha uma Categoria</option>
            <?php $e->carregarSelect(); ?>
        </select>

        <input type="submit" name="btnpesquisar" value="Pesquisar"><br>
    </form>

    <?php
    if (isset($_POST['btnpesquisar'])) {
        include_once '../class/Produto.php';


        $n = new Produto();
        $n->setId_categoria($_POST['cbocat']);
        $n->consultar();
    }
}
?>