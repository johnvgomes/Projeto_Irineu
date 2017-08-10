<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
// admin/eixo/editar.php

include_once '../class/Eixo.php';
$e = new Eixo();

$id = (int)$_GET['id'];

$vetor = $e->carregar($id);

?>

<form name="frmeixo" id="frmeixo" method="post">
    <h3>Editar Eixo Tecnológico</h3>
    
    <input type="text" maxlength="50" size="50" 
           value="<?php echo $vetor[1]; ?>" 
           id="txtnome" name="txtnome">
    <br>
    <input type="submit" name="btneditar" id="btneditar" 
           value="Editar Eixo">
</form>
<?php

if(isset($_POST['btneditar']) && !empty($_POST['txtnome'])){
    $e->setNome($_POST['txtnome']);
    $e->setId($id);
    
    $e->editar();
    
    echo "<script language='javascript'>
        window.location.href='?p=eixo/consultar'
        </script>";
}
}
?>
