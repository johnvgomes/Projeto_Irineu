

<style>
    span {
        display: none;
    }     

</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>



<form name="alimento" id="a" method="post" enctype="multipart/form-data">

    <h3>Formulário Cadastro de Empresa Alimentos</h3>


    Nome: <br>
    <input name="txtnome" id="txtnome" type="text" maxlength="50" size="40">
    <span>Nome Empresa Alimenticia</span>
    <br><br>
    Descrição: <br><input name="txtdescricaoalimento" id="txtdescricaoalimento" type="text" maxlength="50" size="40">
    <span>Descrição dos Alimentos</span>
    <br><br>
    Telefone: <br>
    <input name="txttelefone" type="text" maxlength="50" size="40">
    <span>Telefone Empresa Alimenticia</span>
    <br><br>
    Escolha uma foto(jpg ou png):<br>
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
if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtdescricaoalimento']) && !empty($_POST['txttelefone'])) {

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
        include_once '../class/Alimentos.php';
        $a = new Alimentos();
        $a->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $a->setDescricao_alimento($txtdescricaoalimento);
        $a->setTelefone($txttelefone);
        $a->setLogomarca($arquivo);
        $a->setTemp_logo($temp);
        $a->salvar();
        
        //echo "$txtnome<br>$txtdescricaoalimento<br>$txttelefone<br>$arquivo<br>$temp";
    }
    
}
?>