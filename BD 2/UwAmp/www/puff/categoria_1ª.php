<?php include "conexao.php";

$id_cat = $_GET[id_categoria];
$id_subcat = $_GET[id_subcategoria];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Categorias</title>
<style type="text/css">
<!--
.style9 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FF0000;
	font-weight: bold;
	font-size: 14px;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th valign="top" scope="col"><div align="left">
      <p><span class="style3">..::</span>
          <?php 
	$sql_cat = mysql_query("select * from categorias where id_categoria = $id_cat");
	$resultado = mysql_fetch_array($sql_cat);
	echo " <b>$resultado[categoria]</b>";
	?>
        
          <?php
	if ($id_subcat != "")
	{
	$sql_subcat = mysql_query("select * from subcategorias where id_subcategoria = $id_subcat");
	$result = mysql_fetch_array($sql_subcat);
	echo "<b> - </b>" ."<b> $result[subcategoria] </b>";
	}
	?>
        <br />
        Qtd Produtos: 
        
        <?php
	
	if ($id_subcat != "")
	{
		$sql = "select p.*, c.*, s.* from produtos p, categorias c, subcategorias s where p.id_categoria = c.id_categoria and p.id_subcategoria = s.id_subcategoria and p.id_subcategoria = $id_subcat";
	}
	else
	{
		$sql = "select p.*, c.*, s.* from produtos p, categorias c, subcategorias s where p.id_categoria = c.id_categoria and p.id_subcategoria = s.id_subcategoria and p.id_categoria = $id_cat";
	}
	
	$resultado = mysql_query($sql);
	$qtde_registro = mysql_num_rows($resultado);
	echo "$qtde_registro";
	$i=0;
	?>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
		
		<?php $sql_geral = mysql_query($sql); 
			while ($col = mysql_fetch_array($sql_geral))
			{
			?>
					
          <th width= "50%" align = "center" valign="top" scope="col"><table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
              <th scope="col"><?php echo "<img src = admin/fotos/".$col[foto]." border=0 width=75 align=left>"; ?> 
			  					<b> <?php echo $col[produto]; ?> <b>
								<br />
								Preço: R$ <?php echo $col[preco]; ?> <br />
								Estoque: <?php echo $col[estoque]; ?> unidades
								</th>
								
				
             </tr>
          </table></th>
		  <?php 	$i++;
		  if 	(i%2==0)
					echo "</tr>";
					} ?>
       
		
      </table>
      <p>&nbsp;  </p>
    </div></th>
  </tr>
</table>
</body>
</html>
