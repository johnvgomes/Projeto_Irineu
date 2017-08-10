<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Video.php';
    $v = new Video();

    echo "<br>";
    //$vetor = $b->carregar($ct->limparTexto((int) $_GET['id']));
    $v->visualizar();
    ?>

    <table>
        <br>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar video - não se esqueça de colocar 100% para w e h</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Incorpore o HTML do novo vídeo abaixo:</label> <br>
                    <!--<textarea name="txtlink" id="txtlink" rows="4"></textarea>-->
                    <input type="text" name="txtlink" id="txtlink" size="100%">
                </td>
            </tr>
            
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Alterar Vídeo">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtlink'])) {

            extract($_POST, EXTR_OVERWRITE);
            //noticia

            $v->setId(1);
            $v->setLink($txtlink);
            
            $v->editar();
            echo "<script language='javaScript'>window.location.href='?p=video/editar'</script>";
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
















