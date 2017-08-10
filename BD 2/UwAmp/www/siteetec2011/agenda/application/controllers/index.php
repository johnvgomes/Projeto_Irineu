<?php

/**
 * Controlador 'index' da aplicação.
 */

class Index extends Controller
{
    // Construtor
    
    public function __construct()
    {
        // Executa o construtor do pai ( 'TW_Controller' )
        parent::__construct();
        
        // O usuário não está logado?
        if( !Session::get("logado") )
        {
            Session::destroy(); // Destrói a sessão
            Common::redir('login');
        }
        
        // Carrega o modelo
        $this->loadModel('Model_agenda', 'agenda');    
    }
    
    // Método main
    
    public function main($busca="")
    {
        $busca = strip_tags($busca);
        
        if( $busca=="" )
        {
            // Recupera todos os contatos a partir do modelo
            $dados["contatos"] = $this->agenda->getAll();  
        }
        else
        {
            // Recupera os contatos com um WHERE LIKE do termo pesquisado
            $dados["contatos"] = $this->agenda->getLike($busca);   
            
            // Armazena a pesquisa em uma sessão, para que ela fique no input de busca depois da pesquisa
            Session::set("busca-termo", $busca);
        }

        // Carrega a View index
        $this->loadView("index/index", $dados);
    }
    
    // Logout
    
    public function logout()
    {
        // Destrói a sessão
        Session::destroy();
        
        // Redireciona o usuário para a index
        Common::redir('index');
    }    
}