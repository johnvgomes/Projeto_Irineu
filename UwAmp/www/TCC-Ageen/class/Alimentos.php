<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Alimentos {

    private $id;
    private $nome;
    private $descricao_alimento;
    private $telefone;
    private $logomarca;
    private $temp_logo;
    private $ct;
    private $con;

    function __construct($id = "", $nome = "", $descricao_alimento = "", $telefone = "", $logomarca = "", $temp_logo = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao_local = $descricao_alimento;
        $this->telefone = $telefone;
        $this->logomarca = $logomarca;
        $this->temp_logo = $temp_logo;
        $this->ct = new Controles();
        $this->con = new Conectar();
    }
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao_alimento() {
        return $this->descricao_alimento;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getLogomarca() {
        return $this->logomarca;
    }

    public function getTemp_logo() {
        return $this->temp_logo;
    }

    public function getCt() {
        return $this->ct;
    }

    public function getCon() {
        return $this->con;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescricao_alimento($descricao_alimento) {
        $this->descricao_alimento = $descricao_alimento;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setLogomarca($logomarca) {
        $this->logomarca = $logomarca;
    }

    public function setTemp_logo($temp_logo) {
        $this->temp_logo = $temp_logo;
    }

    public function setCt($ct) {
        $this->ct = $ct;
    }

    public function setCon($con) {
        $this->con = $con;
    }

    
        public function mostrar() {
        echo "ID: " . $this->getId()
        . "<br>Nome: " . $this->getNome()
        . "<br>Endereço: " . $this->getEndereco()
        . "<br>Data de Fundação: " . $this->getDatafundacao()
        . "<br>Logamarca" . $this->getLogomarca();
    }

    public function salvar() {
        try {
            $this->ct->enviarArquivo($this->getTemp_logo(), "../foto_alimento/" . $this->getLogomarca());


            $sql = "INSERT INTO alimento VALUES (null,?,?,?,?)";


            @$sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getDescricao_alimento(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getTelefone(), PDO::PARAM_STR);
            @$sqlprep->bindParam(4, $this->getLogomarca(), PDO::PARAM_STR);

            if ($sqlprep->execute() == 1) {
                echo "Cadastro efetuado com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar empresa alimenticia "
            . $exc->getMessage();
        }
    }
    
      public function editar() {
        try {
            
            $this->ct->enviarArquivo($this->getTemp_logo(), "../foto_alimento/" . $this->getLogomarca());

            $sql = "UPDATE alimento SET nome = ?, "
                    . "descricao_alimento = ?,"
                    . "telefone = ?,"
                    . "logomarca = ? WHERE id = ?";
             @$sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getDescricao_alimento(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getTelefone(), PDO::PARAM_STR);
            @$sqlprep->bindParam(4, $this->getLogomarca(), PDO::PARAM_STR);
            @$sqlprep->bindParam(5, $this->getId(), PDO::PARAM_INT);
            if ($sqlprep->execute() == 1) {
                echo "Alteração efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao editar alimento "
            . $exc->getMessage();
        }
    }

      public function consultar() {
        try {
            $sql = "SELECT * FROM alimento";

            $sqlprep = $this->con->query($sql);

            while ($vetor = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<article>
                    $vetor[0]<br>
                    Empresa Alimenticia: $vetor[1]<br>
                    Descrição: $vetor[2]<br>
                    Telefone: $vetor[3]<br>
                    <a href='../foto_alimento/$vetor[4]' download>
                        Confira a foto da empresa alimenticia                               
                     <a href='?p=Alimentos/excluir&id=$vetor[0]' title='Exclusão empresa alimenticia'>
                        <img src='../imagem/icone_deletar.png' alt='Excluir'>
                    </a> 
                    <a href='?p=Alimentos/editar&id=$vetor[0]'
                        title='Editar Empresa alimenticia'>
                        <img src='../imagem/icone_editar.png' alt='Edição'>
                        </a>
                </article>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar empresa alimenticia "
            . $exc->getMessage();
        }
    }
     public function excluir(){
             try{
                 $registro = $this->carregar();
                 $this->ct->excluirArquivo("../foto_alimento/".$registro[4]);
                 
                 
                 $sql = "DELETE FROM alimento WHERE id = ?";
                 
                 $sqlprep = $this->con->prepare($sql);
                 @$sqlprep->bindParam(1, $this->getId(), PDO::PARAM_INT);
                 
             if ($sqlprep->execute() == 1){
                 echo "Exclusão efetuada com sucesso";
             }
             }  catch (PDOException $exc) {
                 echo "Erro ao excluir alimento"
                 . $exc->getMessage();
                 
                 
         }
         }
 public function carregar(){
        try {
            
            $sql ="SELECT * FROM alimento WHERE id =?";
            
            $ps = $this->con->prepare($sql);
            @$ps->bindParam(1,$this->getId(),PDO::PARAM_STR);
            $ps->execute();
            
            if ($registro = $ps->fetch(PDO::FETCH_NUM)) {
                return $registro;
                
            }
           
            
        } catch (PDOException $exc) {
            echo "Erro ao carregar empresa alimenticia".$exc->getTraceAsString();
        }
        }
        
    public function carregarSelect() {
        try {
            $sql = "SELECT * FROM alimento ORDER BY nome";

           $sqlprep = $this->con->query($sql);

            while ($registro = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$registro[0]'>$registro[1]</option>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar alimento "
            . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->endereco = null;
        $this->datafundacao = null;
        $this->con = null;
    }

}
