<?php

include_once 'Conectar.php';
include_once 'Url.php';

class Buscar {

    private $con;
    private $url;

    public function __construct() {
        $this->con = new Conectar();
        $this->url = new Url();
    }

//$_POST['btnBuscar']
    public function paramBusca($busca) {
        $busca_arr = explode(" ", $busca);
        $str = "(";
        $first = true;
        $i = 0;

        while ($i < sizeof($busca_arr)) {
            if (!$first) {
                $str .= "(p.nome LIKE '%$busca_arr[$i]%') OR ";
            } else {
                $str .= "(p.nome LIKE '%$busca_arr[$i]%')";
            }

            $i++;
        }

        $str .= ")";

        return $str;
    }

    public function exibirProdutos($search, $filtro) {
        try {
            $baseurl = "http://localhost/BuyOn/";

            $busca = $this->paramBusca($search);

            if (empty($filtro)) {
                $filtro = 'ORDER BY p.id DESC';
            }

            $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE $busca AND 
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
                        . "<a href='" . $this->readableUrl($baseurl . "produto/$linhas[0]/$linhas[1]") . "'>"
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

            if ($this->numReg($search, $filtro) > 20) {
                $str.= "<div id='moreResult' onclick='maisRes();'>
                        <img src='" . $baseurl . "img/newBox.png' width='20' height='20' />
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
            $baseurl = "http://localhost/BuyOn/";

            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id_produto=? AND f.id_produto = p.id ORDER BY f.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $produto, PDO::PARAM_INT);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();

            $str = '';
            $first = true;

            if ($num <= 0) {
                return $str = "<img src='" . $baseurl . "img/indisponivel.png' alt='Imagem indisponível' />";
            }

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if ($first || $linhas[3] == 1) {
                    $str = "<img src='"
                            . $baseurl
                            . "img/img_fotos/$linhas[1]' alt='$linhas[2]' title='$linhas[2]' />";

                    $first = false;
                }
            }

            return $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function numReg($search, $filtro) {

        $busca = $this->paramBusca($search);

        $sql = "SELECT p.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE $busca AND 
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

}
