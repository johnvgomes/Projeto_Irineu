<?php
include_once '../class/Departamento.php';
include_once '../class/Controles.php';

$d = new Departamento();
$ct = new Controles();

//capturar o id "daquele" registro que está na URL
$id = (int) $ct->limparTexto($_GET['id']);

$registro = $d->carregar($id);
?>
<table>
    <form name="editar" id="editar" method="post">
        <tr>
            <td colspan="2">
                <h3>Edição de Departamento</h3>
            </td>
        </tr>
        <tr>
            <td colspan="2">Nome:<br>
                <input type="text" name="txtnome" id="txtnome"
                       maxlength="50" size="40" 
                       value="<?php echo strtr($registro[1], "áéíóúâêôãõàèìòùç", "ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"); ?>">
            </td>
        </tr>
        <tr>
            <td>Funcionários:<br>
                <input type="number" name="txtnr" id="txtnr"
                       min="1" max="9999"
                       value="<?php echo $registro[2]; ?>">
            </td>
            <td colspan="2">
                <input type="submit" name="btn" id="btn" 
                       value="Editar">  
            </td>
        </tr>
    </form>
</table>
<?php
if (isset($_POST['btn']) && !empty($_POST['txtnome']) &&
        !empty($_POST['txtnr'])) {

    extract($_POST, EXTR_OVERWRITE);

    $d->setId($id);
    $d->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
    $d->setNrfuncionarios((int) $txtnr);

    $d->editar();

    echo "<script language='javaScript'>"
    . "window.location.href='?p=departamento/consultar'"
    . "</script>";
}
?>

