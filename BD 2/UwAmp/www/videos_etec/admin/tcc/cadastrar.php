<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
} else {


    include_once '../class/Curso.php';
    $c = new Curso();
    ?>

    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de TCC</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Curso:</label>
                    <select name="cbocurso">
                        <option>Escolha o curso</option>
                        <?php $c->carregarSelect(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Título:</label>
                    <input name="txttitulo" type="text" 
                           maxlength="120"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Descrição:</label>
                    <textarea name="txtdescricao" rows="3"></textarea>
                </td>
            </tr>            
            <tr>
                <td>
                    <label>Ano:</label>
                    <input name="txtano" type="number" min="2014" max="3000"> 
                </td>
            </tr>

            <tr>
                <td>
                    <label>Arquivo:</label>    
                    <input type="file" name="arquivo">    
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Calendário">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        $arquivo = $_FILES["arquivo"];

        extract($_POST, EXTR_OVERWRITE);

        include_once '../class/TCC.php';
        $t = new TCC();
        include_once '../class/Controles.php';
        $ct = new Controles();

        $tparquivo = $arquivo['tmp_name'];
        $arquivo = $arquivo['name'];

        $extensoes = array(".pdf");
        $ext = strtolower(substr($arquivo, -4));

        if (in_array($ext, $extensoes)) {
            //alterando o nome da imagem com md5
            $novonome = date("Ymdhis") . md5($arquivo) . $ext;
        }
        
        $t->setId_curso($cbocurso);
        $t->setAno($txtano);
        $t->setArquivo($novonome);
        $t->setTparquivo($tparquivo);
        $t->setTitulo(strtr(strtoupper($txttitulo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $t->setUrl($ct->retirarAcentos(strtolower($txttitulo)));
        $t->setDescricao($txtdescricao);

        $t->salvar();
    }
}
?>