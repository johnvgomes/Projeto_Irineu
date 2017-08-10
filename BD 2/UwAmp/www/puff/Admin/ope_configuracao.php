<?php include "conexao.php";

$txt_nome = $_POST[txt_nome];
$txt_endereco = $_POST[txt_endereco];
$txt_bairro = $_POST[txt_bairro];
$txt_cep = $_POST[txt_cep];
$txt_cidade = $_POST[txt_cidade];
$txt_uf = $_POST[txt_uf];
$txt_fone = $_POST[txt_fone];
$txt_cnpj = $_POST[txt_cnpj];
$txt_insc = $_POST[txt_insc];
$txt_email = $_POST[txt_email];
$txt_link = $_POST[txt_link];

$acao = $_POST[acao];
$id = $_POST[id];
/*if ($acao == "Inserir") 
{
$sql = "insert into administracao (nome,email,login,senha) values ('$txt_nome','$txt_email','$txt_login','$txt_senha')";
mysql_query("$sql") or die ("não foi possivel inserir registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=5'</script>";
}
*/
if ($acao=="Alterar")
{
$sql =  "update configuracao set nome = '$txt_nome', endereco = '$txt_endereco',bairro = '$txt_bairro',cep = '$txt_cep',cidade = '$txt_cidade',uf = '$txt_uf',fone = '$txt_fone',cnpj = '$txt_cnpj',inscricao = '$txt_insc',email = '$txt_email',link = '$txt_link' where id_configuracao = $id";
mysql_query("$sql") or die ("não foi possivel alterar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=11&acao=Alterar'</script>";
}

/*if ($acao == "Excluir") {
$sql = "Delete from administracao where id_adm = $id";
mysql_query("$sql") or die ("não foi possivel deletar registro");
print "<script type = 'text/javascript'> location.href = 'principal.php?link=5'</script>";
}
*/




?>