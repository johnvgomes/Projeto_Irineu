<?php

header('Content-type: text/html; charset=utf-8');
require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Eixo.php';
require_once '../class/Controles.php';
$e = new Eixo();
$co = new Controles();
$id = (int) $co->limparTexto($_GET['id']);
$array = $e->carregarID($id);
?>

<form id="frmEditar" name="frmEditar" method="post" action="">
  <table>
    <tr>
      <td colspan="2"><h3>Editar Eixo</h3></td>
    </tr>
    <tr>
      <td>Eixo</td>
      <td><label>
        <input type="text" name="txteixo" id="txteixo" value="<?php echo $array[1]; ?>" />
      </label></td>
    </tr>
    <tr>
      <td colspan="2"><label>
        <input type="submit" name="cadastrar" id="cadastrar" value="cadastrar" />
      </label></td>
    </tr>
  </table>
</form>

<?php
if (isset($_POST['cadastrar'])){
    $eixo = $_POST['txteixo'];
    $e->editar($id,$eixo);
    header("Location:?p=eixo/consultar.php");
}

}

?>