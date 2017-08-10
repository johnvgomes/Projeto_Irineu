<?php
$nome=$_POST["nome"];
$email=$_POST["email"];
$msg=$_POST["msg"];

$enviada = mail("edilson_.sa@hotmail.com", "[MENDAPP]", "Nome:$nome, Email:$email, Mensagem:$msg", "" ,
	"-rcontato@mendapp.com.br");
if($enviada){
	echo "Mensagem enviada com sucesso";	
}
else{
	echo "Mensagem não enviada com sucesso";		
}

?>