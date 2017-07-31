<?php

include_once 'Conectar.php';

class ImagemFuncionario {

    private $id;
    private $id_funcionario;
    private $nome;
    private $temp_nome;
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

    public function getId_funcionario() {
        return $this->id_funcionario;
    }

    public function setId_funcionario($id_funcionario) {
        $this->id_funcionario = $id_funcionario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTemp_nome() {
        return $this->temp_nome;
    }

    public function setTemp_nome($temp_nome) {
        $this->temp_nome = $temp_nome;
    }

    public function salvar() {
        try {
            $sql = "SELECT id FROM funcionario ORDER BY id DESC LIMIT 1 ";
            $prepsql = $this->con->query($sql);

            if ($ultimo_id = $prepsql->fetch(PDO::FETCH_NUM)) {
                $sql = "INSERT INTO imagem_funcionario VALUES (null,?,?)";
                $prepsql = $this->con->prepare($sql);
                $prepsql->bindParam(2, $ultimo_id[0], PDO::PARAM_INT);
                @$prepsql->bindParam(1, $this->getNome(), PDO::PARAM_STR);
                $prepsql->execute();
            }
        } catch (PDOException $e) {
            echo "Erro no salvar imagens de funcionário " . $e->getMessage();
        }
    }

    public function visualizar($base, $id_funcionario) {
        try {
            $sql = "SELECT * FROM imagem_funcionario "
                    . "WHERE id_funcionario = ?";

            $ps = $this->con->prepare($sql);
            $ps->bindParam(1, $id_funcionario, PDO::PARAM_INT);
            $ps->execute();

            echo "<div class='imagem'>";
            while ($registro = $ps->fetch(PDO::FETCH_NUM)) {
                if (!$registro[1] == null) {
                    echo "<article>"
                    . "<a href='$base/foto_funcionario/$registro[1]'"
                    . " title='$registro[1]'"
                    . " rel='lightbox'>"
                    . "<img src='$base/foto_funcionario/$registro[1]'
                        alt='$registro[1]'>"
                    . "</a>"
                    . "</article>";
                    //echo "<br>".$base . "foto_funcionario/" . $registro[1];
                }
            }
            echo "</div>";
        } catch (PDOException $e) {
            echo "Erro no visualizar imagens de funcionário "
            . $e->getMessage();
        }
    }
public function consultar($id_funcionario) {
        try {
            $sql = "SELECT * FROM imagem_funcionario "
                    . "WHERE id_funcionario = ?";

            $ps = $this->con->prepare($sql);
            $ps->bindParam(1, $id_funcionario, PDO::PARAM_INT);
            $ps->execute();

            echo "<div class='imagem'>";
            while ($registro = $ps->fetch(PDO::FETCH_NUM)) {
                if (!$registro[1] == null) {
                    echo "<article>"
                    . "<a href='?p=funcionario/editarfoto&id$registro[0]'"
                    . " title='$registro[0]'"
                    . " rel='lightbox'>"
                    . "<img src='../foto_funcionario/$registro[1]'
                        alt='$registro[1]'>"
                    . "</a>"
                    . "</article>";
                    //echo "<br>".$base . "foto_funcionario/" . $registro[1];
                }
            }
            echo "</div>";
        } catch (PDOException $e) {
            echo "Erro no visualizar imagens de funcionário "
            . $e->getMessage();
        }
    }

}

?>
