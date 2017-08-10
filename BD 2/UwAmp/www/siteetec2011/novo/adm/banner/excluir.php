<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){
?>

<form name="frmExcluir" action="" method="post">
<table>
    <tr>
      <td><h3>Deseja excluir este Banner?</h3></td>
    </tr>
    <tr>
        <td>
            <input type="radio" name="decisao" value="s" />
            Sim
        </td>
    </tr>
    <tr>
        <td>
            <input type="radio" name="decisao" value="n" />
            N&atilde;o
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" name="enviar" id="enviar" value="enviar" />
        </td>
    </tr>
</table>
</form>
<?php
    if (isset($_POST['enviar'])){
        include_once '../class/Banner.php';
        $b = new Banner();

        if($_POST['decisao'] == "s"){
            $id = (int) $_GET['id'];
            $b->excluir($id);
            header("Location:?p=banner/consultar.php");
            echo '<meta http-equiv="refresh" content="1;URL=?p=banner/consultar.php">';
        }else{
            header("Location:?p=banner/consultar.php");
            echo '<meta http-equiv="refresh" content="1;URL=?p=banner/consultar.php">';
        }
    }
}
?>