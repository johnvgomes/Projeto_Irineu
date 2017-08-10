<?php

include_once 'Conectar.php';
include_once 'PaginarFuncionario.php';
include_once 'ImagemFuncionario.php';

class Funcionario {

    private $id;
    private $nome;
    private $salario;
    private $id_depto;
    private $url;
    private $con;
    private $p;
    private $if;

    public function __construct() {
        $this->con = new Conectar();
    }

    function getUrl() {
        return $this->url;
    }

    function setUrl($url) {
        $this->url = $url;
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
            $sql = "INSERT INTO funcionario VALUES (null,?,?,?,?)";

            $sqlprep = $this->con->prepare($sql);
            
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getSalario(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getId_depto(), PDO::PARAM_INT);
            @$sqlprep->bindParam(4, $this->getUrl(), PDO::PARAM_STR);
            if ($sqlprep->execute() == 1) {
                echo "Cadastro efetuado com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao cadastrar funcionário "
            . $exc->getMessage();
        }
    }

    public function paginar($pg, $table1, $table2, $pasta, $link) {
        try {
            $this->p = new Paginar();
            //$pg = página em que se encontra
            //$pasta = pasta das imagens
            //nome -> 2
            //url -> 4
            //salario -> 3

            $this->p->paginacao(2, $pg, $table1, $table2, $pasta, $link, "4em", 1, 4, 2, "paginacao");
        } catch (PDOException $exc) {
            echo "Erro ao paginar "
            . $exc->getTraceAsString();
        }
    }

    public function visualizar($base, $url) {
        try {
            $if = new ImagemFuncionario();
            $sql = "SELECT f.*, d.* "
                    . "FROM funcionario as f, "
                    . "departamento as d "
                    . "WHERE f.url = ? AND "
                    . "f.id_depto = d.id";
            $ps = $this->con->prepare($sql);
            $ps->bindParam(1, $url, PDO::PARAM_STR);
            $ps->execute();

            if ($vetor = $ps->fetch(PDO::FETCH_NUM)) {
                echo "<article class='func'>"
                . "<h3>$vetor[1]</h3>"
                . "<span>Salário: R$ "
                . number_format($vetor[2], 2, ',', '.')
                . "</span>"
                . "<span>Depto: $vetor[6]</span>"
                . "</article>";
                $if->visualizar($base, $vetor[0]);
            }
        } catch (PDOException $exc) {
            echo "Erro ao visualizar "
            . $exc->getMessage();
        }
    }
 public function consultarescrito() {
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
                 $this->ct->excluirArquivo("../foto_funcionario/".$registro[3]);
                 
                 
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
        
        public function consultarprofessor($inicial, $final) {
        try {
            $if = new ImagemFuncionario();
            $sql = "SELECT f.*, d.* "
                    . "FROM funcionario as f, "
                    . "departamento as d "
                    . "WHERE f.id_depto = d.id AND "
                    . "fsalario BETWEEN ? AND ?";
            $ps = $this->con->prepare($sql);
            $ps->bindParam(1, $inicial, PDO::PARAM_STR);
            $ps->bindParam(2, $final, PDO::PARAM_STR);
            $ps->execute();

            if ($vetor = $ps->fetch(PDO::FETCH_NUM)) {
                echo "<article class='func'>"
                . "<h3>$vetor[1]</h3>"
                . "<span>Salário: R$ "
                . number_format($vetor[2], 2, ',', '.')
                . "</span>"
                . "<span>Depto: $vetor[6]</span>"
                . "<a href='?p=funcionario/excluir&id=$vetor[0]' "
                .  "title='$vetor[1]'>[excluir]</a>"
                . " <a href='?p=funcionario/editar&id=$vetor[0]' "
                ."title='$vetor[1]'[editar]</a>"      
                . "</article>";
                $if->consultar($vetor[0]);
            }
        } catch (PDOException $exc) {
            echo "Erro ao visualizar "
            . $exc->getMessage();
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
