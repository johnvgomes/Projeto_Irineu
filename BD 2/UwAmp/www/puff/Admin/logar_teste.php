<?php include "conexao.php";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Validando Login</title>
</head>

<body>
<?php 
$login = $_POST[txt_login];
$senha = $_POST[txt_senha];
echo ("$login " . " Inserido" . "<br>");

$logar = mysql_query("SELECT * FROM administracao WHERE login = '$login'") or die("Não consegue executar o script no banco.");

echo (mysql_result($logar,0,login) . " Resultado");

/*if ((strlen($senha) < 1) || (strlen($login) < 1)) {echo("<script>alert('Login ou senha não cadastrado..');</script>");}
elseif (mysql_num_rows($logar) >0) {
   global $login;
   echo("<script>alert('Você está logado, boas compras!');</script>");
   index.php;
} else {echo("<script>alert('Login ou senha não cadastrado.');</script>");
		header("location:logincadastro_pg.php");

	} */
?>
</body>
</html>
