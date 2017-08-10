<?PHP 
$servidor = "127.0.0.1";
$usuario = "root";
$senha = "";
$base = "loja";
$con = mysql_connect($servidor,$usuario,$senha) or die ("Não foi possivel conectar ao Servidor.");
mysql_select_db($base,$con) or die ("Não foi possivel conectar ao BD");


?>