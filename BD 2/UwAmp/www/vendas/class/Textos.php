<?php

include_once 'Conectar.php';

class Textos {

    private $id;
    private $titulo;
    private $conteudo;
    private $con;

    public function __construct($id = "", $titulo = "", $conteudo = "") {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getConteudo() {
        return $this->conteudo;
    }

    public function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    public function dadosTabela() {
        try {
            $sql = "SELECT COUNT(*) FROM textos as t "
                    . "UNION ALL "
                    . "SELECT COUNT(*) FROM textos as t "
                    . "UNION ALL "
                    . "SELECT MAX(t.id) FROM textos as t";
            $result = $this->con->query($sql);

            echo "<tr>"
            . "<td>Textos</td>";

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<td>$linhas[0]</td>";
            }
            echo "</tr>";
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function inserir() {
        try {
            $sql = "INSERT INTO textos VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getTitulo(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getConteudo(), PDO::PARAM_STR);

            if ($sqlprep->execute())
                echo 'Gravado com sucesso!';
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultar($consulta) {
        try {
            if (empty($consulta)) {
                $consulta = 'ORDER BY t.id LIMIT 0,50';
            } else if (strpos($consulta, 'LIKE') !== false) {
                $consulta = 'WHERE ' . $consulta;
            }

            $sql = "SELECT t.* FROM textos as t $consulta";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "
                <tr id=$linhas[0]>
                    <td>$linhas[0]</td>
                    <td>$linhas[1]</td>
                    <td class='infoImg clickable' onclick='exibirTexto(" . $linhas[0] . ");'>
                        <img src='../img/texto.png' width='25' height='25' alt='Exibir texto' />
                    </td>
                    <td class='infoImg'><a href='?p=textos/editar&id=$linhas[0]'><img src='../img/editar.png' width='25' height='25' alt='Editar' />
                        </a></td>
                    <td class='infoImg'><a href='?p=textos/excluir&id=$linhas[0]'><img src='../img/excluir.png' width='25' height='25' alt='Excluir' />
                        </a></td>
                </tr>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM textos WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linha;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE textos SET titulo=?, conteudo=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getTitulo(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getConteudo(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM textos WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Exclu&iacute;do com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function exibirTexto($id) {
        try {
            $sql = "SELECT * FROM textos WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo utf8_encode($linha[2]);
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function quantPg($busca) {
        $numreg = 50;

        if (empty($busca)) {
            $busca = '';
        } else if (strpos($busca, 'LIKE') !== false) {
            $busca = 'WHERE ' . $busca;
        }

        @$res = $this->con->query("SELECT COUNT(*)
                FROM textos as t $busca");

        @$quantreg = $res->fetchColumn();
        @$quant_pg = floor($quantreg / $numreg);
        @$quant_pg = $quant_pg + 1;

        return $quant_pg;
    }

    public function __destruct() {
        $this->id = "";
        $this->titulo = "";
        $this->conteudo = "";
        $this->con = "";
    }

}

?>
