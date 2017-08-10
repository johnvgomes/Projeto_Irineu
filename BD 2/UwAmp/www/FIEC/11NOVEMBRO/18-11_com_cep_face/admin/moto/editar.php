<?php

session_start();
if(!isset($_SESSION['sessao'])){
    echo "Sem acesso!";
}else{    
   

include_once '../class/Marca.php';
include_once '../class/Moto.php';
include_once '../class/Controles.php';
$m = new Marca();
$mt = new Moto();
$co = new Controles();

$id = (int)$co->limparTexto($_GET['id']);
$vetor = $mt->carregar($id);
        
?>

<form method="post" name="fmoto" id="fmoto" 
      enctype="multipart/form-data">
    <h3>Editar de Moto</h3>
    <br>
    <input type="text" name="txtnome" id="txtnome" 
           placeholder="Modelo" value="<?php echo $vetor[1]; ?>">
    <br>
    <input type="text" name="txtvalor" id="txtvalor" 
           placeholder="Valor R$" value="<?php echo $vetor[2]; ?>">
    <br>
    <input type="number" name="txtestoque" id="txtestoque" 
           min="0" max="100"
           placeholder="Estoque aqui" value="<?php echo $vetor[4]; ?>">
    <br>
    <select name="cbomarca" id="cbomarca" >
        <option value="<?php echo $vetor[5]; ?>">
            <?php echo $vetor[7]; ?>
        </option>
        
        <?php
        $m->carregarSelect();
        ?>
    </select>
    <br><br>
    <input type="submit" name="btnenviar" id="btnenviar" 
           value="Editar">
</form> 

<?php
if (isset($_POST['btnenviar'])) {
    extract($_POST,EXTR_OVERWRITE);
    
    $mt->setId($id);
    $mt->setNome(strtr(strtoupper($txtnome), 
            "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    
    $mt->setValor($txtvalor);
    $mt->setEstoque($txtestoque);
    $mt->setId_marca($cbomarca);
    
    $mt->editar();
    //header("Location:?p=moto/consultar");
    echo "<script language='javaScript'>window.location.href='?p=moto/consultar'</script>";
    
}
}
?>