
<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    include_once '../class/Pagina.php';
    include_once '../class/Controles.php';

    $p = new Pagina();
    $co = new Controles();
    ?>

    <script type="text/javascript">
        function saltar(targ, selObj, restore) { //v3.0
            eval(targ + ".location='?p=pagina/consultar&id=" + selObj.options[selObj.selectedIndex].value + "'");
            if (restore)
                selObj.selectedIndex = 0;
        }
    </script>

    <form id="frmConsultar" name="form1" method="get" action="">
        <table>
            <tr><td><h3>Escolha a Pagina para visualizar</h3></td></tr>
            <tr>
                <td>
                    <select name="cbp" id="combo" onchange="saltar('parent', this, 0)">
                        <option>Escolha uma Página</option> 
                        <?php
                        $p->carregarCombo();
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
    <?php
    if (!empty($_GET['id'])) {
        $p->consultar((int) $co->limparTexto($_GET['id']));
    }
}
?>