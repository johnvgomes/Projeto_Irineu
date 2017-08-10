<?php


require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Calendario.php';
require_once '../class/Controles.php';
$co = new Controles();
$c = new Calendario();
$id = (int) $co->limparTexto($_GET['id']);
$array = $c->carregarID($id);
$tipo=$co->limparTexto($_GET['t']);

if($tipo=="c"){
    $tipo = "Calendario";
}
?>

<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
    <table>
        <tr><td><h3>Alterar <?php echo $tipo; ?>?</h3></td></tr>
        <tr><td><input type="file" name="arquivo" id="arquivo" /></td></tr>
        <tr><td> <input type="submit" name="confirmar" id="confirmar" value="confirmar" /></td></tr>
    </table>
</form>

<?php
if (isset($_POST['confirmar'])){
    $arquivo = $_FILES['arquivo'];

    $c->editarArquivo($id,$arquivo['name'],$arquivo['tmp_name'],$array[3]); 
    
    header("Location:?p=calendario/consultar.php");
    echo '<meta http-equiv="refresh" content="1;URL=?p=calendario/consultar.php">';
}
}
?>