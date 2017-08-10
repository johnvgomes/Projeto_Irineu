<?php

/**
 * 'Bootstrap' da aplicação
 */

// Configurações da aplicação
require_once('config.php'); 

// Carregamento automático dos arquivos PHP das classes
function __autoload($classe)
{
    $arquivo = SITE_PATH . 'system/' . $classe . '.php';
            
    if( !file_exists($arquivo) )
    {
        $arquivo = CONTROLLER_PATH . '/' . $classe . '.php'; 
    }
    
    require_once($arquivo);
}

// Executa o router que escolhe qual controlador acionar
try
{
    // Executa o roteador
    Router::run(new Request());
}
catch(Exception $e)
{
    // Alguma exceção foi lançada pelo roteador?
    new error($e->getMessage());
}