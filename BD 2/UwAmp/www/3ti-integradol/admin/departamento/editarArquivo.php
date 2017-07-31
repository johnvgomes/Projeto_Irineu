<form name="editar" id="editar" method="post" 
      enctype="multipart/form-data">
    <h3>Alteração do documento da planta</h3>
    <input type="file" name="arquivo" 
           id="arquivo">
    <br>
    <input type="submit" name="btneditar" 
           id="btneditar" value="alterar planta">
</form>
<?php
if(isset($_POST['btneditar'])){
    $arquivo = $_FILES['arquivo']['name'];
    $temp = $_FILES['arquivo']['tmp_name'];
    $id = (int) $_GET['id'];
    
    //extensões permitidas
    $extensoes = array(".pdf", ".doc", ".docx");
    //extração da extensão do arquivo escolhido
    $ext = strtolower(substr($arquivo, -4));
    if ($ext == "docx") {
        $ext = ".docx";
    }

    if (in_array($ext, $extensoes)) {
        $novonome = date("Ymdhis").sha1($arquivo).  $ext;
        
        include_once '../class/Departamento.php';
        $d = new Departamento();
        $d->setId($id);
        $d->setPlanta($novonome);
        $d->setTemp_planta($temp);
        $d->editarArquivo();
    }
    
    echo "<script language='javaScript'>
        window.location.href='?p=departamento/consultar'
        </script>";
}
?>

