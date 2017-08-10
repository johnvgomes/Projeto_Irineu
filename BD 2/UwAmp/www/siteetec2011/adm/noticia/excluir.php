<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){
?>

<form name="frmExcluir" action="" method="post">
<table>
    <tr>
      <td><h3>Deseja excluir esta Noticia?</h3></td>
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
        require_once '../class/Noticia.php';
        $n = new Noticia();
        require_once '../class/Controles.php';
        $co = new Controles();

        if($_POST['decisao'] == "s"){
            $id = (int) $co->limparTexto($_GET['id']);
            $n->excluir($id);
            header("Location:?p=noticia/consultar.php");
            echo '<meta http-equiv="refresh" content="1;URL=?p=noticia/consultar.php">';
        }else{
            header("Location:?p=noticia/consultar.php");
            echo '<meta http-equiv="refresh" content="1;URL=?p=noticia/consultar.php">';
        }
    }
}
?>