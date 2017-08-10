<?php

include_once 'Conectar.php';
include_once 'Url.php';

class Paginar {

    private $con;
    private $url;

    public function __construct() {
        $this->con = new Conectar();
        $this->url = new Url();
    }

    public function gerarConsulta($pg, $name, $like, $order) {
        $numreg = 50;

        $inicial = ($pg - 1) * $numreg;

        $string = "";

        if (!empty($name) && !empty($like)) {
            $string .= "$name LIKE '%$like%'";
        }

        $string .= " ORDER BY $order";
        $string .= " LIMIT $inicial, $numreg";

        return $string;
    }

    public function numPag($maximo, $pg) {
        if (!isset($pg) || $pg < 1) {
            $pg = 1;
        } else if ($pg > $maximo) {
            $pg = $maximo;
        }

        return $pg;
    }

    public function menuCatego() {
        try {
            $sql = "SELECT * FROM categorias ORDER BY nome";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {

                echo utf8_encode("<li class='has-sub'>
                            <a href='" . $this->readableUrl($this->url->getBase() . "categoria/$linhas[0]/$linhas[1]") . "'>"
                        . "<span>" . $linhas[1] . "</span>
                            </a>
                            <ul>" . $this->menuSubcatego($linhas[0]) . "</ul>
                        </li>");
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function menuSubcatego($catego) {
        try {
            $sql = "SELECT s.*
                FROM subcategorias as s, categorias as c
                WHERE c.id=? AND s.id_catego = c.id ORDER BY s.nome";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $catego, PDO::PARAM_INT);
            $sqlprep->execute();

            $str = '';

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                $str .= "<li><a href='" . $this->readableUrl($this->url->getBase()
                                . "subcategoria/"
                                . $linhas[0] . "/"
                                . $linhas[1]) . "'>
                            <span>" . $linhas[1] . "</span></a></li>";
            }

            return $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function menuTxt() {
        try {
            $sql = "SELECT * FROM textos ORDER BY titulo";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo utf8_encode("<li><a href='" . $this->readableUrl($this->url->getBase()
                                . "texto/"
                                . $linhas[0] . "/"
                                . $linhas[1]) . "'"
                        . "title='" . $linhas[1] . "'>"
                        . $linhas[1] . "</a></li>");
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function banner() {
        $i = 0;

        if ($handle = opendir('img/banner')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo utf8_encode("<li>"
                            . "<img src='" . $this->url->getBase() . "img/banner/$entry' alt='$entry' title='$entry' id='wows1_$i' />"
                            . "</li>");
                    $i++;
                }
            }
            closedir($handle);
        }
    }

    public function ultimosDestaques() {
        try {
            $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.destaque=1 AND p.ctrlestoque <> 0 AND 
                p.id_marca=m.id AND p.id_subcatego=s.id ORDER BY p.id DESC";
            $result = $this->con->query($sql);

            $num = $result->rowCount();

            if ($num > 0) {
                echo '<h2>ÚLTIMOS DESTAQUES</h2><hr />'
                . '<div id="carousel1" class="owl-carousel owl-theme">';
            }

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<div class='item'>"
                . "<a href='" . $this->readableUrl($this->url->getBase() . "produto/$linhas[0]/$linhas[1]") . "'>"
                . "<h3>" . $this->nomeProduto($linhas[1]) . "</h3>"
                . "<div class='imgProduto'>"
                . $this->imgProduto($linhas[0])
                . "</div>"
                . "</a>"
                . "<span class='oldPrice'>De "
                . $this->mudaPreco(((float) $linhas[2]) * 1.1)
                . " por</span>"
                . "<div class='newPrice'>"
                . $this->mudaPreco($linhas[2])
                . "</div>"
                . "<button class='botoes' onclick='comprar($linhas[0]);'>Comprar</button>"
                . "<button class='botoes' onclick='carrinho($linhas[0]);'>Carrinho</button>"
                . "</div>";
            }

            if ($num > 0) {
                echo '</div>';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function maisRecentes() {
        try {
            $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.destaque=0 AND p.ctrlestoque <> 0 AND 
                p.id_marca=m.id AND p.id_subcatego=s.id ORDER BY p.id DESC LIMIT 0, 15";
            $result = $this->con->query($sql);

            $num = $result->rowCount();

            if ($num > 0) {
                echo '<h2>MAIS RECENTES</h2><hr />'
                . '<div id="carousel2" class="owl-carousel owl-theme">';
            }

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<div class='item'>"
                . "<a href='" . $this->readableUrl($this->url->getBase() . "produto/$linhas[0]/$linhas[1]") . "'>"
                . "<h3>" . $this->nomeProduto($linhas[1]) . "</h3>"
                . "<div class='imgProduto'>"
                . $this->imgProduto($linhas[0])
                . "</div>"
                . "</a>"
                . "<span class='oldPrice'>De "
                . $this->mudaPreco(((float) $linhas[2]) * 1.1)
                . " por</span>"
                . "<div class='newPrice'>"
                . $this->mudaPreco($linhas[2])
                . "</div>"
                . "<button class='botoes' onclick='comprar($linhas[0]);'>Comprar</button>"
                . "<button class='botoes' onclick='carrinho($linhas[0]);'>Carrinho</button>"
                . "</div>";
            }

            if ($num > 0) {
                echo '</div>';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function maisComprados() {
        try {
            if ($this->idProduto()) {
                $subquery = $this->idProduto();
            } else {
                return 0;
            }

            $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.id IN ($subquery) AND p.ctrlestoque <> 0 AND 
                p.id_marca=m.id AND p.id_subcatego=s.id ORDER BY p.id DESC LIMIT 0, 15";
            $result = $this->con->query($sql);

            $num = $result->rowCount();

            if ($num > 0) {
                echo '<h2>MAIS COMPRADOS</h2><hr />'
                . '<div id="carousel3" class="owl-carousel owl-theme">';
            }

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<div class='item'>"
                . "<a href='" . $this->readableUrl($this->url->getBase() . "produto/$linhas[0]/$linhas[1]") . "'>"
                . "<h3>" . $this->nomeProduto($linhas[1]) . "</h3>"
                . "<div class='imgProduto'>"
                . $this->imgProduto($linhas[0])
                . "</div>"
                . "</a>"
                . "<span class='oldPrice'>De "
                . $this->mudaPreco(((float) $linhas[2]) * 1.1)
                . " por</span>"
                . "<div class='newPrice'>"
                . $this->mudaPreco($linhas[2])
                . "</div>"
                . "<button class='botoes' onclick='comprar($linhas[0]);'>Comprar</button>"
                . "<button class='botoes' onclick='carrinho($linhas[0]);'>Carrinho</button>"
                . "</div>";
            }

            if ($num > 0) {
                echo '</div>';
            }
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

    public function mudaPreco($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function nomeProduto($str) {
        $len = 45;

        if (strlen($str) < $len) {
            return $str;
        } else {
            return substr($str, 0, $len) . "...";
        }
    }

    public function idProduto() {
        try {
            $sql = "SELECT i.id_produto, COUNT(i.id_produto) as compras
                FROM itens as i, produtos as p, vendas as v
                WHERE i.id_produto = p.id AND i.id_venda = v.id GROUP BY i.id_produto
                ORDER BY compras DESC LIMIT 0,15";
            $result = $this->con->query($sql);

            $num = $result->rowCount();
            $first = true;

            if ($num <= 0) {
                return false;
            }

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
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

    public function readableUrl($url) {
        return str_replace(" ", "-", $url);
    }

    public function filtrar($marca, $preco, $ordem) {
        $str = '';

        if (!empty($marca)) {
            $str .= 'AND m.id IN (';

            $marca = explode(";", $marca);
            $i = 0;
            $first = true;

            while ($i < sizeof($marca)) {
                if (!$first) {
                    $str.= "," . $marca[$i];
                } else {
                    $str .= $marca[$i];
                    $first = false;
                }

                $i++;
            }

            $str.=') ';
        }

        if (!empty($preco)) {
            $str.='AND (';

            $preco = explode(";", $preco);
            $i = 0;
            $first = true;

            while ($i < sizeof($preco)) {
                if (!$first) {
                    $str.= ' OR ';
                } else {
                    $first = false;
                }

                switch ($preco[$i]) {
                    case 49:
                        $str .= "(p.preco BETWEEN 0 AND 49.99)";
                        break;
                    case 99:
                        $str .= "(p.preco BETWEEN 50 AND 99.99)";
                        break;
                    case 499:
                        $str .= "(p.preco BETWEEN 100 AND 499.99)";
                        break;
                    case 999:
                        $str .= "(p.preco BETWEEN 500 AND 999.99)";
                        break;
                    case 4999:
                        $str .= "(p.preco BETWEEN 1000 AND 4999.99)";
                        break;
                    case 5000:
                        $str .= "(p.preco >= 5000)";
                        break;
                }

                $i++;
            }

            $str.=') ';
        }

        switch ($ordem) {
            case 0:
                $str .= "ORDER BY p.id DESC";
                break;
            case 1:
                $str .= " ORDER BY p.preco DESC";
                break;
            case 2:
                $str .= " ORDER BY p.preco";
                break;
            case 3:
                $str .= " ORDER BY p.nome";
                break;
            case 4:
                $str .= " ORDER BY p.nome DESC";
                break;
            default:
                $str .= " ORDER BY p.id DESC";
                break;
        }

        return $str;
    }

}
