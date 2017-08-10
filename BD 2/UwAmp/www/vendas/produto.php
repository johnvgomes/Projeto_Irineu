<?php
include_once 'class/Produtos.php';
include_once 'class/Controles.php';

$p = new Produtos();
$co = new Controles();

$id = (int) $co->limparTexto($url->getURL(1));
$nome = urldecode($url->getURL(2));

$vetor = $p->carregar($id);

if ($vetor) {

    if (isset($_SESSION['historico'])) {
        foreach ($_SESSION['historico'] as $i => $hist) {
            if ($hist[0] == $id) {
                unset($_SESSION['historico'][$i]);
            }
        }

        $_SESSION['historico'] = array_values($_SESSION['historico']);
    }

    date_default_timezone_set('America/Sao_Paulo');
    $_SESSION['historico'][] = array($id, date("d/m/Y H:i:s"));
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <div id="nomeProd">
        <h1>
            <?php echo $vetor[1]; ?> <span id="marcaProd">(<?php echo $vetor[11]; ?>)</span>
            <?php
            if (isset($_SESSION['cliente'])) {
                $p->verifFavorito($id, $_SESSION['clienteId']);
            }
            ?>
        </h1>
    </div>

    <div id="imgProd">
        <?php $p->galeriaImg($id); ?>
    </div>

    <div id="contProd">
        <div id="estoqueProd"><?php echo $p->msgCtrlEstoque($vetor[5]) . " " . $p->divCtrlEstoque($vetor[5]); ?></div>
        <div id="valorProd">
            <div id="antValor">De <?php echo $p->mudaPreco(((float) $vetor[2]) * 1.1); ?> por</div>
            <div id="novValor"><?php echo $p->mudaPreco($vetor[2]); ?> <span id="avista">à vista</span></div>
            <div id="parcelado">ou até 12&times; de <?php echo $p->mudaPreco(((float) $vetor[2]) / 12); ?> sem juros</div>
        </div>
        <div id="parcelas">
            <?php $p->tabelaParc($vetor[2]); ?>
        </div>

        <div id="freteGratis">Frete grátis para sudeste e região norte</div>

        <?php
        if ($vetor[5] != 0) {
            echo '<div id="botoesProd">
            <button id="btnComprar" onclick="'.$url->getBase().'comprar(' . $id . ');"></button>
            <button id="addCarrinho" onclick="'.$url->getBase().'carrinho(' . $id . ');"></button>
        </div>';
        } else {
            echo '<div id="semProduto">'
            . ' <button id="btnComprar"></button>'
            . ' <button id="addCarrinho"></button>'
            . 'Desculpe-nos, este produto está indisponível no momento! :('
            . '</div>';
        }
        ?>
    </div>

    <div id="descriProd">
        <div id="descriTitle">
            <h2>Descrição</h2>
        </div>
        <div id="descriCont">
            <?php echo $vetor[6]; ?>
        </div>
    </div>

    <div id="relacProd">
        <div class="carousels">
            <?php $p->prodRelac($id); ?>
        </div>
    </div>

    <div id="comentBox">
        <h2>Comentários</h2>
        <div id="comentProd">
            <div class="fb-comments" data-href="<?php echo $url->getBase() . $id . "/" . $nome; ?>" data-width="1100" data-numposts="5" data-colorscheme="light"></div>
        </div>
    </div>

    <div id="fb-root"></div>
    <script type="text/javascript">
        $("#imgZoom").elevateZoom(
                {constrainType: "height", constrainSize: 274, zoomType: "lens", containLensZoom: true, gallery: 'gal1', cursor: 'pointer', galleryActiveClass: "active"}
        );

        $(document).ready(function() {
            var owl4 = $("#carousel4");

            owl4.owlCarousel({
                itemsCustom: [
                    [0, 5],
                    [450, 5],
                    [600, 5],
                    [700, 5],
                    [1000, 5],
                    [1200, 5],
                    [1400, 5],
                    [1600, 5]
                ],
                navigation: false
            });

        });

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <?php
} else {
    echo '404';
}
?>