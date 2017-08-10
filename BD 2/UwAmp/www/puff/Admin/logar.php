<?php include ("conexao.php");
session_start(adm);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php 

$txt_login = $_POST["txt_login"];
$txt_senha = $_POST["txt_senha"];




	$sql = "select * from administracao where login = '$txt_login' and senha = '$txt_senha'";
	$resultado = mysql_query($sql);
	
if (mysql_num_rows($resultado) > 0)
{

	$_SESSION["txt_login"] = $txt_login;
	$_SESSION["txt_senha"] = $txt_senha;
	
echo("<script>alert('Olá, '$txt_login' você esta logado, Boas Compras!');</script>");
		header("location:principal.php");
}
else
{
echo("<script>alert('Login '$txt_login' ou senha '$txt_senha' não cadastrado.');</script>");
header("location:index.php");
//print "<script type = 'text/javascript'> location.href = 'index.php'</script>";
}

?>

</body>
</html>
