<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Eixo.php';
    include_once '../class/Noticia.php';
    include_once '../class/Controles.php';
    $e = new Eixo();
    $n = new Noticia();
    $ct = new Controles();

    $vetor = $n->carregar($ct->limparTexto((int) $_GET['id']));
    ?>

    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar Noticia</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Titulo:</label> <br />
                    <input name="txttitulo" maxlength="100" type="text"
                           value="<?php echo $vetor[1]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Conteudo:</label> <br />
                    <textarea rows="3" name="txtconteudo" placeholder="Conteúdo aqui">
                        <?php echo $vetor[3]; ?>
                    </textarea> 
                </td>
            </tr> 
            <tr>
                <td>
                    <label>Eixo:</label>
                    <select name="cboeixo">
                        <option value="<?php echo $vetor[5]; ?>">
                            <?php echo $vetor[7]; ?>
                        </option>
                        <option>Escolha um novo Eixo Tecnológico</option>
                        <?php $e->carregarSelect(); ?>
                    </select>
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
        if (!empty($_POST['txttitulo']) && !empty($_POST['txtconteudo'])) {

            extract($_POST, EXTR_OVERWRITE);
            //noticia

            $n->setId($vetor[0]);
            $n->setTitulo(strtr(strtoupper($txttitulo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            $n->setConteudo($txtconteudo);
            //$n->setData(date("Y-m-d"));
            $n->setUrl($ct->retirarAcentos(strtolower($txttitulo)));
            $n->setId_eixo($cboeixo);
            
            //echo $txttitulo. " ".$txtconteudo." ".$cboeixo;

            $n->editar();
            echo "<script language='javaScript'>window.location.href='?p=noticia/consultar'</script>";
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
