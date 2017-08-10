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
}
.style3 {font-size: 16px; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
</head>
<body>
<p align="center" class="style3">Cadastro de produtos, etapa 1/2 (selecionar a categoria para inserir o produto). </p>
<form action="principal.php" method="get">
<table width="300" border="1" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td colspan="2"><div align="center" class="style1">Selecione a Categoria</div></td>
  </tr>
  <tr>
    <td width="86">Categoria</td>
    <td width="214">  <div align="center">
     
	 
	  <select name = "id_categoria">
        
        <?PHP 
					
					$sql_cat = "select * from categorias order by categoria";
					$resultado1 = mysql_query($sql_cat);
					
					while ($registro = mysql_fetch_array($resultado1))
						{
							$valor = $registro["id_categoria"];
								if ($id_categoria == $valor)
									{$selecionado = "selected";}
								else 
									{$selecionado = "";}
									
								print "<option value = \"$valor\" $selecionado > $registro[categoria] </option>";
						}
					
					
					
				?> 
      </select>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <label>
      <input type="submit" name="Submit" value="Continuar..." />
      </label>
    </div></td>
					
  </tr>
 
</table>
<input name="acao" type="hidden" value="Inserir" />
<input name="link" type="hidden" value="8" /> </form>


</body>
</html>
