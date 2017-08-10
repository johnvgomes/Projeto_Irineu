<?php

session_start();
if(!isset($_SESSION['sessao'])){
    echo "Sem acesso!";
}else{    
   

include_once '../class/Marca.php';
$m = new Marca();
?>

<form method="post" name="fmoto" id="fmoto" 
      enctype="multipart/form-data">
    <h3>Cadastro de Moto</h3>
    <br>
    <input type="text" name="txtnome" id="txtnome" 
           placeholder="Modelo">
    <br>
    <input type="text" name="txtvalor" id="txtvalor" 
           placeholder="Valor R$">
    <br>
    <label>Foto </label><input type="file" name="foto" 
                               id="foto" >
    <br>
    <input type="number" name="txtestoque" id="txtestoque" 
           min="0" max="100"
           placeholder="Estoque aqui">
    <br>
    <select name="cbomarca" id="cbomarca" >
        <option>Escolha a marca aqui</option>
        <?php
        $m->carregarSelect();
        ?>
    </select>
    <br><br>
    <input type="submit" name="btnenviar" id="btnenviar" 
           value="Cadastrar">
</form> 

<?php
if (isset($_POST['btnenviar'])) {
    $foto = $_FILES["foto"];
    if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])) {
        echo "<h3>Você deve escolher uma IMAGEM para a Moto.</h3>";
    } else {
        extract($_POST, EXTR_OVERWRITE);

        include_once '../class/Moto.php';
        $mt = new Moto();

        $foto = $foto['name'];
        $fototemp = $_FILES['foto']['tmp_name'];

        $mt->setNome($txtnome);
        $mt->setValor($txtvalor);
        $mt->setFoto($foto);
        $mt->setTpfoto($fototemp);

        $mt->setEstoque($txtestoque);
        $mt->setId_marca($cbomarca);

        $mt->cadastrar();
    }
}
}
?>