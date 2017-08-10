<?php

include_once 'Conectar.php';

class Marca {

    //put your code here
    private $id;
    private $nome;
    private $pais_origem;
    private $ano_fundacao;
    private $con;

    public function __construct($id="", $nome="", 
            $pais_origem="", $ano_fundacao="") {
        $this->id = $id;
        $this->nome = $nome;
        $this->pais_origem = $pais_origem;
        $this->ano_fundacao = $ano_fundacao;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPais_origem() {
        return $this->pais_origem;
    }

    public function getAno_fundacao() {
        return $this->ano_fundacao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPais_origem($pais_origem) {
        $this->pais_origem = $pais_origem;
    }

    public function setAno_fundacao($ano_fundacao) {
        $this->ano_fundacao = $ano_fundacao;
    }

    //cadastrar Marca
    public function cadastrar() {
        try {
            $sql = "INSERT INTO marca VALUES (null,?,?,?);";

            $prepsql = $this->con->prepare($sql);
            $prepsql->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getPais_origem(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getAno_fundacao(), PDO::PARAM_INT);

            if ($prepsql->execute()) {
                echo "Marca cadastrada com sucesso!";
            } else {
                echo "Problemas ao cadastrar marca!";
            }
        } catch (PDOException $exc) {
            echo "Erro no cadastrar marca " . $exc->getMessage();
        }
    }

    public function carregarSelect() {
        try {
            $sql = "SELECT * FROM marca";
            
            $r = $this->con->query($sql);
            
            while ($linha = $r->fetch(PDO::FETCH_NUM)){
                echo "<option value='$linha[0]'>$linha[1]</option>";
            }
            
        } catch (PDOException $exc) {
            echo "Erro no carregarSelect de marca " . $exc->getMessage();
        }
    }
    
    public function consultar(){
        try {
            $sql = "SELECT * FROM marca";
            
            $res = $this->con->query($sql);
            
            while ($linha = $res->fetch(PDO::FETCH_NUM)){
                echo "<div class='consulta'>"
                . "$linha[0] | $linha[1] | $linha[2]"
                        . "</div>";
            }
            
        } catch (PDOException $exc) {
            echo "Erro no consultar de marca " . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->pais_origem = "";
        $this->ano_fundacao = "";
        $this->con = "";
    }

}

?>
