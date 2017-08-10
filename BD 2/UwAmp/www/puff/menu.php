
<?php include "conexao.php";

$id_cat = $_GET[id_categoria];
$id_subcat = $_GET[id_subcategoria];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style6 {
	font-size: 9px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
</head>

<body>
<table width="200" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="21" height="52">&nbsp;</td>
    <td width="156">&nbsp;</td>
    <td width="23">&nbsp;</td>
  </tr>
  <tr>
    <td height="332">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="3"><div align="center"><img src="Imagens/MENU.gif" width="183" height="28" alt=""/></div></td>
      </tr>
      <tr>
        <td width="9%" height="35" bgcolor="#7FD4AC">&nbsp;</td>
        <td width="86%" bgcolor="#7FD4AC" valign="middle"><?PHP $sql_cat = mysql_query("select * from categorias");
				while($coluna_cat = mysql_fetch_array($sql_cat)) 
					{
					echo "<a href=\"index.php?link=1&id_categoria=$coluna_cat[id_categoria]\"> $coluna_cat[categoria]</a> <br>";
					if ($id_cat == $coluna_cat[id_categoria])
						{
							$sql_subcat = mysql_query("select * from subcategorias where id_categoria = $id_cat");
							while($coluna_subcat = mysql_fetch_array($sql_subcat)) 
								{
								echo "-- <a href=\"index.php?link=1&id_categoria=$coluna_subcat[id_categoria]&id_subcategoria=$coluna_subcat[id_subcategoria]\"> $coluna_subcat[subcategoria]</a> <br>";
								}
						}
							
					}
			
		?></td>
        <td width="5%" bgcolor="#7FD4AC">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><div align="center">Procurar</div></td>
      </tr>
      <tr>
        <td colspan="3"><div align="Center">
          <form id="form1" name="form1" method="post" action="">
            <label>
            <input type="text" name="textfield" value="Digite a palavra Chave" />
            <input name="Input" type="submit" value="Ir" />
            </label></form>
          <p><br />
          </p>
        </div></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>
