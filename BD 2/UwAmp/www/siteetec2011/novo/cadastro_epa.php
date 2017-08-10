<?php
$endereco="http://www.etecitu.com.br";
?>
<script src="<?php echo $endereco; ?>/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="<?php echo $endereco; ?>/js/mtel.js" type="text/javascript"></script>
<link href="<?php echo $endereco; ?>/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<form id="form1" name="form1" method="post" action="">
  <table width="400" border="0" cellspacing="5" cellpadding="1">
    <tr>
      <td colspan="2"><h3>Cadastro - EPA ETEC Itu</h3></td>
    </tr>
    <tr>
      <td>Nome:</td>
      <td><span id="sprytextfield1">
        <label>
          <input name="txtnome" type="text" id="txtnome" size="50" maxlength="70" />
        </label>
      <span class="textfieldRequiredMsg">Informe um nome.</span></span></td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td><span id="sprytextfield2">
        <label>
          <input name="txtemail" type="text" id="txtemail" size="50" maxlength="70" />
        </label>
      <span class="textfieldRequiredMsg">Obrigatorio.</span><span class="textfieldInvalidFormatMsg">Formato invalido.</span></span></td>
    </tr>
    <tr>
      <td>Telefone:</td>
      <td><input name="txttelefone" type="text" id="txttelefone" size="20" maxlength="15" onkeyup="mascara( this, mtel );" /></td>
    </tr>
    <tr>
      <td>Escola origem:</td>
      <td><label>
        <select name="escola" id="select">
            <option value="ETEC Itu" selected="selected">ETEC Itu</option>
            <option value="EE Prof. Antonio Berreta">EE Prof. Antonio Berreta</option>
            <option value="EE Bairro Portal do Eden">EE Bairro Portal do Eden</option>
            <option value="EE Prof. Bene Teixeira da F. A Gurgel">EE Prof. Bene Teixeira da F. A Gurgel</option>
            <option value="EE Dr. Cesario Motta">EE Dr. Cesario Motta</option>
            <option value="EE Francisco Nardy Filho">EE Francisco Nardy Filho</option>
            <option value="EE Prof. Lourenco Carmignani">EE Prof. Lourenco Carmignani</option>
            <option value="EE Prof. Pery Guarany Blackman">EE Prof. Pery Guarany Blackman</option>
            <option value="EE Prof. Rogerio Lazaro Toccheton">EE Prof. Rogerio Lazaro Toccheton</option>
            <option value="EE Dr. Benedito Lazaro de Campos">EE Dr. Benedito Lazaro de Campos</option>
            <option value="EE Cicero Siqueira Campos">EE Cicero Siqueira Campos</option>
            <option value="EE Prof. Jose Leite Pinheiro Junior">EE Prof. Jose Leite Pinheiro Junior</option>
            <option value="EE Regente Feijo">EE Regente Feijo</option>
            <option value="EE Prof. Rosa Maria Madeira M. Freire">EE Prof. Rosa Maria Madeira M. Freire</option>
            <option value="EE Sylvia de Paula Leite Bauer">EE Sylvia de Paula Leite Bauer</option>
            <option value="EE Prof. Salathiel Vaz de Toledo">EE Prof. Salathiel Vaz de Toledo</option>
            <option value="EE Prof. Claudio Ribeiro da Silva">EE Prof. Claudio Ribeiro da Silva</option>
            <option value="EE Profa. Irma Maria Nazarena Correa">EE Profa. Irma Maria Nazarena Correa</option>
            <option value="EE Prof. Acylino do Amaral Gurgel">EE Prof. Acylino do Amaral Gurgel</option>
            <option value="EE Prof. Joseano Costa Pinto ">EE Prof. Joseano Costa Pinto </option>
            <option value="EE Prof. Jose Benedito Goncalves">EE Prof. Jose Benedito Goncalves</option>
            <option value="EE Profa. Iracema Pinheiro Franco">EE Profa. Iracema Pinheiro Franco</option>
            <option value="EE Profa. Leonor Fernandes da Silva">EE Profa. Leonor Fernandes da Silva</option>
            <option value="EE Profa. Mirinha Tonello">EE Profa. Mirinha Tonello</option>
            <option value="EE Profa. Maria de Lurdes Moraes Costela">EE Profa. Maria de Lurdes Moraes Costela</option>
            <option value="EE Prof. Paula Santos">EE Prof. Paula Santos</option>
            <option value="EE Profa. Maria Tereza Guimaraes de Angelo">EE Profa. Maria Tereza Guimaraes de Angelo</option>
            <option value="EE Profa. Otilia de Paula Leite ">EE Profa. Otilia de Paula Leite </option>
            <option value="EE Prof. Constanca de Miranda Campos">EE Prof. Constanca de Miranda Campos</option>
            <option value="EE Prof. Padre Francisco Rigolin (CAIC) ">EE Prof. Padre Francisco Rigolin (CAIC) </option>
            <option value="EE Profa. Dolores Antunes da Silva">EE Profa. Dolores Antunes da Silva</option>
            <option value="EE Prof. Tancredo do Amaral">EE Prof. Tancredo do Amaral</option>
        	<option value="Outra">Outra</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td colspan="2"><input name="cadastrar" type="submit" id="cadastrar"   /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
//-->
</script>
<?php
if(isset($_POST['cadastrar']) ){
    if(filter_var($_POST['txtemail'], FILTER_VALIDATE_EMAIL)){
    require_once 'class/Epa.php';
    
    
    $e = new Epa($_POST['txtnome'], $_POST['txtemail'],
            $_POST['txttelefone'],$_POST['escola']);
    
    $e->cadastrar();

    echo "<h3>Cadastro efetuado com sucesso!</h3>";
    }else{
        echo "E-mail inválido.";   
   }
}

?>