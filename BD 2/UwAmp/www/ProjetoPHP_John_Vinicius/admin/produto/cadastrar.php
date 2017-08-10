<style>
    span {
        display: none;
    }     

</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<div id="site">

    <div id="conteudo">
        <div id="topo">

            <marquee OnMouseOut="javascript:this.start()"
                     scrolldelay="33">

                <h1 class="cabecalho_um"> Cadastro de Produto</h1>
            </marquee>
        </div>
        <h1 class="conteudo">
            <form name="depto" id="depto" method="post" 
                  enctype="multipart/form-data">
                <!--
                                    <h3>Cadastro de Produto</h3>
                -->


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
 </div>

    <div id="rodape">
        <h2 class="format">
            <pre>Desenvolvido pelo 3TI ETEC
                                
            </pre></h2>
    </div>

</div>
            <script>
                $("input").focus(function() {
                    $(this).next("span").css("display", "inline").fadeOut(1000);
                });
            </script>

            <?php
            if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtvalorunit']) && !empty($_POST['txtestoque'])) {

                extract($_POST, EXTR_OVERWRITE);

                include_once '../class/produto.php';
                $pr = new Produto();
                $pr->setNome($txtnome);
                $pr->setValorunit($txtvalorunit);
                $pr->setEstoque($txtestoque);
                $pr->setId_fabricante($cbofabricante);
                $pr->salvar();

                //cadastrando imagens
            }
            ?>