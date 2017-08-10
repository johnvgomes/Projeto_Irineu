<?php

/**
* Controlador base. Ele é estendido por todos os controladores da aplicação
*
* @author TreinaWeb
* @access public
*/

class Controller
{
    protected $session;

    /**
    * Método construtor
    * @access public
    * @return void
    */
    
    public function __construct()
    {
        // Inicializa a sessão
        Session::inicializar();
    }
  
    /**
    * Carrega uma View.
    * @access public
    * @param String $nome Nome da view a ser carregada.
    * @param Array $vars Array de dados a serem 'enviados' para a View.
    * @return Void
    */

    protected function loadView( $nome, $vars = null )
    {
        // Exporta os dados do Array para variáveis. Semelhante às "variáveis variáveis".
        if( is_array($vars) && count($vars) > 0 )
        {
            // Extrai as variáveis
            extract($vars, EXTR_PREFIX_SAME, 'data');
        }

        // Caminho para o respectivo arquivo dessa View
        $arquivo = VIEW_PATH . '/' . $nome . '.phtml';

        // O arquivo existe?
        if ( !file_exists($arquivo) )
        {
            // Não existe, então lança uma exceção.
            $this->error("Houve um erro. Essa View {$nome} nao existe.");
        }

        // Inclui o arquivo
        require_once( $arquivo );
    }    

    /**
    * Carrega um modelo.
    * @access public
    * @param String $nome Nome do modelo a ser carregado.
    * @param String $apelido 'Apelido' para o modelo
    * @return Void
    */

    protected function loadModel( $nome, $apelido="" )
    {
        // Caminho do arquivo deste modelo
        $arquivo = MODEL_PATH . '/' . $nome . '.php';

        // O arquivo existe?
        if ( !file_exists($arquivo) )
        {
            // Dispara o erro
            $this->error("Houve um erro. Esse Model {$nome} não existe.");
        }

        // Inclui o arquivo do modelo
        require_once( $arquivo );

        // Nome da classe do modelo
        $classe_nome = ucfirst($nome);
        
        // Essa classe realmente existe nesta execução?
        if ( class_exists($classe_nome) ) 
        {
            // Cria dinamicamente uma propriedade com a instância desse modelo (objeto)
            $this->$classe_nome = new $classe_nome();
        
            // Apelido foi definido?
            if( $apelido!="" )
            {
                // Também cria uma propriedade com o apelido definido para o modelo que referencia o objeto '$classe_nome' criado anteriormente
                $this->$apelido =& $this->$classe_nome;
            }
        }
        else
        {
            // A classe não existe? Dispara o erro.
            $this->error("A classe {$classe_nome} não foi encontrada no modelo {$nome}");
        }
    }  
    
    /**
    * Dispara um erro.
    * @access protected
    * @param String $msg Mensagem do erro.
    * @return Void
    */
    
    protected function error($msg)
    {
        // Dispara o erro
        throw new Exception($msg);
    }    
}
