<?php


require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Calendario.php';
require_once '../class/Controles.php';
$c = new Calendario;
$co = new Controles();
$id = (int) $co->limparTexto($_GET['id']);
$array = $c->carregarID($id);
?>

<form action="" method="post" name="frmcadPart" id="frmcadPart">
<table>
    <tr>
        <td colspan="2"><h3>Editar Calendario</h3></td>
    </tr>
    <tr>
        <td>Ano:</td>
        <td>
          <input name="txtano" type="text" id="txtnome" size="10" maxlength="4" value="<?php echo $array[1]; ?>" />
        </td>
    </tr>
    <tr>
        <td>Titulo:</td>
        <td>
            <input name="txttitulo" type="text" id="txtnome" size="50" maxlength="70" value="<?php echo $array[2]; ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="cadastrar" id="bt" value="cadastrar" />
        </td>
    </tr>
</table>
</form>

<?php
    if (isset($_POST['cadastrar'])){
        $c->editar($id,$_POST['txtano'],$_POST['txttitulo']);
        //header('Location:?p=curso/consultar.php');
        echo '<meta http-equiv="refresh" content="1;URL=?p=calendario/consultar.php">';
    }
}
?>