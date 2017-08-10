<?php


if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
<style>
    span {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<form name="depto" id="depto" method="post" 
      enctype="multipart/form-data">

    <h3>Cadastro de Departamento</h3>

    Nome<br>
    <input name="txtnome" id="txtnome" size="40"
           maxlength="50" type="text">
    <span>Nome do depto</span>
    <br><br>
    Nr Funcionários<br>
    <input name="txtnr" id="txtnr" type="number"
           min="1" max="999">
    <br><br>
    Escolha um arquivo (pdf ou doc):<br>
    <input type="file" name="arquivo" id="arquivo">
    <br><br>
    <input type="submit" name="btn" id="btn"
           value="enviar">    
</form>

<script>
    $("input").focus(function() {
        $(this).next("span").css("display", "inline").fadeOut(1000);
    });
</script>

<?php
if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtnr'])) {

    $arquivo = $_FILES['arquivo']['name'];
    $temp = $_FILES['arquivo']['tmp_name'];

    extract($_POST, EXTR_OVERWRITE);
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
        $d->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $d->setNrfuncionarios((int) $txtnr);
        $d->setPlanta($novonome);
        $d->setTemp_planta($temp);
        $d->salvar();
        
        //cadastrar imagens
        
    }
}
}
?>