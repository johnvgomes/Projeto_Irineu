<?php include "conexao.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php
		  
		  $acao=$_GET[acao];
		  $id = $_GET[id];
		  $sql = mysql_query("select * from administracao where id_adm = $id");  ?>
		  
		  <form id="form1" name="form1" method="post" action="ope_usuario.php">
            <table width="350" border="1" align="center" cellpadding="2">
              <tr>
                <td width="70">Nome</td>
                <td width="210"><label>
                  <input name="txt_nome" type="text" id="txt_nome" size="35" value ="<?php echo @mysql_result($sql,0,nome);?>" />
                </label></td>
              </tr>
              <tr>
                <td width="70">E-mail</td>
                <td><input name="txt_email" type="text" id="txt_email" size="35" value ="<?php echo @mysql_result($sql,0,email);?>" /></td>
              </tr>
              <tr>
                <td width="70">Login</td>
                <td><input name="txt_login" type="text" id="txt_login" size="35" value ="<?php echo @mysql_result($sql,0,login);?>" /></td>
              </tr>
              <tr>
                <td width="70">Senha</td>
                <td><input name="txt_senha" type="text" id="txt_senha" size="35" value ="<?php echo @mysql_result($sql,0,senha);?>" /></td>
              </tr>
              <tr>
                <td colspan="2"><label>
                  <div align="center">
				    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <input type="hidden" name="acao" value="<?php echo $acao; ?>" />
                    <input type="submit" name="Submit" value="<?PHP echo $acao ?>" />
					</div>
                </label></td>
                </tr>
            </table>
      </form>
			  
		  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
