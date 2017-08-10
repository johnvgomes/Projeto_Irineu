<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Banner.php';
require_once '../class/Controles.php';
$co = new Controles();
$b = new Banner();
$id = (int) $co->limparTexto($_GET['id']);
$array = $b->carregarID($id);
$tipo=$co->limparTexto($_GET['t']);

if($tipo=="i"){
    $tipo = "Imagem";
}else if($tipo=="e"){
    $tipo = "Eixo";
}
?>

<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
    <table>
        <tr><td><h3>Alterar <?php echo $tipo; ?> do Banner de <?php echo $array[1]; ?>?</h3></td></tr>
        <?php 
            if($tipo!="Eixo") {
                echo '<tr><td><input type="file" name="arquivo" id="arquivo" /></td></tr>';
             }else if($tipo==="Eixo") { 
                echo '<tr><td><select name="cbeixo" id="combo">';
                require_once '../class/Eixo.php';    
                $e = new Eixo();
                $e->carregarEixo(); 
                echo '</select></td></tr>';
           } 
       ?>
        <tr><td> <input type="submit" name="confirmar" id="confirmar" value="confirmar" /></td></tr>
    </table>
</form>

<?php
if (isset($_POST['confirmar'])){
    $arquivo = $_FILES['arquivo'];
    if($tipo=="Imagem"){
        $b->editarImagem($id,$arquivo['name'],$arquivo['tmp_name'],$array[2]); 
    }else if($tipo=="Eixo"){
        $b->editarEixo($id,$_POST['cbeixo']); 
    }
    header("Location:?p=curso/consultar.php");
    echo '<meta http-equiv="refresh" content="1;URL=?p=banner/consultar.php">';
}
}
?>