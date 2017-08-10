<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

?>

<form action="" method="post" enctype="multipart/form-data" name="frm" id="frmcadPart">
<table>
    <tr>
        <td colspan="2"><h3>Formul&aacute;rio de Cadastro de Prestação de Conta</h3></td>
    </tr>
    <tr>
        <td>Mês:</td>
        <td>
            <select name="cbomes" id="cbomes">
                <option value="">Escolha o mês</option>
                <option value="Janeiro">Janeiro</option>
                <option value="Fevereiro">Fevereiro</option>
                <option value="Março">Março</option>
                <option value="Abril">Abril</option>
                <option value="Maio">Maio</option>
                <option value="Junho">Junho</option>
                <option value="Julho">Julho</option>
                <option value="Agosto">Agosto</option>
                <option value="Setembro">Setembro</option>
                <option value="Outubro">Outubro</option>
                <option value="Novembro">Novembro</option>
                <option value="Dezembro">Dezembro</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Ano:</td>
        <td>
            <select name="cboano" id="cboano">
                <option value="">Escolha o ano</option>
                <option value="2012">2012</option>
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
        <td>Tipo:</td>
        <td>
            <select name="cbotipo" id="cbotipo">
                <option value="">Escolha o tipo</option>
                <option value="Adiantamento">Adiantamento</option>
                <option value="APM">APM</option>
                <option value="Cooperativa">Cooperativa</option>
            </select>
        </td>
    </tr>

    <tr>  
        <td>Arquivo - Conta PDF:</td>
        <td>
            <input type="file" name="conta" id="conta" />
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="cadastrar" id="bt" value="cadastrar" /></td>
    </tr>
</table>
</form>

<?php
if(isset($_POST['cadastrar'])){
    require_once '../class/Conta.php';
    
    $arq = $_FILES['conta'];
   
    $c = new Conta($_POST['cbomes'],$_POST['cboano'], $_POST['cbotipo']
            , $arq['name'], $arq['tmp_name']);
    
    $c->cadastrar();

    echo "<h3>Cadastro efetuado com sucesso!</h3>";
}
}
?>