<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    //fim
    ?>

    <script type="text/javascript">
        function escolher(targ, selObj, restore) { //v3.0
            eval(targ + ".location='?p=curso/consultar&eixo=" + selObj.options[selObj.selectedIndex].value + "'");
            if (restore)
                selObj.selectedIndex = 0;
        }
    </script>

    <?php
    include_once '../class/Curso.php';
    include_once '../class/Eixo.php';
    include_once '../class/Controles.php';
    $co = new Controles();
    $c = new Curso();
    $e = new Eixo();
//havij
    $eixo = (int) $co->limparTexto($_GET['eixo']);
    ?>

    <form method="get" enctype="multipart/form-data">
        <table>
            <tr class="vermelho">
                <td><h3>Mostrar Curso por Eixo Tecnológico</h3></td>
                <td>
                    <select name="cbo" id="cbo"
                            onchange="escolher('parent', this, 0)">
                        <option>Escolha um eixo tecnológico</option>
                        <?php
                        $e->carregarSelect();
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>

    <?php
    if (!empty($eixo)) {
        $c->setId_eixo($eixo);
        $c->consultar();
    }
}
?>
