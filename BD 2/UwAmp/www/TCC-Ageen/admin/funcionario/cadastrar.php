
    <style>
        span {
            display: none;
        }
    </style>

    <form name="cadastrar" id="cadastrar" method="post" 
          enctype="multipart/form-data">

        <h3>Cadastro de Funcionário</h3>

        Nome<br>
        <input name="txtnome" id="txtnome" size="40"
               maxlength="50" type="text">
        <span>Nome do depto</span>
        <br><br>
        Salário<br>
        <input type="text" name="txtsalario" class="real" maxlength="10">

        <br><br>
        Departamento<br>
        <select name="cbodepto" id="cbodepto">
            <?php
            include_once '../class/Departamento.php';
            $d = new Departamento();
            $d->carregarSelect();
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
    if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtsalario'])) {

        extract($_POST, EXTR_OVERWRITE);
        include_once '../class/Controles.php';
        $ct = new Controles();
        include_once '../class/Funcionario.php';
        $f = new Funcionario();
        include_once '../class/ImagemFuncionario.php';
        $if = new ImagemFuncionario();

        $f->setNome($txtnome);
        $f->setSalario($ct->moeda($txtsalario));
        $f->setId_depto($cbodepto);
        $f->setUrl($ct->retirarAcentos($txtnome));
        $f->salvar();

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
                if (move_uploaded_file($tmp_imagem[$i], "../foto_funcionario/" . $novonome)) {
                    echo "Arquivo enviado com sucesso " .
                    $imagem[$i] . "<br>";
                    $if->setNome($novonome);
                    $if->salvar();
                } else {
                    echo "<br>Arquivo não enviado " . $imagem[$i];
                }
            } else {
                echo '<br>Arquivo não autorizado';
            }
        }
    }

?>