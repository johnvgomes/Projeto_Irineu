<?php

include_once 'Conectar.php';

class Admin {

    private $id;
    private $nome;
    private $senha;
    private $email;
    private $con;

    public function __construct($id = "", $nome = "", $senha = "", $email = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
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

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function dadosTabela() {
        try {
            $sql = "SELECT COUNT(*) FROM admin as a "
                    . "UNION ALL "
                    . "SELECT COUNT(*) FROM admin as a "
                    . "UNION ALL "
                    . "SELECT MAX(a.id) FROM admin as a";
            $result = $this->con->query($sql);

            echo "<tr>"
            . "<td>Admin</td>";

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
            $sql = "INSERT INTO admin VALUES (null,?,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, sha1($this->getSenha()), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getEmail(), PDO::PARAM_STR);

            if ($sqlprep->execute())
                echo 'Gravado com sucesso!';

            $this->con = null; //desconectar
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function verifEmail($e) {
        try {
            $sql = "SELECT * FROM admin WHERE email=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $e, PDO::PARAM_STR);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();

            if ($num > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultar($consulta) {
        try {
            if (empty($consulta)) {
                $consulta = 'ORDER BY a.id LIMIT 0,50';
            } else if (strpos($consulta, 'LIKE') !== false) {
                $consulta = 'WHERE ' . $consulta;
            }

            $sql = "SELECT a.* FROM admin as a $consulta";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "
                <tr>
                    <td>$linhas[0]</td>
                    <td>$linhas[1]</td>
                    <td>$linhas[3]</td>
                    <td class='infoImg'><a href='?p=admin/editar&id=$linhas[0]'><img src='../img/editar.png' width='25' height='25' alt='Editar' />
                        </a></td>
                    <td class='infoImg'><a href='?p=admin/excluir&id=$linhas[0]'><img src='../img/excluir.png' width='25' height='25' alt='Excluir' />
                        </a></td>
                </tr>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM admin WHERE id=?";
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
            $sql = "UPDATE admin SET nome=?, senha=?, 
                email=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, sha1($this->getSenha()), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getEmail(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            if ($id == 1) {
                echo 'N&atilde;o &eacute; poss&iacute;vel excluir o administrador prim&aacute;rio.';
            } else {
                $sql = "DELETE FROM admin WHERE id=?";
                $sqlprep = $this->con->prepare($sql);
                $sqlprep->bindParam(1, $id, PDO::PARAM_INT);

                if ($sqlprep->execute())
                    echo 'Exclu&iacute;do com sucesso!';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function verifSenha($s) {
        try {
            $sql = "SELECT nome FROM admin WHERE senha=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, sha1($s), PDO::PARAM_STR);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();
            $linhas = $sqlprep->fetch(PDO::FETCH_NUM);

            if ($num > 0 && $linhas[0] == $_SESSION['adm']) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 17; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function quantPg($busca) {
        $numreg = 50;

        if (empty($busca)) {
            $busca = '';
        } else if (strpos($busca, 'LIKE') !== false) {
            $busca = 'WHERE ' . $busca;
        }

        @$res = $this->con->query("SELECT COUNT(*)
                FROM admin as a $busca");

        @$quantreg = $res->fetchColumn();
        @$quant_pg = floor($quantreg / $numreg);
        @$quant_pg = $quant_pg + 1;

        return $quant_pg;
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->senha = "";
        $this->email = "";
        $this->con = "";
    }

}

?>
