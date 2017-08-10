<table>
    <form name="formclipf" id="clientepf" method="post">
        <tr>
            <td colspan="2">Cadastro de Cliente</td>
        </tr>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="txtnome" size="50"
                       maxlength="70" id="txtnome"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="txtemail" size="50"
                       maxlength="70" id="txtemail"></td>
        </tr>
		<tr>
            <td>CPF:</td>
            <td><input type="text" name="txtcpf" size="50"
                       maxlength="14" id="txtcpf"
					   onKeyPress="MascaraCPF(formclipf.txtcpf);"></td>
					   
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="btnenviar" 
                                   id="btnenviar" value="enviar dados"></td>

        </tr>

    </form>
</table>

<?php
if (isset($_POST['btnenviar'])) {
    include_once 'class/ClientePF.php';
	include_once 'class/Controles.php';

    //criar um objeto
    $cli = new ClientePF();
	$ct = new Controles();
	
	extract($_POST, EXTR_OVERWRITE);
	
	if(@$ct->validaCPF($txtcpf)){
		//envio de dados via set
		$cli->setNome($txtnome);
		$cli->setEmail($txtemail);
		$cli->setCpf($txtcpf);
    
		//mostrar dados na tela
		$cli->mostrar(); 
	}else{
		echo "<div class='mostrar'>CPF inválido</div>";
	}
}
?>

