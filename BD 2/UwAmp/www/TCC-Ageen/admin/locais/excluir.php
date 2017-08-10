<form method="post">
    <table>
        <tr>
            <td><h3>Deseja excluir este Local?</h3></td>
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
        
        include_once '../class/Locais.php';
        $l = new Locais();
        $l->setId((int) $_GET['id']);    
        $l->excluir();

       echo "<script language='javaScript'>window.location.href='?p=Locais/consultar'</script>";
    } else {
        echo "<script language='javaScript'>window.location.href='?p=Locais/consultar'</script>";
    }
}
?>