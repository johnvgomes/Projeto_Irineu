<?php

class Model_usuario extends Model
{
    // Nome da tabela trabalhada nesse modelo
    
    private $_tabela = "usuarios";
    
    // Valida se o usuário possui cadastro no site
    
    public function validaUsuario($email, $senha)
    {
        // Os dados de login estão em branco ou e-mail está incorreto?
        if( 
            Common::validarEmBranco($email) || 
            Common::validarEmBranco($senha) || 
            !Common::validarEmail($email)
        )
        {
            return "Preencha corretamente os dados.";
        }  
        
        // Usuário foi encontrado no banco de dados?
        $where = array(
            ':email' => $email,
            ':senha' => md5($senha)
        );
        
        $encontrou = $this->db->select("SELECT id FROM {$this->_tabela} WHERE email = :email AND senha = :senha", $where);
        
        if( $encontrou )
        {
            return TRUE;
        }
        else
        {
            return "Sua conta não foi encontrada no sistema.";
        }
    }
}
