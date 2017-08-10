<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Curso.php';
require_once '../class/Controles.php';
$co = new Controles();
$c = new Curso();
$id = (int) $co->limparTexto($_GET['id']);
$array = $c->carregarID($id);
$tipo=$co->limparTexto($_GET['t']);

if($tipo=="p"){
    $tipo = "Plano";
}else if($tipo=="m"){
    $tipo = "Matriz";
}else if($tipo=="i"){
    $tipo = "Imagem";
}else if($tipo=="e"){
    $tipo = "Eixo";
}
?>

<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
    <table>
        <tr><td><h3>Alterar <?php echo $tipo; ?> do Curso de <?php echo $array[1]; ?>?</h3></td></tr>
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
    if($tipo=="Plano"){
        $c->editarPlano($id,$arquivo['name'],$arquivo['tmp_name'],$array[4]); 
    }else if($tipo=="Matriz"){
        $c->editarMatriz($id,$arquivo['name'],$arquivo['tmp_name'],$array[3]); 
    }else if($tipo=="Imagem"){
        $c->editarImagem($id,$arquivo['name'],$arquivo['tmp_name'],$array[5]); 
    }else if($tipo=="Eixo"){
        $c->editarEixo($id,$_POST['cbeixo']); 
    }
    header("Location:?p=curso/consultar.php");
    echo '<meta http-equiv="refresh" content="1;URL=?p=banner/consultar.php">';
}
}
?>