
<form name="editar" id="editar" method="post" 
      enctype="multipart/form-data">
    <h3>Alteração do documento da logomarca</h3>
    <input type="file" name="arquivo" 
           id="arquivo">
    <br>
    <input type="submit" name="btneditar" 
           id="btneditar" value="alterar planta">
</form>
<?php
if (isset($_POST['btneditar'])) {

    $arquivo = $_FILES['arquivo']['name'];
    $temp = $_FILES['arquivo']['tmp_name'];
    $id = (int) $_GET['id'];

    //extensões permitidas
    $extensoes = array(".jpg", ".png", ".jpeg");
    //extração da extensão do arquivo escolhido
    $ext = strtolower(substr($arquivo, -4));
    if ($ext == "jpeg") {
        $ext = ".jpeg";
    }

    if (in_array($ext, $extensoes)) {
        $novonome = date("Ymdhis") . sha1($arquivo) . $ext;

        include_once '../class/Fabricante.php';
        $f = new Fabricante();
        $f->setId($id);
        $f->setLogomarca($novonome);
        $f->setTemp_logo($temp);
        $f->editarArquivo();
    }

    echo "<script language='javaScript'>
        window.location.href='?p=fabricante/consultar'
        </script>";
}
?>

