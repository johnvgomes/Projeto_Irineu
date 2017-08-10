<?php

include_once 'Conectar.php';

class Funcionario {

    private $id;
    private $nome;
    private $salario;
    private $id_depto;
    private $con;

    public function __construct() {
        $this->con = new Conectar();
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSalario() {
        return $this->salario;
    }

    public function setSalario($salario) {
        $this->salario = $salario;
    }

    public function getId_depto() {
        return $this->id_depto;
    }

    public function setId_depto($id_depto) {
        $this->id_depto = $id_depto;
    }

    public function salvar() {
        try {
            $sql = "INSERT INTO funcionario VALUES (null,?,?,?)";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getSalario(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getId_depto(), PDO::PARAM_INT);
            if ($sqlprep->execute() == 1) {
                echo "Cadastro efetuado com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar funcionário "
            . $exc->getMessage();
        }
    }
 public function consultar() {
        try {
            $sql = "SELECT * FROM funcionario";

            $sqlprep = $this->con->query($sql);

            while ($vetor = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<article>
                    $vetor[0]<br>
                    Funcionário: $vetor[1]<br>
                    Salário: $vetor[2]<br>
                    ID Departamento: $vetor[3]<br>   
                     <a href='?p=funcionario/excluir&id=$vetor[0]' title='Exclusão funcionário'>
                        <img src='../imagem/icone_deletar.jpg' alt='Excluir'>
                    </a> 
                    <a href='?p=funcionario/editar&id=$vetor[0]'
                        title='Editar Funcionario'>
                        <img src='../imagem/icone_editar.png' alt='Edição'>
                        </a>
                </article>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar depto "
            . $exc->getMessage();
        }
    }
     public function excluir(){
             try{
                 $registro = $this->carregar();
                 $this->ct->excluirArquivo("../Logomarca/".$registro[3]);
                 
                 
                 $sql = "DELETE FROM fabricante WHERE id = ?";
                 
                 $sqlprep = $this->con->prepare($sql);
                 @$sqlprep->bindParam(1, $this->getId(), PDO::PARAM_INT);
                 
             if ($sqlprep->execute() == 1){
                 echo "Exclusão efetuada com sucesso";
             }
             }  catch (PDOException $exc) {
                 echo "Erro ao excluir fabricante"
                 . $exc->getMessage();
                 
                 
         }
         }
 public function carregar(){
        try {
            
            $sql ="SELECT * FROM fabricante WHERE id =?";
            
            $ps = $this->con->prepare($sql);
            $ps->bindParam(1,$this->getId(),PDO::PARAM_STR);
            $ps->execute();
            
            if ($registro = $ps->fetch(PDO::FETCH_NUM)) {
                return $registro;
                
            }
           
            
        } catch (PDOException $exc) {
            echo "Erro ao carregar fabricante".$exc->getTraceAsString();
        }
        }
    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->salario = null;
        $this->id_depto = null;
        $this->con = null;
    }

}

?>
