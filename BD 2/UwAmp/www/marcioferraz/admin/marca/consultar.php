<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Marca.php';

    $m = new Marca();
    ?>

    <table border="1">
        <tr>
            <td>ID</td>
            <td>Marca</td>
            <td>Origem</td>
            <td>[excluir?]</td>
            <td>[editar?]</td>
        </tr>
        <?php $m->consultar(); ?>
    </table>
    <?php
}
?>
