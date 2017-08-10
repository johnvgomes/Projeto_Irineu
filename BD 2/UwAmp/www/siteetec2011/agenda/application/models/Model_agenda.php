<?php

class Model_agenda extends Model
{
    // Nome da tabela trabalhada nesse modelo

    private $_tabela = "agenda";
    
    // Retorna todos os contatos
    
    public function getAll()
    {
        return $this->db->select("SELECT * FROM {$this->_tabela} ORDER BY nome");
    }

    // Retorna um contato em particular
    
    public function getByid($id)
    {
        $id = (int) $id;
        
        return $this->db->select("SELECT * FROM {$this->_tabela} WHERE id = :id", array(':id' => $id), FALSE);
    }
    
    // Retorna contatos a partir de uma pesquisa
    
    public function getLike($busca)
    {
        return $this->db->select("SELECT * FROM {$this->_tabela} WHERE nome LIKE :busca", array(':busca' => $busca));  
    }
    
    // Remove um contato
    
    public function remove($id)
    {
        $id = (int) $id;
        
        return $this->db->delete($this->_tabela, "id = '$id'");
    }
    
    // Cadastrar
    
    public function cadastrar($contato = array())
    {
        // Processa o cadastro
        return $this->db->insert($this->_tabela, $contato);
    }
    
    // Atualizar
    
    public function atualizar($contato, $id)
    {
        // Monta a cláusula Where 
        $where = "id = " . (int) $id;
        
        // Executa a operação
        return $this->db->update($this->_tabela, $contato, $where);
    }
}