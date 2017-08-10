<style>
    span {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<form name="depto" id="depto" method="post">
    <h3>Formulário de Departamento</h3>
    
    Nome:<br><input name="txtnome" id="txtnome" 
                 type="text" maxlength="50" size="40" >
    <span>Nome do Depto</span>
    <br><br>
    CPF:<br><input name="txtcpf" id="txtcpf" 
                 type="text" maxlength="14" size="40"
                 onkeypress="MascaraCPF(depto.txtcpf)">
    <span>CPF</span>
    <br><br>
    Nr Funcionários<br> <input type="number" min="1" 
                           name="txtnr" id="txtnr"
                           max="999">
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
    
    $ct = new Controles();
    $d = new Departamento();
    
    $d->setNome(strtr(strtoupper($_POST['txtnome']), 
            "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", 
            "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $d->setNrfuncionarios((int)$_POST['txtnr']);
    
    $d->mostrar();
    //url amigável
    echo "<br><br><hr>"
        .$ct->retirarAcentos($d->getNome());
    //injeção SQL '/\ HAVIJ
    echo "<br><br><hr>"
        .$ct->limparTexto($d->getNrfuncionarios())
        ."<br>Nome "
        .$ct->limparTexto($d->getNome());
    
    if(@$ct->validaCPF($_POST['txtcpf'])){
        echo "<br>CPF válido";
    }else{
        echo "<br>CPF inválido";
    }
}

?>