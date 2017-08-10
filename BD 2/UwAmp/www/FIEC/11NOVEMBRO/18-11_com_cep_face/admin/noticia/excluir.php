<?php

// admin/noticia/excluir.php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <table>
        <form method="post">
            <tr><td>Deseja excluir a notícia?</td></tr>
            
            <tr>
                <td>
                    <input type="radio" name="decisao" value="s">Sim
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="decisao" value="n">Não
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="btnexcluir" id="btnexcluir"
                           value="excluir">
                </td>
            </tr>
        </form>
    </table>

    <?php
    
    if(isset($_POST['btnexcluir'])){
        include_once '../class/Noticia.php';
        $n = new Noticia();
        
        if($_POST['decisao'] == "s"){
            $id = (int) $_GET['id'];
            $n->excluir($id);
        }
           
        echo "<script language='javaScript'>window.location.href='?p=noticia/consultar'</script>";
       
    }

}
?>