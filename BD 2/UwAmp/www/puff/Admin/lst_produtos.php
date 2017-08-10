<?php include "conexao.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listagem de Produtos</title>
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
<table width="76%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center" class="style1">Lista de Produtos </div></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="1">
            <tr>
              <td width="37%" bgcolor="#CCCCCC"><div align="left"><span class="style18">Categoria / Subcategoria </span></div></td>
              <td width="31%" bgcolor="#CCCCCC"><span class="style18">Descri&ccedil;&atilde;o</span></td>
              <td bgcolor="#CCCCCC"><div align="center">
                <p align="left" class="style18">Estoque</p>
                </div></td>
              <td bgcolor="#CCCCCC"><span class="style18">Pre&ccedil;o</span></td>
              <td colspan="2" bgcolor="#CCCCCC"><div align="center" class="style18">Ac&atilde;o</div></td>
        </tr>
			  





	<?php   $sql = "select cat.categoria, sub.subcategoria, pro.id_produto, pro.produto, pro.estoque, pro.preco from subcategorias sub, categorias cat, produtos pro where sub.id_categoria = cat.id_categoria and pro.id_subcategoria = sub.id_subcategoria";
			$resultado = mysql_query ($sql);
	  		while ($linha = mysql_fetch_array($resultado)) { ?>
	   
            <tr>
              <td bgcolor="#CCCCCC"><?php echo $linha["categoria"]; ?> / <?php echo $linha["subcategoria"]; ?></td>
              <td bgcolor="#CCCCCC"><?php echo $linha["produto"]; ?></td>
              <td bgcolor="#CCCCCC"><?php echo $linha["estoque"]; ?></td>
              <td bgcolor="#CCCCCC"><?php echo $linha["preco"]; ?></td>
              <td bgcolor="#CCCCCC"><div align="center" class="style18"><a href = "principal.php?link=8&acao=Alterar&id=<?php echo $linha["id_produto"]; ?>"> E</div></td>
              <td bgcolor="#CCCCCC"><div align="center" class="style18"><a href = "principal.php?link=8&acao=Excluir&id=<?php echo $linha["id_produto"]; ?>">D</div></td>
            </tr>
			<?php } ?>









            <tr>
              <td colspan="6"><div align="right" class="style18"><a href = "principal.php?link=9&acao=Inserir">Inserir</div></td>
        </tr>
		</table>
		 
          
        </div></td>
  </tr>
</table></td>
  </tr>&nbsp;<tr></td>
  </tr>
</table>
</body>
</html>
