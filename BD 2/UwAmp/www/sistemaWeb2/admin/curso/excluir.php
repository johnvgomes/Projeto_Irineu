<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
?>

<form method="post">
    <table>
        <tr>
            <td><h3>Deseja excluir este Curso?</h3></td>
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
        
        include_once '../class/Curso.php';
        $c = new Curso();
        $c->setId((int) $_GET['id']);    
        $c->excluir();

        echo "<script language='javaScript'>window.location.href='?p=curso/consultar'</script>";
    } else {
        echo "<script language='javaScript'>window.location.href='?p=curso/consultar'</script>";
    }
}
}
?>