<?php include "conexao.php";

$txt_nome = $_POST[txt_nome];
$txt_email = $_POST[txt_email];
$txt_login = $_POST[txt_login];
$txt_senha = $_POST[txt_senha];
$acao = $_POST[acao];
$id = $_POST[id];

if ($acao == "Inserir") 
{
$sql = "insert into administracao (nome,email,login,senha) values ('$txt_nome','$txt_email','$txt_login','$txt_senha')";
mysql_query("$sql") or die ("não foi possivel inserir registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=5'</script>";
}

if ($acao=="Alterar")
{
$sql = "update administracao set nome = '$txt_nome', email = '$txt_email', login = '$txt_login', senha = '$txt_senha' where id_adm = $id";
mysql_query("$sql") or die ("não foi possivel alterar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=5'</script>";
}

if ($acao == "Excluir") {
$sql = "Delete from administracao where id_adm = $id";
mysql_query("$sql") or die ("não foi possivel deletar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=5'</script>";
}





?>