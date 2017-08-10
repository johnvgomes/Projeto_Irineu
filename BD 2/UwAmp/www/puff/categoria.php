<?php include "conexao.php";

$id_cat = $_GET[id_categoria];
$id_subcat = $_GET[id_subcategoria];
$pagina = $_GET[pagina];

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
    <td valign="top" scope="col"><div align="left">
      <p><span class="style3">..::</span>
          <?php 
	$sql_cat = mysql_query("select * from categorias where id_categoria = $id_cat");
	//echo "select * from categorias where id_categoria = $id_cat"; //verificação de query
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
	
	// inicio paginação
	
	if ($pagina=="")
	{$pagina=1;}
		
		$maximo = 2;
		$inicio = $pagina-1;
	
		$inicio = $maximo*$inicio;
		
		$novo_sql = $sql." order by p.id_produto desc limit $inicio, $maximo";
		$consulta = mysql_query($novo_sql);
		
		$produtos_por_pagina = mysql_num_rows ($consulta);
		
		//fim da paginação
		
	?>
      
   		<table width="100%" border="0" cellspacing="0" cellpadding="4">
        	<tr>
			<?php $sql_geral = mysql_query($novo_sql); 
			while ($i < $produtos_por_pagina)
			{
			?>
			<td width= "50%" align = "center">
						
						<table width="100%" border="1" cellspacing="0" cellpadding="2">
            			<tr>
              			<td>	<?php echo "<img src = admin/fotos/".@mysql_result($sql_geral,$i,foto)." border=0 width=75 align=left>"; ?> 
			  					<b> <?php echo @mysql_result($sql_geral,$i,produto); ?> <b> <br />
								Preço: R$ <?php echo @mysql_result($sql_geral,$i,preco); ?> <br />
								Estoque: <?php echo @mysql_result($sql_geral,$i,estoque); ?> unidades
				          <form id="form1" name="form1" method="post" action="">
				            <label>
				            <input type="image" name="imageField" src="Imagens/icone_detalhes.jpg" />
				            </label>
                                                    <label>
                                                    <input type="image" name="imageField2" src="Imagens/icone_carrinho.jpg" />
                                                    </label>
				          </form>
				          </td>
         				</tr>
          				</table>
			</td>
		  				<?php 	$i++;
		  						if (i%2==1)
								echo "</tr>";
						} ?>
   		</table>
			<?php
			
			$menos = $pagina-1;
			$mais = $pagina+1;
			$p_ini = $mais-1;
			$p_ini = $maximo*$p_ini;
			
			$pg_sql = $sql." limit $p_ini, $maximo";
			$consulta_pag = mysql_query($pg_sql);
			$p_total=mysql_num_rows($consulta_pag);
			
			$p=1;
			$pgs=$qtde_registro/$maximo;
			//$pgs=$p_total/$maximo;  //teste de logica
			//echo "P_total=$p_total,PGS=$pgs,maximo = $maximo, qtd de registros = $qtde_registro <br>"; // verificação de conteudo de variaveis
			$formatado = number_format($pgs);
			
			if ($formatado < $pgs)
			{
				$formatado = $formatado + 1;
			}
			
			//echo "P=$p , Formatado=$formatado, maximo = $maximo, qtd de registros = $qtde_registro, qtd paginas = $pgs <p aling=right>"; // verificação de conteudo de variaveis
			
			while ($p<=$formatado)
			{
				if($pagina == $p)
				{
					echo "<b>$p</b> | ";
				}
				else
				{
					echo " <a href = \"index.php?link=1&id_categoria=$id_cat&id_subcat=$id_subcat&pagina=$p\"><b>$p</b></a> <font color = '#3366cc'>|</font>";
				}
				
				$p++;
			}
			
			
			?>
    </div></td>
  </tr>
</table>
</body>
</html>
