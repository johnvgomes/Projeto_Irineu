<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Trocar a imagem selecionada?</h3>
                </td>
            </tr>


            <tr>
                <td>

                    <img src="<?php echo "../imagem_produto/" . $_GET['img'] ?>"
                         width="75px">    
                </td>
            </tr>
            <tr>
                <td>
                    <label>Escolher Nova Imagem:</label>    
                    <input type="file" name="arquivo" >    
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" value="Trocar imagem">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {

        include_once '../class/Imagem.php';

        $novo = $_FILES['arquivo']['name'];
        $temporario = $_FILES['arquivo']['tmp_name'];

        $extensoes = array(".gif", ".jpeg", ".jpg", ".png", ".bmp");

        $ext = strtolower(substr($novo, -4));

        if (in_array($ext, $extensoes)) {
//renomeando a imagem
//altera o nome da imagem
            $newnome = date("Ymdhis") . md5($novo);

            $in = new Imagem();


            //echo (int) $_GET['id'] . " - " . $newnome . $ext . " - " . $tmp_imagem . " - " . $_GET['img'];


            $in->editarImagem((int) $_GET['id'], $newnome . $ext, $temporario, $_GET['img']);
            echo "<script language='javaScript'>window.location.href='?p=produto/consultar'</script>";
        } else {
            echo 'Erro no arquivo <strong>' . $newnome . '</strong><br />';
        }
    }
}
?>

