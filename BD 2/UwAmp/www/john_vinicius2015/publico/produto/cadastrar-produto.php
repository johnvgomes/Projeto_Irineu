<style>
    span {
        display: none;
    }     

</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<h3>Cadastro de Produto</h3>

Nome<br>
<input name="txtnome" id="txtnome" size="40"
       maxlength="50" type="text">
<span>Nome do Produto</span>
<br><br>
Valor Unidade<br>
<input name="txtvalorunit" id="txtvalorunit" class="real"
       type="text">
<br><br>
Estoque<br>
<input name="txtestoque" id="txtestoque" type="number"
       min="1" max="999">
<br><br>
Fabricante<br>
<select name="cbofabricante" id="cbofabricante">
    <?php
    include_once '../class/Fabricante.php';
    $f = new Fabricante();
    $f->carregarSelect();
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
if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtvalorunit']) && !empty($_POST['txtestoque'])) {

    extract($_POST, EXTR_OVERWRITE);

    include_once '../class/Produto.php';
    $pr = new Produto();
    $pr->setNome($txtnome);
    $pr->setValorunit($txtvalorunit);
    $pr->setEstoque($txtestoque);
    $pr->setId_fabricante($cbofabricante);
    $pr->salvar();

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
                $pr->setNome($novonome);
                $pr->salvar();
            } else {
                echo "<br>Arquivo não enviado " . $imagem[$i];
            }
        } else {
            echo '<br>Arquivo não autorizado';
        }
    }
}

?>