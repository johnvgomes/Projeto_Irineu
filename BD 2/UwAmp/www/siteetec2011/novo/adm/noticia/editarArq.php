<?php


require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Noticia.php';
require_once '../class/Controles.php';
$co = new Controles();
$n = new Noticia();
$id = (int) $co->limparTexto($_GET['id']);
$array = $n->carregarID($id);
$tipo=$co->limparTexto($_GET['t']);

if($tipo=="i"){
    $tipo = "Imagem";
}else if($tipo=="e"){
    $tipo = "Eixo";
}
?>

<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
    <table>
        <tr><td><h3>Alterar <?php echo $tipo; ?> da Noticia <?php echo $array[1]; ?>?</h3></td></tr>
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
        $n->editarImagem($id,$arquivo['name'],$arquivo['tmp_name'],$array[4]); 
    }else if($tipo=="Eixo"){
        $n->editarEixo($id,$_POST['cbeixo']); 
    }
    header("Location:?p=noticia/consultar.php");
}
}
?>