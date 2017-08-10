<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+"/videos_etec/curso/"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<?php
include_once 'class/Curso.php';
include_once 'class/Controles.php';
include_once 'class/Url.php';
$url = new Url();
$co = new Controles();
$c = new Curso();
@$curso = $co->limparTexto($url->getURL(1))
?>
<form id="form1" name="form1" enctype="multipart/form-data" method="get" action="">
    <table>
        <tr><td><h3>Escolha o Curso abaixo</h3></td></tr>
        <tr>
            <td>
                <select name="cbcurso" id="combo" onchange="MM_jumpMenu('parent',this,0)">
                    <option>Escolha o curso aqui</option>
                    <?php
                        $c->carregarSelect("curso");
                    ?>
                </select>
            </td>
        </tr>
    </table>
</form>
<?php
if(!empty($curso) || !isset($curso)){
    $c->mostrar($curso, $url->getBase());
} else {

    echo "<div class='pgcurso'>
        <img src='".$url->getBase()."imagem/calendario.png' alt='Calendário'>
        <h4>Cursos Técnicos e Técnicos Integrados ao Ensino Médio</h4>
        Contempla o início das atividades escolares para os professores; 
        início e término das aulas; planejamento; 
        período de férias e recessos para alunos e professores.
    </div>";
}
?>