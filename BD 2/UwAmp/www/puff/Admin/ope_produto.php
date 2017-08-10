<?php include "conexao.php";


$acao = $_POST[acao];
$id_produto = $_POST[id];


		  $id_categoria 	= 	$_POST[id_categoria];
		  $id_subcategoria 	= 	$_POST[id_subcategoria];
		  $produto 			=	$_POST[txt_produto];
		  $foto				=	$_POST[txt_foto];
		  $estoque			=	$_POST[txt_estoque];
		  $preco			=	$_POST[txt_preco];
		  $descricao		=	$_POST[textarea];

if ($acao == "Inserir") 
{
$sql = "insert into produtos (id_categoria,id_subcategoria,produto,foto,estoque,preco,descricao) values ('$id_categoria','$id_subcategoria','$produto','$foto','$estoque','$preco','$descricao')";
mysql_query("$sql") or die ("não foi possivel inserir registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=7'</script>";
}

if ($acao=="Alterar")
{

$sql = "update produtos set id_categoria = $id_categoria, id_subcategoria = $id_subcategoria, produto = '$produto', foto = '$foto', estoque = $estoque, preco = $preco, descricao = '$descricao' where id_produto = $id_produto";
mysql_query("$sql") or die ("não foi possivel alterar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=7'</script>";
}

if ($acao == "Excluir") {
$sql = "Delete from produtos where id_produto = $id_produto";
mysql_query("$sql") or die ("não foi possivel deletar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=7'</script>";
}





?>