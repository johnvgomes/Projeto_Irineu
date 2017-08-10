<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

?>

<form action="" method="post" enctype="multipart/form-data" name="frmcadPart" id="frmcadPart">
<table>
    <tr>
        <td colspan="2"><h3>Formul&aacute;rio de Cadastro de Calendario</h3></td>
    </tr>
    <tr>
        <td>Ano:</td>
        <td>
            <select name="cbano" id="cbano">
                <option value="">Escolha o ano</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select>
        </td>
    </tr>

    <tr>  
        <td>Titulo:</td>
         <td>
             <input type="text" maxlength="70" size="50" name="txttitulo" />
        </td>
    </tr>
    <tr>  
        <td>Arquivo - Calendario PDF:</td>
        <td>
            <input type="file" name="calendario" id="calendario" />
        </td>
    </tr>
    <tr>
        <td colspan="4"><input type="submit" name="cadastrar" id="bt" value="cadastrar" /></td>
    </tr>
</table>
</form>

<?php
if(isset($_POST['cadastrar']) && !empty($_POST['cbano']) && !empty($_POST['txttitulo'])){
    require_once '../class/Calendario.php';
    
    $arq = $_FILES['calendario'];
   
    $c = new Calendario($_POST['cbano'], $_POST['txttitulo']
            , $arq['name'], $arq['tmp_name'],1);
    
    $c->cadastrar();

    echo "<h3>Cadastro efetuado com sucesso!</h3>";
}
}
?>