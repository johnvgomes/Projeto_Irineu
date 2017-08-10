<?php

//Cliente.php
class Cliente{
	
	private $id;
	private $nome;
	private $email;
	
	public function __construct($id, $nome, $email) {
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
        }
        
        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setEmail($email) {
            $this->email = $email;
        }
        
        public function __destruct(){
		$this->id = "";
		$this->nome = "";
		$this->email = "";
	}
	
	
}

?>