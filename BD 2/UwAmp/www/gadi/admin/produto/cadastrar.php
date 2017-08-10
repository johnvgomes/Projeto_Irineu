<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Categoria.php';
    include_once '../class/Produto.php';
    include_once '../class/Imagem.php';
    include_once '../class/Controles.php';
    include_once '../class/Redimensionar.php';
    $e = new Categoria();
    ?>

    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de Produto</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Descrição:</label> <br />
                    <input name="txttitulo" maxlength="100" type="text" size="50"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Dados:</label> <br />
                    <textarea rows="3" name="txtconteudo" placeholder="Conteúdo aqui">

                    </textarea> 
                </td>
            </tr> 

            <tr>
                <td>
                    <label>Tipo:</label>
                    <select name="cbotipo">
                        <option>Escolha um Tipo de Item</option>
                        <option value="produtos">Produtos</option>
                        <option value="produtos-acabados">Produtos Acabados</option>
                        <option value="equipamentos">Equipamentos</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Categoria:</label>
                    <select name="cboeixo">
                        <option>Escolha uma Categoria</option>
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
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Produto">
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
            $n = new Produto();
            $in = new Imagem();
            $ct = new Controles();
            $r = new Redimensionar();

            $n->setDescricao(strtr(strtoupper($txttitulo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            $n->setDados($txtconteudo);
            $n->setUrl($ct->retirarAcentos(strtolower($txttitulo)));
            $n->setId_categoria($cboeixo);
            $n->setTipo(strtr(strtoupper($cbotipo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));

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
                    $newnome = date("Ymdhis") . md5($imagem[$i]);

                    if (move_uploaded_file($tmp_imagem[$i], "../imagem_produto/" . $newnome . $ext)) {
                        echo 'O Arquivo <strong>' . $imagem[$i] . '</strong> foi enviado com sucesso<br />';
                        $in->setNome($newnome . $ext);
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
