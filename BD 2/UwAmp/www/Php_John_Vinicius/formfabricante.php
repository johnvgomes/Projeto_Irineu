<style>
    span {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<form name="fabricante" id="fabricante" method="post">    
    <h3>Formulário de Fabricante</h3>
    
    Nome:<br>
    <input name="txtnome" id="txtnome" size="40"
           maxlength="50" type="text">
    <span>Nome do fabricante</span>
    <br><br>
    Endereço:<br>
    <input name="txtendereco" id="txtendereco" size="40"
           maxlength="50" type="text">
    <span>Endereço do fabricante</span>
    <br><br>
    Data de Fundação:<br>
   <input name="txtdata" id="txtdata" size="40"
           maxlength="50" type="text">
    <span>Data de Fundação</span>
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

if(isset($_POST['btn'])
        && !empty($_POST['txtnome'])
        && !empty($_POST['txtendereco'])
        && !empty($_POST['txtdata'])){
    include_once 'class/Fabricante.php';
    include_once 'class/Controles.php';
    
    $f = new Fabricante();
    $ct = new Controles();
    
    $f->setNome(strtr(strtoupper($_POST['txtnome']), 
            "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", 
            "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    
    $f->setEndereco(strtr(strtoupper($_POST['txtendereco'])));
    
    $f->setDatafundacao(strtr(strtoupper($_POST['txtdata'])));
    
    $f->mostrar();
    
    }

?>
