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
		  $id_produto = $_GET[id];
		  $id_categoria = $_GET[id_categoria];
		  
	if ($acao != "" & $id_produto != "")
	{
 
		  $sql = "select cat.categoria, cat.id_categoria, sub.subcategoria, sub.id_subcategoria, pro.id_produto, pro.produto, pro.descricao, pro.estoque, pro.foto, pro.preco from subcategorias sub, categorias cat, produtos pro where sub.id_categoria = cat.id_categoria and pro.id_subcategoria = sub.id_subcategoria and pro.id_produto = $id_produto";
		  $resultado = mysql_query("$sql");
		  $linha = mysql_fetch_array($resultado);
		  
		  $id_categoria 	= 	$linha[id_categoria];
		  $id_subcategoria 	= 	$linha[id_subcategoria];
		  $produto 			=	$linha[produto];
		  $foto				=	$linha[foto];
		  $estoque			=	$linha[estoque];
		  $preco			=	$linha[preco];
		  $descricao		=	$linha[descricao];
		  
		 /*echo "$id_categoria<br />";
		  echo "$id_subcategoria<br />";
		  echo "$produto<br />";
		  echo "$foto<br />";
		  echo "$estoque<br />";
		  echo "$preco<br />";
		  echo "$descricao<br />";*/
		  
	}	
		  
		 ?>
		 <form id="form1" name="form1" method="post" action="ope_produto.php">
        <table width="300" border="1" align="center" cellpadding="2">
          <tr>
            <td width="60">Categoria</td>
                  <td width="228">
                    
                    
                    <select name = "id_categoria">
                      
                      <?PHP 
					
					$sql_cat = "select * from categorias where id_categoria = $id_categoria order by categoria";
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
                    </select>				</td>
	      </tr>
          <tr>			
            <td width="60">Subcategoria</td>
                  <td width="228">
                    
                    
                    <select name = "id_subcategoria">
                      
                      <?PHP 
					
					$sql_sub = "select * from subcategorias where id_categoria = $id_categoria order by subcategoria";
					$resultado2 = mysql_query($sql_sub);
					
					while ($registrosub = mysql_fetch_array($resultado2))
						{
							$valorsub = $registrosub["id_subcategoria"];
								if ($id_subcategoria == $valorsub)
									{$selecionadosub = "selected";}
								else 
									{$selecionadosub = "";}
									
								print "<option value = \"$valorsub\" $selecionadosub > $registrosub[subcategoria] </option>";
						}
					
					
				?> 
                    </select>				</td>
          </tr>
          <tr>
            <td>Produto</td>
                  <td width="228"><input name="txt_produto" type="text" id="txt_produto" size="35" value ="<?php  echo $produto;?>" /></td>
          </tr>
          <tr>
            <td>foto</td>
	              <td width="228"><label>
	                <input name="txt_foto" type="text" id="txt_foto" size="35" value ="<?php  echo $foto;?>" />
	                <input name="foto" type="file" id="foto" />
	                </label></td>
          </tr>
          <tr>
            <td>Estoque</td>
	              <td width="228"><input name="txt_estoque" type="text" id="txt_estoque" size="35" value ="<?php  echo $estoque;?>" /></td>
          </tr>
          <tr>
            <td>Pre&ccedil;o</td>
	              <td width="228"><input name="txt_preco" type="text" id="txt_preco" size="35" value ="<?php  echo $preco;?>" /></td>
          </tr>
          <tr>
            <td>Descri&ccedil;&atilde;o</td>
	              <td width="228"><textarea name="textarea" cols="35" rows="5"><?php  echo $descricao;?>
	            </textarea></td>
          </tr>
          <tr>
            <td colspan="2"><label>
              <div align="center">
                <input type="hidden" name="id" value="<?php echo $id_produto ?>" />
                <input type="hidden" name="acao" value="<?php echo $acao; ?>" />
                <input type="submit" name="Submit" value="<?PHP echo $acao ?>" />
              </div>
                  </label></td>
          </tr>
        </table>
      </form>
			    
    </td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
