<style>
    span {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<form name="depto" id="depto" method="post" >
    
    <h3>Formulário de Departamento</h3>
    
    Nome<br>
    <input name="txtnome" id="txtnome" size="40"
           maxlength="50" type="text">
    <span>Nome do depto</span>
    <br><br>
    CPF<br>
    <input name="txtcpf" id="txtcpf" size="40"
           maxlength="14" type="text"
           onkeypress="MascaraCPF(depto.txtcpf);">
           <span>CPF</span>
    <br><br>
    Nr Funcionários<br>
    <input name="txtnr" id="txtnr" type="number"
           min="1" max="999">
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

if(isset($_POST['btn']) && !empty($_POST['txtnome'])
        && !empty($_POST['txtnr'])){
    include_once 'class/Departamento.php';
    include_once 'class/Controles.php';
    
    $d = new Departamento();
    $ct = new Controles();
    
    $d->setNome(strtr(strtoupper($_POST['txtnome']), 
            "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", 
            "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $d->setNrfuncionarios((int)$_POST['txtnr']);
    
    $d->mostrar();
    
    //auxilia na url amigável
    echo "<br><hr>"
        .$ct->retirarAcentos($d->getNome());
    
    //injeção SQL / SQL injection - HAVIJ
    //OR DIE 
    echo "<br><hr>"
        .$ct->limparTexto($d->getNome());
    
    if(@$ct->validaCPF($_POST['txtcpf'])){
        echo "<br>CPF válido";
    }else{
        echo "<br>CPF inválido";
    }
    
}

?>