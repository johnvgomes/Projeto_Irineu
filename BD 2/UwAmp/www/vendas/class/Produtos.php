<?php

include_once 'Conectar.php';
include_once 'Url.php';

class Produtos {

    private $id;
    private $nome;
    private $preco;
    private $peso;
    private $estoque;
    private $ctrlestoque;
    private $descricao;
    private $destaque;
    private $id_marca;
    private $id_subcatego;
    private $con;
    private $url;

    public function __construct($id = "", $nome = "", $preco = "", $peso = "", $estoque = "", $ctrlestoque = "", $descricao = "", $destaque = "", $id_marca = "", $id_subcatego = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->peso = $peso;
        $this->estoque = $estoque;
        $this->ctrlestoque = $ctrlestoque;
        $this->descricao = $descricao;
        $this->destaque = $destaque;
        $this->id_marca = $id_marca;
        $this->id_subcatego = $id_subcatego;
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

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    public function getCtrlestoque() {
        return $this->ctrlestoque;
    }

    public function setCtrlestoque($ctrlestoque) {
        $this->ctrlestoque = $ctrlestoque;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getDestaque() {
        return $this->destaque;
    }

    public function setDestaque($destaque) {
        $this->destaque = $destaque;
    }

    public function getId_marca() {
        return $this->id_marca;
    }

    public function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }

    public function getId_subcatego() {
        return $this->id_subcatego;
    }

    public function setId_subcatego($id_subcatego) {
        $this->id_subcatego = $id_subcatego;
    }

    public function controlaEstoque($est) {
        if ($est > 10) {
            $this->setCtrlestoque(2); //2: PRODUTO EM ESTOQUE
        } else if ($est > 0) {
            $this->setCtrlestoque(1); //1: ÚLTIMAS UNIDADES DO ESTOQUE
        } else {
            $this->setCtrlestoque(0); //0: PRODUTO INDISPONÍVEL
        }
    }

    public function dadosTabela() {
        try {
            $sql = "SELECT COUNT(*) FROM produtos as p "
                    . "UNION ALL "
                    . "SELECT COUNT(*) FROM produtos as p, marcas as m, subcategorias as s 
                        WHERE p.id_marca=m.id AND p.id_subcatego=s.id "
                    . "UNION ALL "
                    . "SELECT MAX(p.id) FROM produtos as p, marcas as m, subcategorias as s 
                        WHERE p.id_marca=m.id AND p.id_subcatego=s.id";
            $result = $this->con->query($sql);

            echo "<tr>"
            . "<td>Produtos</td>";

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
            $sql = "INSERT INTO produtos VALUES (null,?,?,?,?,?,?,?,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getPreco(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getPeso(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getEstoque(), PDO::PARAM_INT);
            $sqlprep->bindParam(5, $this->getCtrlestoque(), PDO::PARAM_INT);
            $sqlprep->bindParam(6, $this->getDescricao(), PDO::PARAM_STR);
            $sqlprep->bindParam(7, $this->getDestaque(), PDO::PARAM_BOOL);
            $sqlprep->bindParam(8, $this->getId_marca(), PDO::PARAM_INT);
            $sqlprep->bindParam(9, $this->getId_subcatego(), PDO::PARAM_INT);

            if ($sqlprep->execute()) {
                session_start();
                $_SESSION['idProduto'] = $this->con->lastInsertId();
                echo 'Gravado com sucesso!';
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function mudaFormato($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }

    public function editar() {
        try {
            $sql = "UPDATE produtos SET nome=?, preco=?, peso=?, estoque=?, ctrlestoque=?, "
                    . "descricao=?, destaque=?, id_marca=?, id_subcatego=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getPreco(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getPeso(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getEstoque(), PDO::PARAM_INT);
            $sqlprep->bindParam(5, $this->getCtrlestoque(), PDO::PARAM_INT);
            $sqlprep->bindParam(6, $this->getDescricao(), PDO::PARAM_STR);
            $sqlprep->bindParam(7, $this->getDestaque(), PDO::PARAM_BOOL);
            $sqlprep->bindParam(8, $this->getId_marca(), PDO::PARAM_INT);
            $sqlprep->bindParam(9, $this->getId_subcatego(), PDO::PARAM_INT);
            $sqlprep->bindParam(10, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultar($consulta) {
        try {
            if (empty($consulta)) {
                $consulta = 'ORDER BY p.id LIMIT 0,50';
            } else if (strpos($consulta, 'LIKE') !== false) {
                $consulta = 'AND ' . $consulta;
            }

            $sql = "SELECT p.id, p.nome, p.preco, p.peso, p.estoque, p.destaque
                FROM produtos as p, marcas as m, subcategorias as s WHERE 
                p.id_marca=m.id AND p.id_subcatego=s.id $consulta";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo utf8_decode("
                <tr id=$linhas[0]>
                    <td>$linhas[0]</td>
                    <td>$linhas[1]</td>
                    <td>" . $this->mudaPreco($linhas[2]) . "</td>
                    <td>" . $this->mudaPeso($linhas[3]) . "</td>
                    <td>$linhas[4]</td>
                    <td>" . $this->mudaDestaque($linhas[5]) . "</td>
                    <td class='infoImg clickable' onclick='exibirDetalhes(" . $linhas[0] . ");'>
                        <img src='../img/detalhes.png' width='25' height='25' alt='Exibir detalhes' />
                    </td>
                    <td class='infoImg clickable' onclick='exibirFotos(" . $linhas[0] . ");'>
                        <img src='../img/fotos.png' width='25' height='25' alt='Exibir fotos' />
                    </td>
                    <td class='infoImg clickable' onclick='exibirTags(" . $linhas[0] . ");'>
                        <img src='../img/tags.png' width='25' height='25' alt='Exibir tags' />
                    </td>
                    <td class='infoImg'><a href='?p=produtos/editar&id=$linhas[0]'><img src='../img/editar.png' width='25' height='25' alt='Editar' />
                        </a></td>
                    <td class='infoImg'><a href='?p=produtos/excluir&id=$linhas[0]'><img src='../img/excluir.png' width='25' height='25' alt='Excluir' />
                        </a></td>
                </tr>");
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function mudaPreco($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function mudaPeso($valor) {
        return number_format($valor, 3, ',', '.') . ' kg';
    }

    public function mudaDestaque($dest) {
        if ($dest) {
            return 'S';
        } else {
            return 'N';
        }
    }

    public function checkDestaque($dest) {
        if ($dest) {
            return 'checked';
        } else {
            return '';
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT p.*, m.*, s.*
                FROM produtos as p, marcas as m, subcategorias as s
                WHERE p.id=? AND p.id_marca = m.id AND p.id_subcatego = s.id";

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

    public function excluir($id) {
        try {
            $sql = "DELETE FROM produtos WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Exclu&iacute;do com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function exibirDetalhes($id) {
        try {
            $sql = "SELECT p.*, m.*, s.*
                FROM produtos as p, marcas as m, subcategorias as s
                WHERE p.id=? AND p.id_marca = m.id AND p.id_subcatego = s.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "/^ctrlestoque=" . $this->msgCtrlEstoque($linha[5]) . "$/
                &/^marca=$linha[11]$/
                    &/^subcategoria=$linha[14]$/
                    &/^descricao=$linha[6]$/";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function msgCtrlEstoque($ctrlest) {
        if ($ctrlest == 2) {
            return 'PRODUTO EM ESTOQUE';
        } else if ($ctrlest == 1) {
            return 'ÚLTIMAS UNIDADES DO ESTOQUE';
        } else {
            return 'PRODUTO INDISPONÍVEL';
        }
    }

    public function divCtrlEstoque($ctrlest) {
        if ($ctrlest == 2) {
            return '<div style="background-color:#a3eb36;"></div>';
        } else if ($ctrlest == 1) {
            return '<div style="background-color:#eb7b36;"></div>';
        } else {
            return '<div style="background-color:#ccc;"></div>';
        }
    }

    public function corCtrlEstoque($ctrlest) {
        if ($ctrlest == 2) {
            return 'style="border:#d5e6bc  3px solid;"';
        } else if ($ctrlest == 1) {
            return 'style="border:#edcbb7 3px solid;"';
        } else {
            return 'style="border:#ddd  3px solid;"';
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
                FROM produtos as p, marcas as m, subcategorias as s WHERE 
                p.id_marca=m.id AND p.id_subcatego=s.id $busca");

        @$quantreg = $res->fetchColumn();
        @$quant_pg = floor($quantreg / $numreg);
        @$quant_pg = $quant_pg + 1;

        return $quant_pg;
    }

    public function galeriaImg($produto) {
        try {
            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id_produto=? AND f.id_produto = p.id ORDER BY f.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $produto, PDO::PARAM_INT);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();

            if ($num < 1) {
                echo "<div id='semImg'></div>";
                return false;
            }

            echo "<div id='zoomProd'>"
            . $this->imgZoom($produto)
            . "</div>";

            if ($num < 5) {
                echo "<div id='imgGal'>"
                . $this->imgGal($produto)
                . "</div>";
            } else {
                echo "<div id='imgGal'>"
                . "<div class='cycle-slideshow vertical' 
                 data-cycle-fx='carousel'
                 data-cycle-timeout='0'
                 data-cycle-next='#nextGal'
                 data-cycle-prev='#prevGal'
                 data-cycle-carousel-visible='4'
                 data-cycle-carousel-vertical='true'
                 >"
                . $this->imgGal($produto)
                . "</div>"
                . "<div class='center'>"
                . "<a href='#' id='prevGal'> << </a>"
                . "<a href='#' id='nextGal'> >> </a>"
                . "</div>"
                . "</div>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function imgGal($produto) {
        try {
            

            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id_produto=? AND f.id_produto = p.id ORDER BY f.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $produto, PDO::PARAM_INT);
            $sqlprep->execute();

            $str = '';
            $first = true;

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if ($first || $linhas[3] == 1) {
                    $str = "<img class='galImg imgActive' src='"
                            . $this->url->getBase()
                            . "img/img_fotos/$linhas[1]' alt='$linhas[2]' title='$linhas[2]' "
                            . "onclick='$(this).addClass(\"imgActive\").siblings().removeClass(\"imgActive\"); "
                            . "$(this).addClass(\"imgActive\").siblings().children().removeClass(\"imgActive\");"
                            . "activeImg();' />";
                    $idActive = $linhas[0];
                    $first = false;
                }
            }


            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id_produto=? AND f.id <> ? AND f.id_produto = p.id ORDER BY f.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $produto, PDO::PARAM_INT);
            $sqlprep->bindParam(2, $idActive, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                $str .= "<img class='galImg' src='"
                        . $this->url->getBase()
                        . "img/img_fotos/$linhas[1]' alt='$linhas[2]' title='$linhas[2]' "
                        . "onclick='$(this).addClass(\"imgActive\").siblings().removeClass(\"imgActive\");"
                        . "$(this).addClass(\"imgActive\").parent().siblings().removeClass(\"imgActive\");"
                        . "activeImg();' />";
            }

            return $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function imgZoom($produto) {
        try {
            

            $sql = "SELECT f.* FROM fotos as f, produtos as p "
                    . "WHERE f.id_produto=? AND f.id_produto = p.id ORDER BY f.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $produto, PDO::PARAM_INT);
            $sqlprep->execute();

            $str = '';
            $first = true;

            while ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                if ($first || $linhas[3] == 1) {
                    $str = "<img id='imgZoom' src='"
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

    public function tabelaParc($preco) {
        echo "<table id='tableParc'>";

        for ($i = 11; $i > 2; $i-=2) {
            echo "<tr>"
            . "<td class='numParc'>" . $i . "</td>"
            . "<td>" . $this->mudaPreco(((float) $preco) / $i) . "</td>"
            . "<td class='numParc'>" . ($i - 1) . "</td>"
            . "<td>" . $this->mudaPreco(((float) $preco) / ($i - 1)) . "</td>"
            . "</tr>";
        }

        echo "</table>";
    }

    public function prodRelac($id) {
        try {
            

            if ($this->tagProduto($id)) {
                $subquery = $this->tagProduto($id);
            } else {
                return 0;
            }

            $sql = "SELECT DISTINCT p.* FROM produtos as p, marcas as m, subcategorias as s, tags as t 
                WHERE t.nome IN ($subquery) AND p.ctrlestoque <> 0 AND t.id_produto=p.id AND
                p.id_marca=m.id AND p.id_subcatego=s.id AND p.id <> $id ORDER BY p.id DESC LIMIT 0, 15";
            $result = $this->con->query($sql);

            $num = $result->rowCount();

            if ($num > 0) {
                echo '<h2>Veja também</h2><hr />'
                . '<div id="carousel4" class="owl-carousel owl-theme">';
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
                . "<button class='botoes'>Comprar</button>"
                . "<button class='botoes'>Carrinho</button>"
                . "</div>";
            }

            if ($num > 0) {
                echo '</div>';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function tagProduto($id) {
        try {
            $sql = "SELECT t.nome FROM tags as t WHERE t.id_produto = ?";
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
                    $str.= ", '" . $linhas[0] . "'";
                } else {
                    $str = "'" . $linhas[0] . "'";
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

    public function verifFavorito($produto, $cliente) {
        try {
            $sql = "SELECT * FROM favoritos as f WHERE f.id_produto = ? AND f.id_cliente = ?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $produto, PDO::PARAM_INT);
            $sqlprep->bindParam(2, $cliente, PDO::PARAM_INT);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();
            $first = true;

            if ($num > 0) {
                echo "<div class='favoritar favoritado' onclick='favoritar(" . $produto . ");'></div>";
            } else {
                echo "<div class='favoritar' onclick='favoritar(" . $produto . ");'></div>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function exibirFavoritos($cliente) {
        try {
            

            if ($this->listarFavoritados($cliente)) {
                $favoritados = $this->listarFavoritados($cliente);
            } else {
                echo "<div id='semFavorito'>Você não possui nenhum produto favoritado! <br />"
                . "Clique na &#9734; ao lado do nome do produto para favoritá-lo.</div>";
                return 0;
            }

            $sql = "SELECT p.*, m.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.id IN ($favoritados) AND p.id_marca=m.id AND p.id_subcatego=s.id ORDER BY p.nome";
            $result = $this->con->query($sql);
            $num = $result->rowCount();

            if ($num <= 0) {
                echo "<div id='semFavorito'>Você não possui nenhum produto favoritado! <br />"
                . "Clique na &#9734; ao lado do nome do produto para favoritá-lo.</div>";
                return false;
            }

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<a href='" . $this->readableUrl($this->url->getBase() . "produto/$linhas[0]/$linhas[1]") . "'>"
                . "<div class='prodFavoritado prodListado'>"
                . "<div class='imgFavoritado imgListado'" . $this->corCtrlEstoque($linhas[5]) . ">"
                . $this->imgProduto($linhas[0])
                . "</div>"
                . "<div class='descFavoritado descListado'>"
                . "<h3>$linhas[1] - $linhas[11]</h3>"
                . "<div class='estoFavoritado estoListado'>"
                . $this->msgCtrlEstoque($linhas[5])
                . "</div>"
                . "<div class='precoFavoritado precoListado'>"
                . $this->mudaPreco($linhas[2])
                . "</div>"
                . "</div>"
                . "</div>"
                . "</a>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarFavoritados($cliente) {
        try {
            $sql = "SELECT f.id_produto FROM favoritos as f, clientes as cl, produtos as p "
                    . "WHERE f.id_cliente = $cliente AND f.id_produto=p.id AND f.id_cliente=cl.id ORDER BY f.id DESC";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $cliente, PDO::PARAM_INT);
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

    public function exibirHistorico($hist) {
        try {
            

            if ($this->listarHistorico($hist)) {
                $historico = $this->listarHistorico($hist);
            } else {
                echo "<div id='semHistorico'>Não há nenhum registro no histórico! <br />"
                . "Dê uma volta pelo BuyOn e volte aqui de novo.</div>";
                return 0;
            }

            $sql = "SELECT p.*, m.* FROM produtos as p, marcas as m, subcategorias as s 
                WHERE p.id IN ($historico) AND p.id_marca=m.id AND p.id_subcatego=s.id "
                    . "ORDER BY FIELD(p.id, $historico)";
            $result = $this->con->query($sql);
            $num = $result->rowCount();

            if ($num <= 0) {
                echo "<div id='semHistorico'>Não há nenhum registro no histórico! <br />"
                . "Dê uma volta pelo BuyOn e volte aqui de novo.</div>";
                return false;
            }

            for ($i = 0; $i < count($hist); $i++) {
                $datatempo[$hist[$i][0]] = $hist[$i][1];
            }

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<a href='" . $this->readableUrl($this->url->getBase() . "produto/$linhas[0]/$linhas[1]") . "'>"
                . "<div class='prodHistorico prodListado'>"
                . "<div class='imgHistorico imgListado'" . $this->corCtrlEstoque($linhas[5]) . ">"
                . $this->imgProduto($linhas[0])
                . "</div>"
                . "<div class='descHistorico descListado'>"
                . "<h3>$linhas[1] - $linhas[11]</h3>"
                . "<div class='estoHistorico estoListado'>"
                . $this->msgCtrlEstoque($linhas[5])
                . "</div>"
                . "<div class='precoHistorico precoListado'>"
                . $this->mudaPreco($linhas[2])
                . "</div>"
                . "</div>"
                . "<div class='tempoHistorico'>"
                . "&#9679; Visto pela última vez em " . $datatempo[$linhas[0]]
                . "</div>"
                . "</div>"
                . "</a>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarHistorico($hist) {
        try {
            $first = true;

            for ($i = 0; $i < count($hist); $i++) {
                if (!$first) {
                    $str.= "," . $hist[$i][0];
                } else {
                    $str = $hist[$i][0];
                    $first = false;
                }
            }

            return $str;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function nomeProduto($str) {
        $len = 45;

        if (strlen($str) < $len) {
            return $str;
        } else {
            return substr($str, 0, $len) . "...";
        }
    }

    public function readableUrl($url) {
        return str_replace(" ", "-", $url);
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->preco = "";
        $this->peso = "";
        $this->estoque = "";
        $this->ctrlestoque = "";
        $this->descricao = "";
        $this->destaque = "";
        $this->id_marca = "";
        $this->id_subcatego = "";
        $this->con = "";
    }

}

?>
