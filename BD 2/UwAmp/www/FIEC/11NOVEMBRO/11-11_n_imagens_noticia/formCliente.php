<!--Salvar na raiz como formCliente.php-->
<form name="formCliente" id="form" method="post" action="">
	<label>Nome:</label>
    <input type="text" name="txtnome"><br>
    <label>Email:</label>
    <input type="email" name="txtemail"><br>
    <label>ID:</label>
    <input type="number" name="txtid"><br>
    
    <input type="submit" name="btnenviar" value="Enviar">
</form>
<?php
if(isset($_POST['btnenviar'])){
	extract($_POST,EXTR_OVERWRITE);
	
	include_once 'class/Cliente.php';
	$cli = new Cliente();
	//$cli = new Cliente($txtid,$txtnome,$txtemail);
	$cli->setNome($txtnome);
	$cli->setEmail($txtemail);
	$cli->setId($txtid);
	
	$mensagem = "<h3>".$cli->getNome()."</h3>";
	$mensagem .= "<p>".$cli->getId() ." - ". $cli->getEmail()."</p>";
	
	echo $mensagem;
	
}


?>
