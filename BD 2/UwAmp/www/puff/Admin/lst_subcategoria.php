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
	font-family: Arial, Helvetica, sans-serif;
}
.style18 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; font-weight: bold; }
.style20 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; font-weight: bold; font-style: italic; }
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center" class="style1">Lista de Subcategorias </div></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><table width="99%" border="0" cellpadding="1">
            <tr>
              <td bgcolor="#CCCCCC"><div align="center"><span class="style18">Subcategorias</span></div></td>
              <td bgcolor="#CCCCCC"><div align="center"><span class="style18">Categorias</span></div></td>
              <td colspan="2" bgcolor="#CCCCCC"><div align="center" class="style18">Ac&atilde;o</div></td>
        </tr>
			  
	<?php   $sql = "select cat.*, sub.* from subcategorias sub, categorias cat where sub.id_categoria = cat.id_categoria";
			$resultado = mysql_query ($sql);
	  		while ($linha = mysql_fetch_array($resultado)) { ?>
	   
            <tr>
              <td width="45%" bgcolor="#CCCCCC"> <span class="style20"><?php echo $linha["subcategoria"]; ?></span> </td>
              <td width="46%" bgcolor="#CCCCCC"><span class="style20"><?php echo $linha["categoria"]; ?></span></td>
              <td width="5%" bgcolor="#CCCCCC"><div align="center" class="style18"><a href = "principal.php?link=4&acao=Alterar&id=<?php echo $linha["id_subcategoria"]; ?>"> E</div></td>
              <td width="4%" bgcolor="#CCCCCC"><div align="center" class="style18"><a href = "principal.php?link=4&acao=Excluir&id=<?php echo $linha["id_subcategoria"]; ?>">D</div></td>
            </tr>
			<?php } ?>
            <tr>
              <td colspan="4"><div align="right" class="style18"><a href = "principal.php?link=4&acao=Inserir">Inserir</div></td>
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
