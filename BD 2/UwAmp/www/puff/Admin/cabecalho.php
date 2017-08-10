<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style3 {font-size: 10px; font-family: Arial, Helvetica, sans-serif; }
.style4 {
	font-size: 9px;
	font-family: Arial, Helvetica, sans-serif;
}
.style6 {font-size: 10px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<table width="779" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="4%">&nbsp;</td>
        <td width="33%" align="center" valign="middle"><img src="../Imagens/logo.gif" alt="logo" width="208" height="139" /></td>
        <td width="60%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
          <tr>
            <td width="60%">&nbsp;</td>
            <td width="40%">Administraticva</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="22%"><span class="style6">Login:<?php 
				
			session_start(adm);	
							
			if ($_SESSION["txt_login"] != "") {
			echo("Olá, " . $_SESSION["txt_login"]. ". Você esta logado!");
			} else { echo ("Não Logado"); }
			 
			  ?>
			  
			  </span></td>
                <td width="69%">
				  <span class="style3"><strong>Data:</strong>				
				  <?php  
				$dia_da_semana = array("domingo","segunda","terça","quarta","quinta","sexta","sabado");
				
				$num_dia = date(0);
				$dia_extenso = $dia_da_semana[$num_dia];
				
				echo $dia_extenso.",".date("d/m/y");?>
				
				  <strong>- hora: </strong>
				  <?php echo date("H:i"); ?>			
				  <strong>- IP:</strong> 
				  <?php echo getenv("remote_addr"); ?>				  </span></td>
                <td width="9%">&nbsp;</td>
              </tr>
            </table></td>
            </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
        </table></td>
        <td width="3%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="center"><img src="../Imagens/Topo.gif" alt="Topo" width="753" height="22" border="0" usemap="#Map" /></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<map name="Map" id="Map"><area shape="rect" coords="621,5,731,17" href="principal.php?link=5" /></map></body>
</html>
