
<?php

   
    require_once 'class/Curso.php';
    $c = new Curso;
?>

<form action="" method="post" enctype="multipart/form-data" name="form">
    <table>
        <tr>
            <td colspan="2"><h3>Formul&aacute;rio de Cadastro de Ata de Conselho</h3></td>
        </tr>
        <tr>
            <td>Curso:</td>
            <td>
                <select name="cbcurso">
                    <?php $c->carregarCurs(); ?>
                    <option value="etiminfo">ETIM Informatica</option>
                    <option value="etimma">ETIM Meio Ambiente</option>
                    <option value="retimnet">RETIM Infonet</option>
                    <option value="retimlog">RETIM Logistica</option>
                    <option value="retimadm">RETIM Administra&ccedil;&atilde;o</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>M&oacute;dulo/S&eacute;rie</td>
            <td>
                <select name="cbmodulo">
                    <option value="1modulo">1&ordm; m&oacute;dulo</option>
                    <option value="2modulo">2&ordm; m&oacute;dulo</option>
                    <option value="3modulo">3&ordm; m&oacute;dulo</option>
                    <option value="1ano">1&ordm; ano</option>
                    <option value="2ano">2&ordm; ano</option>
                    <option value="3ano">3&ordm; ano</option>
                    <option value="2anoA">2&ordm; ano A</option>
                    <option value="2anoB">2&ordm; ano B</option>
                    <option value="3anoA">3&ordm; ano A</option>
                    <option value="3anoB">3&ordm; ano B</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Ano:</td>
            <td>
                <select name="cbano" id="cbano">
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
            </select>
         </td>
        </tr>
        <tr>
            <td>Semestre:</td>
            <td>
                <select name="cbsemestre" id="cbsemestre">
                    <option value="1">1&ordm; semestre</option>
                    <option value="2">2&ordm; semestre</option>
               </select>
            </td>
        </tr>
        <tr>
            <td>Tipo:</td>
            <td>
                <select name="cbtipo" id="cbtipo">
                    <option value="p">Parcial</option>
                    <option value="f">Final</option>
               </select>
            </td>
        </tr> 
        <tr>
            <td colspan="2"><input type="submit" name="consultar" id="consultar" value="consultar" /></td>
        </tr>
    </table>
    
</form>

<?php
if(isset($_POST['consultar']) ){
    require_once 'class/Conselho.php';
    $cs = new Conselho();
    $cs->mostrar($_POST['cbcurso'], $_POST['cbmodulo'], 
        $_POST['cbano'],$_POST['cbsemestre'], 
        $_POST['cbtipo'],""); 
   
}

?>
