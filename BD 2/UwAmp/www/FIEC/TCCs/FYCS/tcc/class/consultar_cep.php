<?php
 
$cep = $_POST['txtcep'];
 
$reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);
 
$dados['sucesso'] = (string) $reg->resultado;
$dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;

$dados['cidade']  = (string) $reg->cidade;

 
echo json_encode($dados);
 
?>