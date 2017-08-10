<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><?php include "cabecalho.php"; ?></td>
  </tr>
  <tr>
    <td width="170" valign="top"><?php include "menu.php"; ?></td>
    <td width="580"><?PHP 
	
	$link = $_GET["link"];
	
		$pag[0] = 'home.php';
		$pag[1] = 'lst_categoria.php';
		$pag[2] = 'frm_categoria.php';
		$pag[3] = 'lst_subcategoria.php';
		$pag[4] = 'frm_subcategoria.php';
		$pag[5] = 'lst_usuario.php';
		$pag[6] = 'frm_usuario.php';
		$pag[7] = 'lst_produtos.php';
		$pag[8] = 'frm_produtos.php';
		$pag[9] = 'frm_sel_cat_produtos.php';
		$pag[10] = 'baixar_foto.php';
		$pag[11] = 'frm_configuracao.php';
		
	If (!empty($link))
	{
		If (file_exists($pag[$link]))
		{
			include $pag[$link];
		} 
		else echo("link não atribuido !");
	}
	else echo("Não há pagina solicitada !");
	
	
	 ?>
	 </td>
  </tr>
  <tr>
    <td colspan="2"><?php include "rodape.php"; ?></td>
  </tr>
</table>

</body>
</html>
