<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Fabricante {

    private $id;
    private $nome;
    private $endereco;
    private $datafundacao;
    private $logomarca;
    private $temp_logo;
    private $ct;
    private $con;

    function __construct($id = "", $nome = "", $endereco = "", $datafundacao = "", $logomarca = "", $temp_logo = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->datafundacao = $datafundacao;
        $this->logomarca = $logomarca;
        $this->temp_logo = $temp_logo;
        $this->ct = new Controles();
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

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getDatafundacao() {
        return $this->datafundacao;
    }

    public function setDatafundacao($datafundacao) {
        $this->datafundacao = $datafundacao;
    }

    public function getLogomarca() {
        return $this->logomarca;
    }

    public function setLogomarca($logomarca) {
        $this->logomarca = $logomarca;
    }

    public function getTemp_logo() {
        return $this->temp_logo;
    }

    public function setTemp_logo($temp_logo) {
        $this->temp_logo = $temp_logo;
    }

    public function getCt() {
        return $this->ct;
    }

    public function setCt($ct) {
        $this->ct = $ct;
    }

    public function getCon() {
        return $this->con;
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
            $this->ct->enviarArquivo($this->getTemp_logo(), "../logomarca/" . $this->getLogomarca());


            $sql = "INSERT INTO fabricante VALUES (null,?,?,?,?)";


            @$sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getEndereco(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getDatafundacao(), PDO::PARAM_STR);
            @$sqlprep->bindParam(4, $this->getLogomarca(), PDO::PARAM_STR);

            if ($sqlprep->execute() == 1) {
                echo "Cadastro efetuado com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar fabricante "
            . $exc->getMessage();
        }
    }

      public function consultar() {
        try {
            $sql = "SELECT * FROM fabricante";

            $sqlprep = $this->con->query($sql);

            while ($vetor = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<article>
                    $vetor[0]<br>
                    Fabricante: $vetor[1]<br>
                    Endereço: $vetor[2]<br>
                    Data fundação: $vetor[3]<br>
                    <a href='../logomarca/$vetor[4]' download>
                        Confira a o logo do Fabricante                               
                     <a href='?p=Fabricante/excluir&id=$vetor[0]' title='Exclusão fabricante'>
                        <img src='../imagem/icone_deletar.png' alt='Excluir'>
                    </a> 
                    <a href='?p=Fabricante/editar&id=$vetor[0]'
                        title='Editar Fabricante'>
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
        
    public function carregarSelect() {
        try {
            $sql = "SELECT * FROM fabricante ORDER BY nome";

           $sqlprep = $this->con->query($sql);

            while ($registro = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$registro[0]'>$registro[1]</option>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar fabricante "
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
