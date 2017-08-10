<?php
/* Importa o arquivo onde a função de upload está implementada */
require_once('funcao_upload.php');

/* Captura o arquivo selecionado */
$arquivo = $_FILES['arquivo'];

$rm = $_POST['rm'];

/*Define os tipos de arquivos válidos (No nosso caso, só imagens)*/
$tipos = array('jpg', 'png', 'gif', 'psd', 'bmp', 'jpeg');

/* Chama a função para enviar o arquivo */
$enviar = uploadFile($arquivo, 'fotos/', $tipos, $rm);

$data['sucesso'] = true;

if($enviar['erro']){    
    $data['msg'] = $enviar['erro'];
}
else{
    $data['sucesso'] = true;
    
    /* Caminho do arquivo */
    $data['msg'] = $enviar['caminho'];
}

/* Codifica a variável array $data para o formato JSON */
echo json_encode($data);