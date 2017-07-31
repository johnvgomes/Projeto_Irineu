<?php

include_once '../class/Locais.php';
$l = new Locais();

$id = (int) $_GET['id'];

$l->setId($id);
$registro = $l->carregar();
?>
<style>
    span {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<form name="local" id="a" method="post" enctype="multipart/form-data">

    <h3>Formulário Edição de Locais</h3>


    Nome: <br>
    <input name="txtnome" id="txtnome" type="text" maxlength="50" size="40">
    <span>Nome local</span>
    <br><br>
    Descrição: <br><input name="txtdescricaolocal" id="txtdescricaolocal" type="text" maxlength="50" size="40">
    <span>Descrição do local</span>
    <br><br>
    Telefone: <br>
    <input name="txttelefone" type="text" maxlength="50" size="40">
    <span>Telefone do local</span>
    <br><br>
    Escolha uma Foto(jpg ou png):<br>
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

if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtdescricaolocal']) && !empty($_POST['txttelefone'])) {

    extract($_POST, EXTR_OVERWRITE);
    include_once '../class/Locais.php';
    $l = new Locais();
    $l->setId($id);
    $l->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $l->setDescricao_local($txtdescricaolocal);
    $l->setTelefone($txttelefone);
    $l->editar();

   echo "<script language='javaScript'>window.location.href='?p=locais/consultar'</script>";
}
?>