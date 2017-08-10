<?php

/**
 * Controlador responsável pelo formulário de login da aplicação
 */

class Login extends Controller
{
    // Construtor
    
    public function __construct()
    {
        parent::__construct();
        
        // Usuário já está logado? Então redireciona para a index
        if( Session::get("logado") )
        {
            Common::redir('index');
        }     
        
        // Acessa o modelo para login
        $this->loadModel('Model_usuario', 'usuario');         
    }
    
    // Main
    
    public function main()
    {
        // Abre a view de login
        $this->loadView("login/index");
    }
    
    // Processa o Login
    
    public function processar()
    {
        $logar = $this->usuario->validaUsuario($_POST["input-email"], $_POST["input-senha"]);
        
        if( $logar!==TRUE )
        {
            // Cria uma sessão com a identificação do erro
            Session::set("erro-login",$logar);
            
            // Redir para a página de login
            Common::redir('login');
        }
        else
        {
            // Usuário logado com sucesso. Cria a sessão que identifica que ele está logado
            Session::set("logado",TRUE);
            
            // Redireciona para a index
            Common::redir('index');          
        }
    }
}