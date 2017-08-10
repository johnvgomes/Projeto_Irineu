<?php

include_once 'Conectar.php';

class Marcas {

    private $id;
    private $nome;
    private $origem;
    private $con;

    public function __construct($id = "", $nome = "", $origem = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->origem = $origem;
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

    public function getOrigem() {
        return $this->origem;
    }

    public function setOrigem($origem) {
        $this->origem = $origem;
    }

    public function dadosTabela() {
        try {
            $sql = "SELECT COUNT(*) FROM marcas as m "
                    . "UNION ALL "
                    . "SELECT COUNT(*) FROM marcas as m "
                    . "UNION ALL "
                    . "SELECT MAX(m.id) FROM marcas as m";
            $result = $this->con->query($sql);

            echo "<tr>"
            . "<td>Marcas</td>";

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
            $sql = "INSERT INTO marcas VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getOrigem(), PDO::PARAM_STR);

            if ($sqlprep->execute())
                echo 'Gravado com sucesso!';
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultar($consulta) {
        try {
            if (empty($consulta)) {
                $consulta = 'ORDER BY m.id LIMIT 0,50';
            } else if (strpos($consulta, 'LIKE') !== false) {
                $consulta = 'WHERE ' . $consulta;
            }

            $sql = "SELECT m.* FROM marcas as m $consulta";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "
                <tr>
                    <td>$linhas[0]</td>
                    <td>$linhas[1]</td>
                    <td>$linhas[2]</td>
                    <td class='infoImg'><a href='?p=marcas/editar&id=$linhas[0]'><img src='../img/editar.png' width='25' height='25' alt='Editar' />
                        </a></td>
                    <td class='infoImg'><a href='?p=marcas/excluir&id=$linhas[0]'><img src='../img/excluir.png' width='25' height='25' alt='Excluir' />
                        </a></td>
                </tr>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM marcas WHERE id=?";
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
            $sql = "UPDATE marcas SET nome=?, origem=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getOrigem(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM marcas WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Exclu&iacute;do com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregarCombo() {
        try {
            $sql = "SELECT * FROM marcas ORDER BY origem, nome";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {

                $now = $linhas[2];
                if ($before != $now) {
                    $before = $linhas[2];
                    echo "<optgroup label='$linhas[2]' />";
                }

                echo "<option value='$linhas[0]'>$linhas[1]</option>";
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
                FROM marcas as m $busca");

        @$quantreg = $res->fetchColumn();
        @$quant_pg = floor($quantreg / $numreg);
        @$quant_pg = $quant_pg + 1;

        return $quant_pg;
    }

    public function listaMarcas() {
        try {
            $sql = "SELECT m.* FROM marcas as m ORDER BY m.nome";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<div>"
                . "<input type='checkbox' class='marca' name='marca[]' value='$linhas[0]' checked />"
                . "$linhas[1]"
                . "</div>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->origem = "";
        $this->con = "";
    }

}

?>
