<?php

include_once 'Conectar.php';
include_once 'Url.php';

class Categorias {

    private $id;
    private $nome;
    private $con;
    private $url;

    public function __construct($id = "", $nome = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->con = new Conectar();
        $this->url = new Url();
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

    public function dadosTabela() {
        try {
            $sql = "SELECT COUNT(*) FROM categorias as c "
                    . "UNION ALL "
                    . "SELECT COUNT(*) FROM categorias as c "
                    . "UNION ALL "
                    . "SELECT MAX(c.id) FROM categorias as c";
            $result = $this->con->query($sql);

            echo "<tr>"
            . "<td>Categorias</td>";

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
            $sql = "INSERT INTO categorias VALUES (null,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);

            if ($sqlprep->execute())
                echo 'Gravado com sucesso!';
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function verifNome($n) {
        try {
            $sql = "SELECT * FROM categorias WHERE nome=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $n, PDO::PARAM_STR);
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
                $consulta = 'ORDER BY c.id LIMIT 0,50';
            } else if (strpos($consulta, 'LIKE') !== false) {
                $consulta = 'WHERE ' . $consulta;
            }

            $sql = "SELECT c.* FROM categorias as c $consulta";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "
                <tr>
                    <td>$linhas[0]</td>
                    <td>$linhas[1]</td>
                    <td class='infoImg'><a href='?p=categorias/editar&id=$linhas[0]'><img src='../img/editar.png' width='25' height='25' alt='Editar' />
                        </a></td>
                    <td class='infoImg'><a href='?p=categorias/excluir&id=$linhas[0]'><img src='../img/excluir.png' width='25' height='25' alt='Excluir' />
                        </a></td>
                </tr>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM categorias WHERE id=?";
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
            $sql = "UPDATE categorias SET nome=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM categorias WHERE id=?";
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
            $sql = "SELECT * FROM categorias ORDER BY nome";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
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
                FROM categorias as c $busca");

        @$quantreg = $res->fetchColumn();
        @$quant_pg = floor($quantreg / $numreg);
        @$quant_pg = $quant_pg + 1;

        return $quant_pg;
    }

    public function exibirProdutos($id, $filtro) {
        try {
            

            if ($this->prodSubcatego($id)) {
                $subquery = $this->prodSubcatego($id);
            } else {
                return 0;
            }

            if (empty($filtro)) {
                $filtro = 'ORDER BY p.id DESC';
            }

            $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.id_subcatego IN ($subquery) AND 
                p.id_marca=m.id AND p.id_subcatego=s.id $filtro";
            $result = $this->con->query($sql);

            $num = $result->rowCount();
            $str = '';


            if ($num <= 0) {
                return false;
            }

            $i = 0;

            $str.="<div class='resultContent'>";

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                if ($i < 20) {
                    $display = "style='display:initial;'";
                } else {
                    $display = "style='display:none;'";
                }

                $str.= "<div class='produtoPre' $display>"
                        . "<a href='" . $this->readableUrl($this->url->getBase() . "produto/$linhas[0]/$linhas[1]") . "'>"
                        . "<div class='imgProduto'>"
                        . $this->imgProduto($linhas[0])
                        . "</div>"
                        . "<h3>$linhas[1]</h3>"
                        . "</a>"
                        . "<span class='oldPrice'>De "
                        . $this->mudaPreco(((float) $linhas[2]) * 1.1)
                        . " por</span>"
                        . "<div class='newPrice'>"
                        . $this->mudaPreco($linhas[2])
                        . "</div>"
                        . "</div>";

                $i++;
            }

            $str .="</div>";

            if ($this->numReg($id, $filtro) > 20) {
                $str.= "<div id='moreResult' onclick='maisRes();'>
                        <img src='" . $this->url->getBase() . "img/newBox.png' width='20' height='20' />
                        Mais resultados
                        </div>";
            }

            return $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function prodSubcatego($id) {
        try {
            

            $sql = "SELECT s.id FROM subcategorias as s, categorias as c 
                        WHERE s.id_catego=c.id AND s.id_catego=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();
            $first = true;

            if ($num <= 0) {
                return false;
            }

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if (!$first) {
                    $str.= "," . $linhas[0];
                } else {
                    $str = $linhas[0];
                    $first = false;
                }
            }

            return $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function imgProduto($produto) {
        try {
            

            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id_produto=? AND f.id_produto = p.id ORDER BY f.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $produto, PDO::PARAM_INT);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();

            $str = '';
            $first = true;

            if ($num <= 0) {
                return $str = "<img src='" . $this->url->getBase() . "img/indisponivel.png' alt='Imagem indisponível' />";
            }

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if ($first || $linhas[3] == 1) {
                    $str = "<img src='"
                            . $this->url->getBase()
                            . "img/img_fotos/$linhas[1]' alt='$linhas[2]' title='$linhas[2]' />";

                    $first = false;
                }
            }

            return $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function numReg($id, $filtro) {
        if ($this->prodSubcatego($id)) {
            $subquery = $this->prodSubcatego($id);
        } else {
            return 0;
        }

        $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.id_subcatego IN ($subquery) AND 
                p.id_marca=m.id AND p.id_subcatego=s.id $filtro";
        $result = $this->con->query($sql);

        return $result->rowCount();
    }

    public function mudaPreco($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function readableUrl($url) {
        return str_replace(" ", "-", $url);
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->con = "";
        $this->url = "";
    }

}

?>
