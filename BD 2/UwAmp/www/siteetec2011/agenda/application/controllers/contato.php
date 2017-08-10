<?php

/**
 * Controlador responsável pelo cadastro de contatos
 */

class Contato extends Controller
{
    // Construtor
    
    public function __construct()
    {
        parent::__construct();
        
        // O usuário não está logado?
        if( !Session::get("logado") )
        {
            Session::destroy(); // Destrói a sessão
            Common::redir('login');
        }        
        
        // Carrega o modelo de agenda
        $this->loadModel('Model_agenda', 'agenda');          
    }
    
    // Main
    
    public function main()
    {
        $dados["urlAction"] = SITE_URL . "/contato/cadastrar";
        $dados["pageDesc"] = "Cadastro de contato";   
        $dados["submitDesc"] = "Cadastrar contato";          
        
        $this->loadView("contato/index", $dados);
    }
    
    // Cadastrar
    
    public function cadastrar()
    {
        $contato = array(
            'nome' => $_POST["input-nome"],
            'telefone' => $_POST["input-telefone"],
            'celular' => $_POST["input-celular"],
            'email' => $_POST["input-email"]
        );
        
        // Cadastrar 
        
        $id = $this->agenda->cadastrar($contato);
        
        if( $id )
        {
            // Cria as sessões que detalham o sucesso do cadastro
            Session::set("cadastro", TRUE);
            Session::set("cadastro-class", "alert-success");
            Session::set("cadastro-msg", "Cadastro realizado com sucesso =)");
            
            // Redir para a página de edição de contato
            Common::redir('contato/exibir/' . $id);          
        }
        else
        {
            // Cria as sessões que detalham o erro do cadastro
            Session::set("cadastro", TRUE);
            Session::set("cadastro-class", "alert-error");
            Session::set("cadastro-msg", "Por algum motivo não foi possível realizar esse cadastro.");
            
            // Redir para a página de contato
            Common::redir('contato');
        }
    }
    
    // Editar contato
    
    public function exibir($id=0)
    {
        // Armazena o array com os dados do contato na variável que será enviada para a View
        $dados["contato"] = $this->agenda->getByid($id); 
        
        // Esse contato realmente existe?
        
        if( $dados["contato"] )
        {
            // URL de POST para a atualização do contato
            $dados["urlAction"] = SITE_URL . "/contato/atualizar/" . $id;
            
            $dados["pageDesc"] = 'Visualização de "'.$dados["contato"]["nome"].'"';   
            $dados["submitDesc"] = "Salvar modificações";   
        
            // Abre a view que exibe os contatos e passa os dados para ela
            $this->loadView("contato/index", $dados);    
        }
        else
        {
            // O contato não existe, volta para a index.
            Common::redir('index');         
        }
    }
    
    // Atualizar
    
    public function atualizar($id=0)
    {
        $contato = array(
            'nome' => $_POST["input-nome"],
            'telefone' => $_POST["input-telefone"],
            'celular' => $_POST["input-celular"],
            'email' => $_POST["input-email"]
        );
        
        // Cadastrar 
        
        $resultado = $this->agenda->atualizar($contato, $id);
        
        if( $resultado )
        {
            // Cria as sessões que detalham o sucesso do cadastro
            Session::set("cadastro", TRUE);
            Session::set("cadastro-class", "alert-success");
            Session::set("cadastro-msg", "Dados atualizado com sucesso! =)");
            
            // Redir para a página de edição de contato
            Common::redir('contato/exibir/' . $id);          
        }
        else
        {
            // Cria as sessões que detalham o erro do cadastro
            Session::set("cadastro", TRUE);
            Session::set("cadastro-class", "alert-error");
            Session::set("cadastro-msg", "Por algum motivo não foi possível atualizar esse registro.");
            
            // Redir para a página de contato
            Common::redir('contato/exibir/' . $id); 
        }   
    }
    
    // remover
    
    public function remover($id)
    {
        if( $this->agenda->remove($id) )
        {
            // Cria a sessão para exibir a mensagem de remoção realizada
            Session::set("remove-ok", TRUE);
        }
        
        // Redireciona
        Common::redir('index');   
    }    

    // Novo
    
    public function novo()
    {
        // Executa o método main 
        
        $this->main();
    }
}