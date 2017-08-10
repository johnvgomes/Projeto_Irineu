<?php

//ClientePF.php
include_once "Cliente.php";
//subclass - classe filha
class ClientePF extends Cliente{
	private $cpf;
	
	public function __construct($id="",
				$nome="",$email="",$cpf=""){
		$this->cpf = $cpf;
		parent::__construct($id,$nome,$email);
	}
	
	public function getCpf(){
		return $this->cpf;
	}
	
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	
	public function mostrar(){
		echo "<div class='mostrar'>".parent::mostrar() 
			."<br>".$this->getCpf()."</div>";
	}
	
	public function __destruct(){
		$this->cpf = null;
		parent::__destruct();
	}

}

?>