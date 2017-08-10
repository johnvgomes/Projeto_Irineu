<?php
include_once 'Conectar.php';

class Produto {

//ATRIBUTOS, CONSTRUTOR, DESTRUTOR, GETS, SETS E SALVAR
    
private $id;
    private $nome;
    private $valorunit;
    private $estoque;
    private $id_fabricante;
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

    public function getValorunit() {
        return $this->valorunit;
    }

    public function setValorunit($valorunit) {
        $this->valorunit = $valorunit;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    public function getId_fabricante() {
        return $this->id_fabricante;
    }

    public function setId_fabricante($id_fabricante) {
        $this->id_fabricante = $id_fabricante;
    }

    public function getCon() {
        return $this->con;
    }

    public function setCon($con) {
        $this->con = $con;
    }

 public function salvar() {
        try {
            $sql = "INSERT INTO produto VALUES (null,?,?,?,?)";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getValorunit(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getEstoque(), PDO::PARAM_STR);
            @$sqlprep->bindParam(4, $this->getId_fabricante(), PDO::PARAM_INT);
            if ($sqlprep->execute() == 1) {
                echo "Cadastro efetuado com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar Produto "
            . $exc->getMessage();
        }
    }
    public function consultar() {
        try {
            $sql = "SELECT * FROM produto";

            $sqlprep = $this->con->query($sql);

            while ($vetor = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<article>
                    $vetor[0]<br>
                    Nome: $vetor[1]<br>
                    Valor Unidade: $vetor[2]<br>
                    Estoque: $vetor[3]<br>  
                    ID Fabricante: $vetor[3]<br>  
                     <a href='?p=funcionario/excluir&id=$vetor[0]' title='Exclusão funcionário'>
                        <img src='../imagem/icone_deletar.png' alt='Excluir'>
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


    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->valorunit = null;
        $this->estoque = null;
        $this->id_fabricante = null;
        $this->con = null;
    }

}

?>
