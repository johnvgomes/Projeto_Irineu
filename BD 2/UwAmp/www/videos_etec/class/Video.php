<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Video {
    private $id;
    private $link;
    private $con;
    private $ct;

    public function __construct(){
        $this->con = new Conectar();
        $this->ct = new Controles();
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function visualizar() {
        try {
            $sql = "SELECT * FROM video";

            $sqlprep = $this->con->query($sql);

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo $linha[1];
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar vídeo " . $exc->getMessage();
        }
    }
    
    public function editar() {
        try {
            $sql = "UPDATE video SET link=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getLink(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo "Noticia atualizada com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar video da index  " . $exc->getMessage();
        }
    }

}

?>
