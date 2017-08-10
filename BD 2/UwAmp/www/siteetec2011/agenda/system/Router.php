<?php

/**
* Roteador. Responsável por incluir o controlador e executar o seu respectivo método informado
*
* @author TreinaWeb
* @access public
*/

class Router
{
    /**
    * Método responsável por obter o nome do controlador e do método e executá-los.
    * @access public
    * @return void
    */
    
    public static function run(Request $request)
    {
        // Obtêm os segmentos da URL a partir do objeto $request
        $controlador = $request->getControlador();
        $metodo = $request->getMetodo();
        $args = $request->getArgs();
        
        // Monta o caminho do controlador para inclusão
        $arquivo = CONTROLLER_PATH . "/" . $controlador .'.php';

        // Controlador existe?
        if( file_exists($arquivo) )
        {
            // Require no controlador
            require_once( $arquivo );
            
            // Instancia o controlador para que o método main ou outro seja executado
            if (class_exists($controlador))
            {
                $controlador = new $controlador();
            }
            else
            {
                // Encontrou o arquivo do controlador mas o nome da classe não corresponde?
                self::error("Classe - A classe '" . $controlador . "' não foi encontrada!");  
            }          
            
            // O método informado na URL existe na classe? Se sim, use-o, caso contrário, dispare um erro.
            if( !is_callable(array($controlador,$metodo)) )
            {
                self::error("Método - O método '" . $request->getMetodo() . "' não foi encontrado!");
            }
            
            // Argumentos adicionais foram informados? Se sim, envie-os para o método chamado
            if(!empty($args))
            {
                // Chama o método passado pra ele os argumentos adicionais
                call_user_func_array(array($controlador,$metodo),$args);
            }
            else
            {
                // Chama o método sem passar argumentos adicionais
                call_user_func(array($controlador,$metodo));
            }
            
        }
        else
        {
            // Controlador não encontrado, lança a exceção
            self::error("404 - A página '" . $request->getControlador() . "' não foi encontrada!");
        }
    }
    
    // Error 
    
    protected static function error($msg)
    {
        throw new Exception($msg);
    }
}