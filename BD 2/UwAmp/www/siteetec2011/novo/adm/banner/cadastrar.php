<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Eixo.php';
$e = new Eixo;
?>

<form action="" method="post" enctype="multipart/form-data" name="frmcadPart" id="frmcadPart">
<table>
    <tr>
        <td colspan="2"><h3>Formul&aacute;rio de Cadastro de Banner</h3></td>
    </tr>
    <tr>
        <td>Nome:</td>
        <td>
            <input name="txtnome" type="text" id="text" size="50" maxlength="70" />
        </td>
    </tr>
    <tr>  
        <td>Imagem:</td>
        <td>
            <input type="file" name="arquivo" id="arquivo" />
        </td>
    </tr>
    <tr>
        <td>Link:</td>
        <td>
            <input name="txtlink" type="text" id="txt" size="50" maxlength="100" />
        </td>
    </tr>
    <tr>
        <td colspan="2">Mostrar? <input type="checkbox" name="ckmostrar" id="checkbox" /></td>
    </tr>
    <tr>
        <td>Eixo Tecnol&oacute;ligo:</td>
        <td>
            <select name="cbeixo" id="cbeixo">
                <?php $e->carregarEixo(); ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="cadastrar" id="bt" value="cadastrar" /></td>
    </tr>
</table>
</form>

<?php
if(isset($_POST['cadastrar']) && !empty($_POST['txtnome']) && !empty($_POST['txtlink'])){
    require_once '../class/Banner.php';
        
    $arq = $_FILES['arquivo'];
    
    $b = new Banner($_POST['txtnome'], $arq['name'], 
            $arq['tmp_name'], $_POST['txtlink'], 
            $_POST['ckmostrar'],$_POST['cbeixo']);
    
    $b->cadastrar();

    echo "<h3>Cadastro efetuado com sucesso!</h3>";
}
}
?>