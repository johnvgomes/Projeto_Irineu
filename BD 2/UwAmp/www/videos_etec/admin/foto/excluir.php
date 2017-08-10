<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <form method="post">
        <table>
            <tr>
                <td><h3>Deseja excluir esta Foto?</h3></td>
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
            require_once '../class/Foto.php';
            $f = new Foto();

            $id = (int) $_GET['id'];

            $f->excluir($id);

            echo "<script language='javaScript'>window.location.href='?p=foto/cadastrar'</script>";
        } else {
            echo "<script language='javaScript'>window.location.href='?p=foto/cadastrar'</script>";
        }
    }
}
?>