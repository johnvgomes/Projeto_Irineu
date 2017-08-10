<?php include "conexao.php";

$txt_categoria = $_POST[txt_categoria];
$acao = $_POST[acao];
$id = $_POST[id];

if ($acao == "Inserir") 
{
$sql = "insert into categorias (categoria) values ('$txt_categoria')";
mysql_query("$sql") or die ("não foi possivel inserir registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=1'</script>";
}

if ($acao=="Alterar")
{
$sql = "update categorias set categoria = '$txt_categoria' where id_categoria = $id";
mysql_query("$sql") or die ("não foi possivel alterar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=1'</script>";
}

if ($acao == "Excluir") {
$sql = "Delete from categorias where id_categoria = $id";
mysql_query("$sql") or die ("não foi possivel deletar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=1'</script>";
}





?>