
<form name="cadastrar" id="cadastrar" method="post"
      enctype="multipart/form-data">
    <p>R$: <input type="text" name="txtvalor" class="real" maxlength="10" /></p>

    <input type="submit" name="btn" id="btn" value="Cadastrar"> 
</form>
<?php
if (isset($_POST['btn'])) {
    include_once '../class/Controles.php';
    $ct = new Controles();
    
    echo $ct->moeda($_POST['txtvalor']);
    
    //$v->setValor($ct->moeda($_POST['txtvalor']));
}
?>