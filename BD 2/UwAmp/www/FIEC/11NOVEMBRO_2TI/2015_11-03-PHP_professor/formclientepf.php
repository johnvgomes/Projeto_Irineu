<style>
    span {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<table>
    <form name="formcliente" id="formcliente" method="post">
        <tr>
            <td colspan="2">Cadastro de Cliente P.F.</td>
        </tr>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="txtnome" size="50"
                       maxlength="70" id="txtnome"> <span>Nome do Cliente</span></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="txtemail" size="50"
                       maxlength="70" id="txtemail"> <span>Email do Cliente</span></td>
        </tr>
        <tr>
            <td>CPF:</td>
            <td><input type="text" name="txtcpf" size="50"
                       maxlength="14" id="txtcpf"
                       onBlur="ValidarCPF(formcliente.txtcpf);" 
                       onKeyPress="MascaraCPF(formcliente.txtcpf);"> <span>CPF do Cliente</span></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="btnenviar" 
                                   id="btnenviar" value="enviar dados"></td>
        </tr>
    </form>
</table>

<script>
    $("input").focus(function() {
        $(this).next("span").css("display", "inline").fadeOut(1000);
    });
</script>

<?php
if (isset($_POST['btnenviar'])) {
    include_once 'class/ClientePF.php';
    include_once 'class/Controles.php';

    $ct = new Controles();

    extract($_POST, EXTR_OVERWRITE);

    if (@$ct->validaCPF($txtcpf)) {
        $cli = new ClientePF();

        $cli->setNome($txtnome);
        $cli->setEmail($txtemail);
        $cli->setCpf($txtcpf);
        
        $cli->salvar();

        $cli->mostrar();
    } else {
        echo "<div class='mostrar'>Preencha um CPF válido!</div>";
    }
}
?>

