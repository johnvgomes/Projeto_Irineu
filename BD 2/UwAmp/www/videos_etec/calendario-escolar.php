<script type="text/javascript">
    function MM_jumpMenu(targ, selObj, restore) { //v3.0
        eval(targ + ".location='" + "/videos_etec/calendario-escolar/" + selObj.options[selObj.selectedIndex].value + "'");
        if (restore)
            selObj.selectedIndex = 0;
    }
</script>
<?php
include_once 'class/Calendario.php';
include_once 'class/Controles.php';
include_once 'class/Url.php';
$url = new Url();
$co = new Controles();
$c = new Calendario();
@$ano = (int) $co->limparTexto($url->getURL(1))
?>
<form id="form1" name="form1" enctype="multipart/form-data" method="get" action="">
    <table>
        <tr><td><h3>Escolha o Ano para visualizar o calend&aacute;rio</h3></td></tr>
        <tr>
            <td>
                <select name="cbano" id="combo" onchange="MM_jumpMenu('parent', this, 0)">
                    <option value="">Determine o ano aqui</option>
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
            </td>
        </tr>
    </table>
</form>
<?php
if (!empty($ano) || !isset($ano)) {
    $c->mostrar($ano, $url->getBase());
} else {

    echo "<div class='pgcurso'>
        <img src='".$url->getBase()."imagem/calendario.png' alt='Calendário'>
        <h4>Calendário Escolar</h4>
        Contempla o início das atividades escolares para os professores; 
        início e término das aulas; planejamento; 
        período de férias e recessos para alunos e professores.
    </div>";
}
?>