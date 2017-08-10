<?php
// admin/noticia/trocarImagem.php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <form method="post" enctype="multipart/form-data">
        <h3>Deseja trocar a imagem selecionada?</h3>

        <img src="<?php echo "../imagem_noticia/" . $_GET['img']; ?>" 
             alt="Atualização de Imagem" 
             width="75px"><br>

        Escolha a nova imagem<br>
        <input type="file" name="imagem"><br><br>

        <input type="submit" name="btn" value="Trocar Imagem">
    </form>


    <?php
    if (isset($_POST['btn'])) {
        include_once '../class/ImagemNoticia.php';

        $novo = $_FILES['imagem']['name'];
        $temporario = $_FILES['imagem']['tmp_name'];

        $extensoes = array(".gif", ".jpeg", ".jpg", ".png", ".bmp");
        $ext = strtolower(substr($novo, -4));

        if (in_array($ext, $extensoes)) {
            //alterando o nome da imagem com md5
            $novonome = date("Ymdhis") . md5($novo) . $ext;
        }
        
        $in = new ImagemNoticia();

        $in->editarImagem((int) $_GET['id'], $novonome, $temporario, $_GET['img']);
        echo "<script language='javaScript'>window.location.href='?p=noticia/consultar'</script>";
    }
}
?>

