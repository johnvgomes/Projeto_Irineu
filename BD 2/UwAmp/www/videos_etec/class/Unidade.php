<?php
include_once 'Conectar.php';

class Unidade {
    //put your code here
    private $id;
    private $nome;
    private $con;
    
    public function __construct($id="", $nome="") {
        $this->id = $id;
        $this->nome = $nome;
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

    public function carregarSelect() {
        try {
            $sql = "SELECT * FROM unidade ORDER BY nome";
            
            $r = $this->con->query($sql);
            
            while ($linha = $r->fetch(PDO::FETCH_NUM)){
                echo "<option value='$linha[0]'>$linha[1]</option>";
            }
            
        } catch (PDOException $exc) {
            echo "Erro no carregarSelect de unidade " . $exc->getMessage();
        }
    }
    
    public function salvar() {
        try {

            $sql = "INSERT INTO unidade VALUES (null,?)";

            $prepsql = $this->con->prepare($sql);
            $prepsql->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $prepsql->execute();

            //aqui dispara o cadastro de imagens
        } catch (PDOException $e) {
            echo "Erro no salvar unidade " . $e->getMessage();
        }
    }
    
    public function consultar() {
        try {
            $sql = "SELECT * FROM unidade ORDER BY nome";

            $res = $this->con->query($sql);
            
            echo "<div><br><h3>Unidades já cadastradas</h3><br>";
            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo "- $linha[1]<br>
                    <a href='?p=unidade/excluir&id=$linha[0]' title='excluir'>
                    <img src='../imagem/icone/remove.png'> 
                    </a>
                    <a href='?p=unidade/editar&id=$linha[0]' title='editar'>
                    <img src='../imagem/icone/accept.png'>
                    </a>
                    <br><br>
                        ";                    
            }//fim while
            echo "</div>";
        } catch (PDOException $exc) {
            echo "Erro no consultar unidade " . $exc->getMessage();
        }
    }
    
     public function excluir($id) {
        try {
            $sql = "DELETE FROM unidade WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo "Erro ao excluir unidade " . $exc->getMessage();
        }
    }
    
   public function carregar($id) {
        try {
            $sql = "SELECT *
                FROM unidade
                WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar unidade " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE unidade SET nome=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo 'Noticia atualizada com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar registros de unidade  " . $exc->getMessage();
        }
    }
    
    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->con = "";
    }
 
}

?>
