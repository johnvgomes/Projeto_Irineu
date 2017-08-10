<html>
    <head>
        <title>Multiple Upload</title>
    </head>
    <body>
        <form action="#" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileUpload[]" multiple>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>

<?php
if (isset($_FILES['fileUpload'])) {
    require '../WideImage/lib/WideImage.php'; //Inclui classe WideImage à página

    date_default_timezone_set("Brazil/East");

    $name = $_FILES['fileUpload']['name']; //Atribui uma array com os nomes dos arquivos à variável
    $tmp_name = $_FILES['fileUpload']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

    $allowedExts = array(".gif", ".jpeg", ".jpg", ".png", ".bmp"); //Extensões permitidas

    $dir = '../imagem_noticia/';

    for ($i = 0; $i < count($tmp_name); $i++) { //passa por todos os arquivos
        $ext = strtolower(substr($name[$i], -4));

        if (in_array($ext, $allowedExts)) { //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
            $new_name = date("Y.m.d-H.i.s") . "-" . $i . $ext;

            $image = WideImage::load($tmp_name[$i]); //Carrega a imagem utilizando a WideImage

            $image = $image->resize(400, 200, 'outside'); //Redimensiona a imagem para 170 de largura e 180 de altura, mantendo sua proporção no máximo possível
            $image = $image->crop('center', 'center', 200, 100); //Corta a imagem do centro, forçando sua altura e largura

            $image->saveToFile($dir . $new_name); //Salva a imagem
        }
    }
}
?>