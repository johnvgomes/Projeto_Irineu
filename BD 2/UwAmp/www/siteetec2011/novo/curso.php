<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+"/novo/curso/"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<?php
    require_once 'class/Curso.php';
    $c = new Curso();
?>
<form id="form1" name="form1" enctype="multipart/form-data" method="get" action="">
    <table>
        <tr><td><h3>Escolha o Curso</h3></td></tr>
        <tr>
            <td>
                <select name="cbcurso" id="combo" onchange="MM_jumpMenu('parent',this,0)">
                    <?php $c->carregarCur(); ?>
                </select>
            </td>
        </tr>
    </table>
</form>
<?php
$c->mostrar(Url::getURL(1),"");

?>