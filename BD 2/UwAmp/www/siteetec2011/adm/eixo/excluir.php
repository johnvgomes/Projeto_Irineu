<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){
?>

<form name="frmExcluir" action="" method="post">
<table>
    <tr>
        <td><h3>Deseja excluir este Eixo?</h3></td>
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
        include_once '../class/Eixo.php';
        $e = new Eixo();

        if($_POST['decisao'] == "s"){
            $id = (int) $_GET['id'];
            $e->excluir($id);
            header("Location:?p=eixo/consultar.php");
            echo '<meta http-equiv="refresh" content="1;URL=?p=eixo/consultar.php">';
        }else{
            header("Location:?p=eixo/consultar.php");
            echo '<meta http-equiv="refresh" content="1;URL=?p=eixo/consultar.php">';
        }
    }
}
?>