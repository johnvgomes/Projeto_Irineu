<?php include "conexao.php";

$inserir = $_POST[inserir];
$alterar = $_POST[alterar];
$excluir = $_GET[excluir];
$acao=$_GET[acao];
$id=$_GET[id];
$txt_categoria = $_POST[txt_categoria];

if ($inserir == "ok") {

mysql_query("insert into categorias (categoria) values ('$txt_categoria')");
}

if ($alterar=="ok"){

mysql_query("update categorias set categoria = '$txt_categoria' where id_categoria = $id");
}

if ($excluir == "ok") {

mysql_query("Delete from categorias where id_categoria = $id");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><?php include "cabecalho.php"; ?></td>
  </tr>
  <tr>
    <td width="170" valign="top"><?php include "menu.php"; ?></td>
    <td width="580"><table width="100%">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		<div align="center" class="style1">
          <p>Categoria</p>
		  <?php
		  
		   if ($acao != "") {
		  
		  $sql = mysql_query("select * from categorias where id_categoria = $id");  ?>
		  
		  <form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF ?>">
            <table width="300" border="1" align="center" cellpadding="2">
              <tr>
                <td width="60">Categoria</td>
                <td width="228"><label>
                  <input name="txt_categoria" type="text" id="txt_categoria" size="35" value ="<?php  echo @mysql_result($sql,0,categoria);?>" />
                </label></td>
              </tr>
              <tr>
                <td colspan="2"><label>
                  <div align="center">
                    <input type="hidden" name="id" value=<?php $id ?> />
                    <input type="hidden" name=<?php echo $acao; ?> value="ok" />
                    <input type="submit" name="Submit" value="Ok" />
                    </div>
                </label></td>
                </tr>
            </table>
              </form>
			  
		  <?php } else {  ?>
		  <table width="99%" border="1">
            <tr>
              <td width="91%">Categorias</td>
              <td colspan="2"><div align="center">Ac&atilde;o</div></td>
              </tr>
			  
	<?php $sql = mysql_query ("select * from categorias");
	   while ($linha = mysql_fetch_array($sql)) { ?>
	   
            <tr>
              <td> <?php echo $linha["categoria"]; ?> </td>
              <td width="5%"><div align="center"><a href = "?acao=alterar&id= <?php echo $linha["id_categoria"]; ?>"> E</div></td>  </a>
              <td width="4%"><div align="center"><a href = "?excluir=ok&id= <?php echo $linha["id_categoria"]; ?>">D</div></td>
            </tr>
			<?php } ?>
            <tr>
              <td colspan="3"><div align="right"><a href = "?acao=inserir">Inserir</div></td>
              </tr>
          </table>
		  <?php } ?>
          <p><?php echo "VAlor da variavel acão: $acao </p>"; 
				  echo "VAlor da variavel id: $id";		   ?></p>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php include "rodape.php"; ?></td>
  </tr>
</table>

</body>

</html>