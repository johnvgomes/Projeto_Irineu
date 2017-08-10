<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <form method="post">
        <table>
            <tr>
                <td><h3>Deseja excluir esta Pagina?</h3></td>
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
            include_once '../class/Pagina.php';
            $p = new Pagina();

            $id = (int) $_GET['id'];

            $p->excluir($id);


            //retorna pelo PHP
            header("Location:?p=pagina/consultar");
            //retorna pelo HTML
            echo '<meta http-equiv="refresh" 
            content="1;URL=?p=pagina/consultar" />';
        } else {
            //retorna pelo PHP
            header("Location:?p=pagina/consultar");
            //retorna pelo HTML
            echo '<meta http-equiv="refresh" 
            content="1;URL=?p=pagina/consultar" />';
        }
    }
}
?>