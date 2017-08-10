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
    $e = new Categoria();
    $n = new Produto();
    $in = new Imagem();
    $ct = new Controles();

    $vetor = $n->carregar($ct->limparTexto((int) $_GET['id']));
    ?>

    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar Produto</h3>
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Categoria:</label>
                    <select name="cbocat">
                        <option value="<?php echo $vetor[6]; ?>">
                            <?php echo $vetor[7]; ?>
                        </option>
                        <option>Escolha uma nova Categoria</option>
                        <?php $e->carregarSelect(); ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Descrição:</label> <br />
                    <input name="txtdescricao" maxlength="100" type="text" size="50"
                           value="<?php echo $vetor[2]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Dados:</label> <br />
                    <textarea rows="3" name="txtdados" placeholder="Dados Técnicos aqui">
                        <?php echo $vetor[4]; ?>
                    </textarea> 
                </td>
            </tr> 

            <tr>
                <td>
                    <label>Tipo:</label>
                    <select name="cbotipo">
                        <option value="<?php echo $vetor[5]; ?>">
                            <?php echo $vetor[5]; ?>
                        </option>
                        <option>Escolha um Tipo de Item</option>
                        <option value="produtos">Produtos</option>
                        <option value="produtos-acabados">Produtos Acabados</option>
                        <option value="equipamentos">Equipamentos</option>
                    </select>
                </td>
            </tr>

            

            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Alterar Produto">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtdescricao']) && !empty($_POST['txtdados'])) {

            extract($_POST, EXTR_OVERWRITE);
            //noticia

            $n->setId($vetor[0]);
            $n->setDescricao(strtr(strtoupper($txtdescricao), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            $n->setDados($txtdados);
            $n->setTipo(strtr(strtoupper($cbotipo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            //$n->setData(date("Y-m-d"));
            $n->setUrl($ct->retirarAcentos(strtolower($txtdescricao)));
            $n->setId_categoria($cbocat);

            //echo $txttitulo. " ".$txtconteudo." ".$cboeixo;

            $n->editar();
            echo "<script language='javaScript'>window.location.href='?p=produto/consultar'</script>";
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
