<?php include "conexao.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="21">&nbsp;</td>
  </tr>
  <tr>
    <td height="36"><div align="center"><span class="style1">Cadastro de Configura&ccedil;&otilde;es </span></div></td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><?php
		  
		  $acao=$_GET[acao];
		  
		  $sql = mysql_query("select * from configuracao order by id_configuracao desc limit 1");  ?>
		  
		  <form id="form1" name="form1" method="post" action="ope_configuracao.php">
            <table width="350" border="1" align="center" cellpadding="2">
              <tr>
                <td width="70">Nome</td>
                <td width="210"><label>
                  <input name="txt_nome" type="text" id="txt_nome" size="35" value ="<?php echo @mysql_result($sql,0,nome);?>" />
                </label></td>
              </tr>
              <tr>
                <td width="70">Endere&ccedil;o</td>
                <td><input name="txt_endereco" type="text" id="txt_email" size="35" value ="<?php echo @mysql_result($sql,0,endereco);?>" /></td>
              </tr>
              <tr>
                <td width="70">Bairro</td>
                <td><input name="txt_bairro" type="text" id="txt_login" size="35" value ="<?php echo @mysql_result($sql,0,bairro);?>" /></td>
              </tr>
              <tr>
                <td width="70">CEP</td>
                <td>
                  <input name="txt_cep" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,cep);?>" />                </td>
              </tr>
			  <tr>
                <td width="70">Cidade</td>
                <td>
                  <input name="txt_cidade" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,cidade);?>" />                </td>
              </tr>
			                <tr>
                <td width="70">UF</td>
                <td>
                  <input name="txt_uf" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,uf);?>" />                </td>
              </tr>
			                <tr>
                <td width="70">Fone</td>
                <td>
                  <input name="txt_fone" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,fone);?>" />                </td>
              </tr>
			                <tr>
                <td width="70">CNPJ</td>
                <td>
                  <input name="txt_cnpj" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,cnpj);?>" />                </td>
              </tr>
			                <tr>
                <td width="70">Insc. Est. </td>
                <td>
                  <input name="txt_insc" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,inscricao);?>" />                </td>
              </tr>
			                <tr>
                <td width="70">E-mail</td>
                <td>
                  <input name="txt_email" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,email);?>" />                </td>
              </tr>
			                <tr>
                <td width="70">URL Site </td>
                <td>
                  <input name="txt_link" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,link);?>" />                </td>
              </tr>
              <tr>
                <td colspan="2"><label>
                  <div align="center">
				    <input type="hidden" name="id" value="<?php echo  @mysql_result($sql,0,id_configuracao); ?>" />
                    <input type="hidden" name="acao" value="<?php echo $acao; ?>" />
                    <input type="submit" name="Submit" value="<?PHP echo $acao ?>" />
					</div>
                </label></td>
                </tr>
            </table>
      </form>		  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
