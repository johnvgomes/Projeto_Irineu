<?php

class MySQL {
	private $host = "186.202.152.55";
        //private $host = "localhost";
        private $usuario = "site1371059233";
	//private $usuario = "root";
	private $senha = "E1981Adm11";
        //private $senha = "";
	private $db   = "site1371059233";
        //private $db   = "novosite";
	private $query;
	private $link;
	private $result;
	
	public function __construct(){
	}  
	
	public function conectar(){
		$this->link = mysql_connect($this->host,$this->usuario,$this->senha);
		
		if(!$this->link){
			echo "Erro na Conexão.<br /><strong>MySQL retornou: </strong> "
			.mysql_error()."<br />";
			die();
		} elseif(!mysql_select_db($this->db,$this->link)){
			echo "Erro na seleção do Banco de Dados.<br /><strong>MySQL retornou: </strong> ".mysql_error()."<br />";                        
			die();
		}
	}   
			
	public function sql($query){               
		$this->conectar();                
		$this->query = $query;               
		if($this->result = mysql_query($this->query)){
			$this->desconectar();
			return $this->result;
		} else {
			die("Ocorreu um erro ao executar a Query SQL abaixo:<br />$query<<br /><br /><strong>MySQL Retornou: ".mysql_error()."</strong>");
			$this->desconectar();
		}
	}
		
	public function desconectar(){
		return mysql_close($this->link);
	}
}

class Conectar{
	public $resultado;
	private $mysql;
	
	public function executar($query){
		$this->mysql = new MySQL;
		$this->resultado = $this->mysql->sql($query);
		return $this->resultado;
	}
}

?>