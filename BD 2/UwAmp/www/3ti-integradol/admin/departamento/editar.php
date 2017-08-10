<?php
include_once '../class/Departamento.php';
$d = new Departamento();

$id = (int) $_GET['id'];

$d->setId($id);
$registro = $d->carregar();
?>
<style>
    span {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<form name="depto" id="depto" method="post" 
      enctype="multipart/form-data">

    <h3>Edição de Departamento</h3>

    Nome<br>
    <input name="txtnome" id="txtnome" size="40"
           maxlength="50" type="text" 
           value="<?php echo $registro[1]; ?>">
    <span>Nome do depto</span>
    <br><br>
    Nr Funcionários<br>
    <input name="txtnr" id="txtnr" type="number"
           min="1" max="999"
           value="<?php echo $registro[2]; ?>">
    <br><br>
    <input type="submit" name="btn" id="btn"
           value="enviar">    
</form>

<script>
    $("input").focus(function () {
        $(this).next("span").css("display", "inline").fadeOut(1000);
    });
</script>

<?php
if (isset($_POST['btn']) && !empty($_POST['txtnome']) && !empty($_POST['txtnr'])) {
    
    extract($_POST, EXTR_OVERWRITE);
    include_once '../class/Departamento.php';
    $d = new Departamento();
    $d->setId($id);
    $d->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $d->setNrfuncionarios((int) $txtnr);
    $d->editar();
    
    echo "<script language='javaScript'>
        window.location.href='?p=departamento/consultar'
        </script>";
}
?>