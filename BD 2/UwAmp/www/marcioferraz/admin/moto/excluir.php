<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <form method="post">
        <table>
            <tr>
                <td><h3>Deseja excluir esta Moto?</h3></td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="decisao" value="s" />
                    Sim
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="decisao" value="n" />
                    N&atilde;o
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="enviar" id="enviar" value="enviar" />
                </td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['enviar'])) {
        if ($_POST['decisao'] == "s") {
            require_once '../class/Moto.php';
            $m = new Moto();

            $id = (int) $_GET['id'];

            $m->excluir($id);

            //retorna pelo PHP
            header("Location:?p=moto/consultar");
            //retorna pelo HTML
            echo '<meta http-equiv="refresh" 
            content="1;URL=?p=moto/consultar" />';
        } else {
            //retorna pelo PHP
            header("Location:?p=moto/consultar");
            //retorna pelo HTML
            echo '<meta http-equiv="refresh" 
            content="1;URL=?p=moto/consultar" />';
        }
    }
}
?>