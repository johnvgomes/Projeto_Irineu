<style>
    span {
        display: none;
    }     

</style>
<form name="cadastrar" id="cadastrar" method="post" 
      enctype="multipart/form-data">

    <h3>Cadastro de Produto</h3>

    Nome<br>
    <input name="txtnome" id="txtnome" size="40"
           maxlength="50" type="text">
    <span>Nome do Produto</span>
    <br><br>
    Valor Unidade<br>
    <input name="txtvalorunit" id="txtvalorunit" class="real" type="text">
    <br><br>
    Estoque<br>
    <input name="txtestoque" id="txtestoque" type="number"
           min="1" max="999">
    <br><br>
    Fabricante<br>
    <select name="cbofabricante" id="cbofabricante">
        <?php
        include_once '../class/Fabricante.php';
        $p = new Fabricante();
        $p->carregarSelect();
        ?>
    </select>
    <br><br>
    Escolha foto(s):<br>
    <input type="file" name="arquivo[]" id="arquivo" multiple>
    <br><br>
    <input type="submit" name="btn" id="btn"
           value="enviar">    
</form>

<script>
    $("input").focus(function() {
        $(this).next("span").css("display", "inline").fadeOut(1000);
    });
</script>

<?php
if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtestoque']) && !empty($_POST['txtvalorunit'])) {

    extract($_POST, EXTR_OVERWRITE);
    include_once '../class/Controles.php';
    $ct = new Controles();
    include_once '../class/Produto.php';
    $p = new Produto();
    include_once '../class/ImagemProduto.php';
    $ip = new ImagemProduto();

    $p->setNome($txtnome);
    $p->setValorunit($ct->moeda($txtvalorunit));
    $p->setEstoque($txtestoque);
    $p->setId_fabricante($cbofabricante);
    $p->setUrl($ct->retirarAcentos($txtnome));

    $p->salvar();
    //cadastrando imagens
    $imagem = $_FILES['arquivo']['name'];
    $tmp_imagem = $_FILES['arquivo']['tmp_name'];

    $extensoes = array(".jpg", ".png");

    //loop para manipular cada um dos arquivos 
    for ($i = 0; $i < count($tmp_imagem); $i++) {
        //captura a extensão do arquivo selecionado
        $ext = strtolower(substr($imagem[$i], -4));
        //verifica se a extensão do arquivo é valida
        if (in_array($ext, $extensoes)) {
            $novonome = date("Ymdhis") . sha1($imagem[$i]) . $ext;

            //envio e cadastro no bd das imagens
            if (move_uploaded_file($tmp_imagem[$i], "../foto_produto/" . $novonome)) {
                echo "Arquivo enviado com sucesso " .
                $imagem[$i] . "<br>";
                $ip->setNome($novonome);
                $ip->salvar();
            } else {
                echo "<br>Arquivo não enviado " . $imagem[$i];
            }
        } else {
            echo '<br>Arquivo não autorizado';
        }
    }
}
?>