<?php

include_once 'Conectar.php';
include_once 'Url.php';

class Subcategorias {

    private $id;
    private $nome;
    private $id_catego;
    private $con;
    private $url;

    public function __construct($id = "", $nome = "", $id_catego = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->id_catego = $id_catego;
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

    public function getId_catego() {
        return $this->id_catego;
    }

    public function setId_catego($id_catego) {
        $this->id_catego = $id_catego;
    }

    public function dadosTabela() {
        try {
            $sql = "SELECT COUNT(*) FROM subcategorias as s "
                    . "UNION ALL "
                    . "SELECT COUNT(*) FROM subcategorias as s, categorias as c 
                        WHERE s.id_catego=c.id "
                    . "UNION ALL "
                    . "SELECT MAX(s.id) FROM subcategorias as s, categorias as c 
                        WHERE s.id_catego=c.id";
            $result = $this->con->query($sql);

            echo "<tr>"
            . "<td>Subcategorias</td>";

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
            $sql = "INSERT INTO subcategorias VALUES (null,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId_catego(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Gravado com sucesso!';
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function verifNome($n, $c) {
        try {
            $sql = "SELECT s.* FROM subcategorias as s, categorias as c "
                    . "WHERE s.nome=? AND s.id_catego=? AND s.id_catego=c.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $n, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $c, PDO::PARAM_INT);
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
                $consulta = 'ORDER BY s.id LIMIT 0,50';
            } else if (strpos($consulta, 'LIKE') !== false) {
                $consulta = 'AND ' . $consulta;
            }

            $sql = "SELECT s.id, s.nome, c.nome
                FROM subcategorias as s, categorias as c 
                WHERE s.id_catego=c.id $consulta";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "
                <tr>
                    <td>$linhas[0]</td>
                    <td>$linhas[1]</td>
                    <td>$linhas[2]</td>
                    <td class='infoImg'><a href='?p=subcategorias/editar&id=$linhas[0]'><img src='../img/editar.png' width='25' height='25' alt='Editar' />
                        </a></td>
                    <td class='infoImg'><a href='?p=subcategorias/excluir&id=$linhas[0]'><img src='../img/excluir.png' width='25' height='25' alt='Excluir' />
                        </a></td>
                </tr>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT s.*, c.*
                FROM subcategorias as s, categorias as c
                WHERE s.id=? AND s.id_catego = c.id";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE subcategorias SET nome=?, id_catego=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId_catego(), PDO::PARAM_INT);
            $sqlprep->bindParam(3, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM subcategorias WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregarCombo() {
        try {
            $sql = "SELECT c.id, c.nome, s.id, s.nome, s.id_catego
                FROM subcategorias as s, categorias as c 
                WHERE s.id_catego=c.id ORDER BY c.id, s.nome";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {

                $now = $linhas[0];
                if ($before != $now) {
                    $before = $linhas[0];
                    echo "<optgroup label='$linhas[1]' />";
                }

                echo "<option value='$linhas[2]'>$linhas[3]</option>";
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
            $busca = 'AND ' . $busca;
        }

        @$res = $this->con->query("SELECT COUNT(*)
                FROM subcategorias as s, categorias as c 
                WHERE s.id_catego=c.id $busca");

        @$quantreg = $res->fetchColumn();
        @$quant_pg = floor($quantreg / $numreg);
        @$quant_pg = $quant_pg + 1;

        return $quant_pg;
    }

    public function exibirProdutos($id, $filtro) {
        try {
            

            if (empty($filtro)) {
                $filtro = 'ORDER BY p.id DESC';
            }

            $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.id_subcatego = $id AND 
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
        $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.id_subcatego = $id AND 
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
        $this->id_catego = "";
        $this->con = "";
    }

}

?>
