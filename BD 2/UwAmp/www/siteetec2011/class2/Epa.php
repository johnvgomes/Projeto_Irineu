<?php

require_once 'Conectar.php';
require_once 'Entity.php';

class Epa extends Entity{
	
    private $nome;
    private $email;
    private $telefone;
    private $escola;
    private $con;

    public function __construct($n="",$em="",$t="",$es=""){
        $this->nome=$n;
        $this->email=$em;
        $this->telefone=$t;
        $this->escola=$es;
        $this->controles = new Controles();
        $this->con = new Conectar();
    }
    
    public function cadastrar(){      
        $this->con->executar("INSERT INTO epa VALUES (null,
            '".$this->getNome()."',
            '".$this->getEmail()."',
            '".$this->getTelefone()."',
            '".$this->getEscola()."')");	
    }

    public function consultar(){
        $sql = $this->con->executar("SELECT * FROM epa ORDER BY nome");
        echo "<table><tr><td colspan='3'><h3>Consulta do Cadastro EPA-ETEC ".  date('Y')."</h3></td></tr>
            <tr><td>Nome</td><td>Email</td><td>Telefone</td></tr>";
        while ($linhas = mysql_fetch_row($sql)){
            echo "
            <tr><td>Nome: ".$linhas[1]." | ".$linhas[4]."</td>
            <td>Email: ".$linhas[2]."</td>
            <td>Email: ".$linhas[2]."</td>
            </td>
           </tr>
            ";
        }
        echo "</table>";
    }
    
    public function consultarAdm(){
        $sql = $this->con->executar("SELECT * FROM epa ORDER BY nome");
        echo "<table><tr><td colspan='4'><h3>Consulta do Cadastro EPA-ETEC ".  date('Y')."</h3></td></tr>
            <tr><td>Nome</td><td>Email</td><td>Telefone</td><td>[excluir]</td></tr>";
        while ($linhas = mysql_fetch_row($sql)){
            echo "
            <tr><td>Nome: ".$linhas[1]." | ".$linhas[4]."</td>
            <td>Email: ".$linhas[2]."</td>
            <td>Email: ".$linhas[2]."</td>
            </td>
            <td>
                <a href='?p=cadastro/excluir.php&id=".$linhas[0]."' target='_self'>[Excluir]</a>
            </td>
            </tr>
            ";
        }
        echo "</table>";
    }

    public function excluir($id){
            $this->con->executar("DELETE FROM epa WHERE id = '$id'");
    }   
   
    public function __destruct(){
        $this->titulo="";
        $this->conteudo="";
        $this->data="";
        $this->horario="";
        $this->eixo="";
        $this->controles = "";
        $this->con = "";
    }

}
