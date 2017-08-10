<h3>Material e informações para o Aluno</h3>
<?php
include_once 'class/TCC.php';
include_once 'class/Controles.php';
include_once 'class/Url.php';
include_once 'class/Curso.php';
include_once 'class/Arquivo.php';
$url = new Url();
$co = new Controles();
$t = new TCC();
$c = new Curso();
$a = new Arquivo();

echo "<div class='pgcurso'>";
$a->consultar($url->getBase(), "Aluno com arquivo");
$a->consultar("", "Aluno sem arquivo");

echo "<br><br><br><br><br><br>";
/*
 * <a href='" . $url->getBase() . "manual-aluno/" .$a->consultar("manual_aluno")."' title='Manual do Aluno' target='_blank'>Acesse aqui</a>
  <br> Manual do TCC
  <a href='" . $url->getBase() . "manual-tcc/" .$a->consultar("manual_tcc")."' title='Manual do TCC' target='_blank'>Acesse aqui</a>
  <br>
 */
?>
<form id="form1" name="form1" action="" method="post">
    <table>
        <tr><td><br><br><h4>Para consultar os Trabalhos de 
                    Conclusão de Curso, determine o Curso e o ano abaixo</h4></td></tr>
        <tr>
            <td>
                <select name="cbocurso" id="combo">
                    <option>Escolha o curso aqui</option>
                    <?php
                    $c->carregarSelect("tcc");
                    ?>
                </select>
                &nbsp;
                <select name="cboano" id="combo">
                    <option value="">Escolha o ano aqui</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
                &nbsp;
                <input name="btn" type="submit" id="pesquisaraluno" value="" >
            </td>
        </tr>
    </table>
</form>
<br>
<?php
if (isset($_POST['btn'])) {
    //echo $_POST['cbocurso'] . "<br>" . $_POST['cboano'];

    $t->mostrar($_POST['cbocurso'], $_POST['cboano'], $url->getBase());
} else {

    echo "Caso queira consultar os TCCs dos diferentes cursos, escolha o "
    . "curso e o ano em que o TCC foi executado.";
}
echo " </div>";
?>
