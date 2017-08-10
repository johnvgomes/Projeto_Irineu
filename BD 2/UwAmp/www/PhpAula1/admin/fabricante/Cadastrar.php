<?php ?>

<form name="fabricante" id="fabricante" method="post" enctype="multipart/form-data">
    <h3>Formulário do Fabricante</h3>
    <br><br>
    Nome: <br><input name="txtnome" id="txtnome" type="text" maxlength="50" size="40">
    <br><br>
    Endereço: <br><input name="txtendereco" id="txtendereco" type="text" maxlength="50" size="40">
    <br><br>
    Data de Fundação: <br><input name="txtdata" id="txtdata" type="text" maxlength="50" size="40">
    <br><br>
    Escolha uma logomarca(jpg ou png):<br>
    <input type="file" name="arquivo" id="arquivo" >
    <br><br>
    <input type="submit" name="btn" id="btn" value="Enviar">
</form>

<script>
    $("input").focus(function() {
        $(this).next("span").css("display", "inline").fadeOut(1000);
    });
</script>

<?php
if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtendereco']) && !empty($_POST['txtdata'])) {

    $arquivo = $_FILES['arquivo']['name'];
    $temp = $_FILES['arquivo']['tmp_name'];

    extract($_POST, EXTR_OVERWRITE);
    //extensões permitidas
    $extensoes = array(".jpg", ".png", ".jpeg");
    //extração da extensão do arquivo escolhido
    $ext = strtolower(substr($arquivo, -4));
    if ($ext == "jpeg") {
        $ext = ".jpeg";
    }

    if (in_array($ext, $extensoes)) {
        include_once '../class/Fabricante.php';
        $f = new Fabricante();
        $f->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $f->setEndereco($txtendereco);
        $f->setDatafundacao($txtdata);
        $f->setLogomarca($arquivo);
        $f->setTemp_logo($temp);
        $f->salvar();
    }
}
?>