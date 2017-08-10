<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pah Puff - Melhor que esse, pode esperar sentado ...</title>
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
		$pag[1] = 'categoria.php';
		
		
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
