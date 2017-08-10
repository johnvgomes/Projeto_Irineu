<?php

//  admin/moto/mostrar.php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
} else {
    include_once '../class/Moto.php';
    include_once '../class/Controles.php';
    include_once '../class/Marca.php';
    
    $co = new Controles();
    $mt = new Moto();
    $ma = new Marca();
    //havij
    $id_marca = (int) $co->limparTexto($_GET['id_marca']);
    
?>
    <script type="text/javascript">
        function menu(targ, selObj, restore) {
            eval(targ + ".location='?p=moto/mostrar&id_marca=" + 
                    selObj.options[selObj.selectedIndex].value + "'");
            if (restore)
                selObj.selectedIndex = 0;
        }

    </script>
    <form name="form_Mostrar" id="form_Mostrar" method="get">
        <h3>Escolha a marca para visualizar a(s) moto(s)</h3>
        <select name="cbomarca" id="cbomarca" 
            onchange="menu('parent',this,0)">
            <option>Escolha uma marca</option>
            <?php
                $ma->carregarSelect();
            ?>
        </select>
    </form>


<?php

if(!empty($id_marca)){
    $mt->mostrar($id_marca);
}

}
?>


