<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
} else {


    include_once '../class/Unidade.php';
    $u = new Unidade();
    ?>

    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de Calendário</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Unidade:</label>
                    <select name="cbounidade">
                        <option>Escolha uma Unidade</option>
                        <?php $u->carregarSelect(); ?>
                    </select>
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

        include_once '../class/Calendario.php';
        $c = new Calendario();

        $tparquivo = $arquivo['tmp_name'];
        $arquivo = $arquivo['name'];

        $c->setId_unidade($cbounidade);
        $c->setAno($txtano);
        $c->setArquivo($arquivo);
        $c->setTparquivo($tparquivo);
        
        /*
        echo $c->getId_unidade() . " " .$c->getAno() . " "
                .$c->getArquivo() . " "
                .$c->getTparquivo() ;
         * 
         */
        
        $c->salvar();
    }
}
?>