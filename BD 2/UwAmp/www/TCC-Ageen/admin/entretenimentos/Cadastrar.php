

<style>
    span {
        display: none;
    }     

</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>



<form name="entretenimento" id="a" method="post" enctype="multipart/form-data">

    <h3>Formulário Cadastro de Entretenimento</h3>


    Nome: <br>
    <input name="txtnome" id="txtnome" type="text" maxlength="50" size="40">
    <span>Nome Entretenimento</span>
    <br><br>
    Descrição: <br><input name="txtdescricaoentretenimento" id="txtdescricaocomunidade" type="text" maxlength="50" size="40">
    <span>Descrição do entretenimento</span>
    <br><br>
    Telefone: <br>
    <input name="txttelefone" type="text" maxlength="50" size="40">
    <span>Telefone do entretenimento</span>
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
if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtdescricaoentretenimento']) && !empty($_POST['txttelefone'])) {

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
        include_once '../class/Entretenimentos.php';
        $e = new Entretenimentos();
        $e->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $e->setDescricao_entretenimento($txtdescricaoentretenimento);
        $e->setTelefone($txttelefone);
        $e->setLogomarca($arquivo);
        $e->setTemp_logo($temp);
        $e->salvar();
    }
}
?>