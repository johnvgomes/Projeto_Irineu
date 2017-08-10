<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='?p=calendario.php&ano="+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<?php
require_once 'class/Calendario.php';
require_once 'class/Controles.php';
$co = new Controles();
$c = new Calendario();
$ano = (int) $co->limparTexto($_GET['ano']);
?>
<form id="form1" name="form1" enctype="multipart/form-data" method="get" action="">
    <table>
        <tr><td><h3>Escolha o Ano para visualizar o calend&aacute;rio</h3></td></tr>
        <tr>
            <td>
                <select name="cbano" id="combo" onchange="MM_jumpMenu('parent',this,0)">
                    <option value="">Determine o ano aqui</option>
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
    </table>
</form>
<?php
if(!empty($ano))
    $c->mostrar($ano,"adm");
?>