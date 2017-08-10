<?php

include_once '../class/Fabricante.php';
$f = new Fabricante();

$id = (int) $_GET['id'];

$f->setId($id);
$registro = $f->carregar();
?>
<style>
    span {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<form name="fabricant" id="fabricant" method="post" 
      enctype="multipart/form-data">

    <h3>Edição de Fabricante</h3>


    Nome: <br>
    <input name="txtnome" id="txtnome" type="text" maxlength="50" size="40">
    <span>Nome do Fabricante</span>
    <br><br>
    Endereço: <br><input name="txtendereco" id="txtendereco" type="text" maxlength="50" size="40">
    <br><br>
    Data de Fundação: <br>
    <input name="txtdata" id="txtdata" type="text" maxlength="50" size="40">
    <br><br>
    Escolha uma logomarca(jpg ou png):<br>
    <input type="file" name="arquivo" id="arquivo" >
    <br>
    <input type="submit" name="btn" id="btn" value="Enviar">
</form>

<script>
    $("input").focus(function() {
        $(this).next("span").css("display", "inline").fadeOut(1000);
    });
</script>

<?php

if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtendereco']) && !empty($_POST['txtdata'])) {

    extract($_POST, EXTR_OVERWRITE);
    include_once '../class/Fabricante.php';
    $f = new Fabricante();
    $f->setId($id);
    $f->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $f->setEndereco($txtendereco);
    $f->setDatafundacao($txtdata);
    $f->editar();

    echo "<script language='javaScript'>
        window.location.href='?p=fabricante/consultar'
        </script>";
}
?>