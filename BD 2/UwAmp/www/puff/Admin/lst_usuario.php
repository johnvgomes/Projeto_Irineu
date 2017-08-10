<?php include "conexao.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
.style10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; font-weight: bold; }
.style12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; font-weight: bold; font-style: italic; }
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center" class="style1">Lista de Usuarios </div></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><table width="99%" border="0" cellpadding="1">
            <tr>
              <td width="12%" bgcolor="#CCCCCC"><span class="style10">Nome</span></td>
              <td width="11%" bgcolor="#CCCCCC">Email</td>
              <td width="23%" bgcolor="#CCCCCC">Login</td>
              <td width="45%" bgcolor="#CCCCCC">Senha</td>
              <td colspan="2" bgcolor="#CCCCCC"><div align="center" class="style10">Ac&atilde;o</div></td>
        </tr>
			  
	<?php $sql = mysql_query ("select * from administracao");
	   while ($linha = mysql_fetch_array($sql)) { ?>
	   
            <tr>
              <td bgcolor="#CCCCCC"> <span class="style12"><?php echo $linha["nome"]; ?></span> </td>
              <td bgcolor="#CCCCCC"><?php echo $linha["email"]; ?></td>
              <td bgcolor="#CCCCCC"><?php echo $linha["login"]; ?></td>
              <td bgcolor="#CCCCCC"><?php echo $linha["senha"]; ?></td>
              <td width="5%" bgcolor="#CCCCCC"><div align="center" class="style10"><a href = "principal.php?link=6&acao=Alterar&id= <?php echo $linha["id_adm"]; ?>"> E</div></td>
              <td width="4%" bgcolor="#CCCCCC"><div align="center" class="style10"><a href = "principal.php?link=6&acao=Excluir&id= <?php echo $linha["id_adm"]; ?>">D</div></td>
            </tr>
			<?php } ?>
            <tr>
              <td colspan="6"><div align="right" class="style10"><a href = "principal.php?link=6&acao=Inserir">Inserir</div></td>
        </tr>
		</table>
		 
          <p></p>
        </div></td>
      </tr>
    </table></td>
  </tr>&nbsp;<tr></td>
  </tr>
</table>
</body>
</html>
