<?php include "conexao.php";

$txt_subcategoria = $_POST[txt_subcategoria];
$acao = $_POST[acao];
$id = $_POST[id];
$id_categoria = $_POST[id_categoria];

if ($acao == "Inserir") 
{
$sql = "insert into subcategorias (id_categoria,subcategoria) values ('$id_categoria','$txt_subcategoria')";
mysql_query("$sql") or die ("não foi possivel inserir registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=3'</script>";
}

if ($acao=="Alterar")
{
$sql = "update subcategorias set subcategoria = '$txt_subcategoria' where id_subcategoria = $id";
mysql_query("$sql") or die ("não foi possivel alterar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=3'</script>";
}

if ($acao == "Excluir") {
$sql = "Delete from subcategorias where id_subcategoria = $id";
mysql_query("$sql") or die ("não foi possivel deletar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=3'</script>";
}





?>