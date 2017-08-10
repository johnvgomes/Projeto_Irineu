<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
    <form name="cadastro" id="form" method="post" >
        <table>
            <tr>
                <td>
                    <h3>Cadastro de Pagina</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Titulo:</label> <br />
                    <input name="txttitulo" maxlength="100" type="text"
                           size="50"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Link (se houver):</label> <br />
                    <input name="txtlink" maxlength="100" type="text" 
                           size="50"> 
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
                <td><input type="submit" name="btn" /></td>
            </tr>

        </table>
    </form>

    <?php
    if (isset($_POST['btn'])) {
        include_once '../class/Pagina.php';
        include_once '../class/Controles.php';
        $p = new Pagina();
        $ct = new Controles();

        extract($_POST, EXTR_OVERWRITE);

        $p->setUrl($ct->retirarAcentos(strtolower($txttitulo)));
        $p->setTitulo(strtr(strtoupper($txttitulo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));      
        $p->setConteudo($txtconteudo);
        $p->setLink($txtlink);
        $p->salvar();
    }
}
?>
