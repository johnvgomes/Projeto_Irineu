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
                       
                    <img src="<?php echo "../imagem_noticia/" . $_GET['img'] ?>"
                         width="75px">    
                </td>
            </tr>
            <tr>
                <td>
                    <label>Escolher Nova Imagem:</label>    
                    <input type="file" name="imagem">    
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

        include_once '../class/ImagemNoticia.php';
        
        $novo = $_FILES['imagem']['name'];
        $temporario = $_FILES['imagem']['tmp_name'];
        
        //altera o nome da imagem
        $newnome = date("Ymdhis").md5($novo);

        $in = new ImagemNoticia();
        
        $in->editarImagem((int)$_GET['id'], $newnome, $temporario, $_GET['img']);
        echo "<script language='javaScript'>window.location.href='?p=noticia/consultar'</script>";
        
    }
}
?>

