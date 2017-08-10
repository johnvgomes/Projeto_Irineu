<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Eixo.php';
    include_once '../class/Noticia.php';
    include_once '../class/ImagemNoticia.php';
    include_once '../class/Controles.php';
    $e = new Eixo();
    ?>

    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de Noticia</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Titulo:</label> <br />
                    <input name="txttitulo" maxlength="100" type="text"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Conteudo:</label> <br />
                    <textarea rows="3" name="txtconteudo" placeholder="Conteúdo aqui">

                    </textarea> 
                </td>
            </tr> 
            <tr>
                <td>
                    <label>Eixo:</label>
                    <select name="cboeixo">
                        <option>Escolha um Eixo Tecnológico</option>
                        <?php $e->carregarSelect(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Imagem:</label>    
                    <input type="file" name="imagem[]" multiple>    
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Notícia">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['txttitulo']) && !empty($_POST['txtconteudo']) &&
                isset($_FILES['imagem'])) {

            extract($_POST, EXTR_OVERWRITE);
            //noticia
            $n = new Noticia();
            $in = new ImagemNoticia();
            $ct = new Controles();

            $n->setTitulo(strtr(strtoupper($txttitulo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            $n->setConteudo($txtconteudo);
            $n->setData(date("Y-m-d"));
            $n->setUrl($ct->retirarAcentos(strtolower($txttitulo)));
            $n->setId_eixo($cboeixo);

            $n->salvar();

            /*
             * echo $n->getTitulo()."<br>".
              $n->getConteudo()."<br>".
              $n->getData()."<br>".
              $n->getUrl()."<br>".
              $n->getId_eixo()."<br>";
             * 
             */

            //imagem_noticia
            $imagem = $_FILES['imagem']['name'];
            $tmp_imagem = $_FILES['imagem']['tmp_name'];

            $extensoes = array(".gif", ".jpeg", ".jpg", ".png", ".bmp");

            for ($i = 0; $i < count($tmp_imagem); $i++) {
                $ext = strtolower(substr($imagem[$i], -4));

                if (in_array($ext, $extensoes)) {
                    //renomeando a imagem
                    $newnome = date("Ymdhis").md5($imagem[$i]);
                    
                    if (move_uploaded_file($tmp_imagem[$i], "../imagem_noticia/" . $newnome.$ext)) {
                        echo 'O Arquivo <strong>' . $imagem[$i] . '</strong> foi enviado com sucesso<br />';
                        $in->setNome($newnome.$ext);
                        $in->salvar();
                    } else {
                        echo 'Erro no arquivo <strong>' . $imagem[$i] . '</strong><br />';
                    }
                }
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
