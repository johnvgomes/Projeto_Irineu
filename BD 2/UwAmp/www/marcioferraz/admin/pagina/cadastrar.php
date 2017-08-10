<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
    <form name="cadastro" id="form" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <h3>Cadastro de Pagina</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Url amigavel:</label> <br />
                    <input name="txturl" maxlength="100" type="text" /> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Titulo:</label> <br />
                    <input name="txttitulo" maxlength="100" type="text" /> 
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
                    <label>Icone:</label> 
                    <input name="arqicone" type="file" /> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Imagem:</label> 
                    <input name="arqimagem" type="file" /> 
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="btn" /></td>
            </tr>

        </table>
    </form>

    <?php
    if (isset($_POST['btn'])) {
        include_once '../class/Pagina.php';
        $p = new Pagina();

        $icone = $_FILES['arqicone']['name'];
        $iconetemp = $_FILES['arqicone']['tmp_name'];

        $imagem = $_FILES['arqimagem']['name'];
        $imagemtemp = $_FILES['arqimagem']['tmp_name'];

        extract($_POST, EXTR_OVERWRITE);

        $p->setUrl($txturl);
        $p->setTitulo(strtr(strtoupper($txttitulo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        
        $p->setConteudo($txtconteudo);

        $p->setTemp_icone($iconetemp);
        $p->setIcone($icone);

        $p->setTemp_imagem($imagemtemp);
        $p->setImagem($imagem);

        $p->salvar();
    }
}
?>
