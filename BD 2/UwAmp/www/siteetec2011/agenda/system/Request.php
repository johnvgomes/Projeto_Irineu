<?php

/**
* Classe responsável por obter os segmentos da URL informada
*
* @author TreinaWeb
* @access public
*/

class Request
{
    private $_controlador = "index";
    private $_metodo = "main";
    private $_args = array();

    /**
    * Método construtor
    * @access public
    * @return void
    */
    
    public function __construct()
    {
        // Algum controlador foi informado na URL? se não foi, mantêm que o controlador é o 'index'.
        if( !isset($_GET["url"]) ) return false;
        
        // Explode os segmentos da URL e os armazena em um Array
        $segmentos = explode('/',$_GET["url"]);
        
        // Se o controlador foi realmente definido, retorna o nome dele.
        $this->_controlador = ($c = array_shift($segmentos)) ? $c : 'index';
        
        // Se um método foi realmente requisitado, retorna o nome dele.
        $this->_metodo = ($m = array_shift($segmentos)) ? $m : 'main';
        
        // Se argumentos adicionais foram definidos, os retorna em Array.
        $this->_args = (isset($segmentos[0])) ? $segmentos : array();
    }
    
    /**
    * Retorna o nome do controlador
    * @access public
    * @return String
    */    
    
    public function getControlador()
    {
        return $this->_controlador;
    }
    
    /**
    * Retorna o nome do método
    * @access public
    * @return String
    */  
    
    public function getMetodo()
    {
        return $this->_metodo;
    }
    
    /**
    * Retorna os segmentos adicionais (argumentos)
    * @access public
    * @return Array
    */  
    
    public function getArgs()
    {
        return $this->_args;
    }
}