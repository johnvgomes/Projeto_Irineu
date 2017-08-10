<?php
if(isset($_POST['btnenviar'])){
	extract($_POST, EXTR_OVERWRITE);
	$mensagem = "Mensagem enviada em ".date("d/m/Y");
	$mensagem .= "<br> Nome: ".$txtnome;
	$mensagem .= "<br> Email: ".$txtemail;
	$mensagem .= "<br> Mensagem: ".$txtmsg;

	$cabecalho = "MIME-Version: 1.1\n";
	$cabecalho = "Content-Type: text/html; charset=utf-8\n";
	$cabecalho = "From: ".$txtemail."\n";
	$cabecalho = "Return-Path: ".$txtemail."\n";
	$cabecalho = "Reply-To: ".$txtemail."\n";

	$enviada = mail("edilson_.sa@hotmail.com", "[MendAPP]", "$mensagem, $cabecalho, $txtemail");

	if($enviada){
		echo "Sua mensagem enviada com sucesso, ".$txtnome.", Obrigado!";	
	}
	else{
		echo "Mensagem não enviada com sucesso";		
	}

}
?>