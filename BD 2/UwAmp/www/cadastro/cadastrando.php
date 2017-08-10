<html>
<head>
<title>cadastrando...</title>
</head>

<body>


<?php
 
$host= "localhost";
$user= "root";
$pass= "root";
$banco= "cadastro";
$conexao = mysql_connect($host,$user,$pass)or die(mysql_error());
mysql_select_db($banco)or die(mysql_error());
?>

<?php
$nome=$_POST['nome'];
$sobrenome=$_POST['sobrenome'];
$pais=$_POST['pais'];
$estado=$_POST['estado'];
$cidade=$_POST['cidade'];
$email=$_POST['email'];
$senha=$_POST['senha'];

$sql = mysql_query("INSERT INTO usuarios(nome, sobrenome, pais, estado, cidade, email, senha)
VALUES('$nome','$sobrenome','$pais','$estado','$cidade','$email','$senha')");
?>

</body>
</html>