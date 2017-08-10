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

	if ($acao != "" & $id != "")
	{
		  		  
		  $sql = "select cat.*, sub.* from subcategorias sub, categorias cat where sub.id_categoria = cat.id_categoria and id_subcategoria = $id";
		  $resultado = mysql_query("$sql");
		  $linha = mysql_fetch_array($resultado);
		  
		  $subcategoria = $linha[subcategoria];
		  $id_categoria = $linha[id_categoria];
	}	  
		  
		 ?>
		  
		  <form id="form1" name="form1" method="post" action="ope_subcategoria.php">
            <table width="300" border="1" align="center" cellpadding="2">
              <tr>
                <td width="60">Categoria</td>
                <td width="228">
				
				
				<select name = "id_categoria">
				<option> </option>
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
				</td>
              </tr>
              <tr>
                <td>SubCategoria</td>
                <td width="228"><input name="txt_subcategoria" type="text" id="txt_subcategoria" size="35" value ="<?php  echo $subcategoria;?>" /></td>
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
