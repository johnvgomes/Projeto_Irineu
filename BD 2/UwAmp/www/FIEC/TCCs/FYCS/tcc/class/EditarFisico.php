<?php
session_start();
include_once 'Conectar.php';
include_once 'UltimoID.php';

$con = new Conectar();

$url = "/tcc/FormEditar.php";
$nome= utf8_decode($_POST['txtnome']);
$cpf= utf8_decode($_POST['txtcpf']);
$rg =utf8_decode($_POST['txtrg']);
$descricao_servico= utf8_decode($_POST['txtdescricao']);
$id_categoria=utf8_decode($_POST['cbocategoria']);
$rua=utf8_decode($_POST['txtrua']);
$cep=utf8_decode($_POST['txtcep']);
$numero=utf8_decode($_POST['txtnumero']);
$cidade=utf8_decode($_POST['txtcidade']);
$email=utf8_decode($_POST['txtemail']);
$telefone=utf8_decode($_POST['txttelefone']);
$ie=utf8_decode($_POST['txtie']);
$cnpj=utf8_decode($_POST['txtcnpj']);


 $idusuario =  $_SESSION['IdUsuario'];

//aqui pego as informações do profissional a partir do id que está na sessão
    $sql = "SELECT * FROM profissional WHERE id_usuario = '".$idusuario."'";  

    $res = $con->query($sql); 

    $row = $res->fetch(PDO::FETCH_NUM);

    
    //tratando o erros caso o RG e/ou CPF já existam no banco
$cCPF =$con->prepare ("SELECT * FROM profissional WHERE cpf = '$cpf'");

$cRG =$con->prepare ("SELECT * FROM profissional WHERE rg = '$rg'");

   $cCPF->execute();
   $cRG->execute();
    $cpfExiste = $cCPF->rowCount();  
    $rgExiste = $cRG->rowCount();
   if($cpfExiste>0){
       header("Location:".$url."?msg=cpfExiste");
   }  else if ($rgExiste>0) {
        header("Location:".$url."?msg=rgExiste");
    
}
if($row[2]==NULL) {


$insert = $con->prepare("update profissional set nome = '$nome', rg = '$rg', cpf = '$cpf', descricao_servico ='$descricao_servico', status = 'INATIVO',  id_categoria ='$id_categoria' where id_usuario = '$idusuario'");
}else {
  $insert = $con->prepare("update profissional set nome = '$nome', cnpj = '$cnpj', ie = '$ie', descricao_servico ='$descricao_servico', status = 'INATIVO',  id_categoria ='$id_categoria' where id_usuario = '$idusuario'");

}

$verifica = $insert->execute();
 

$idProfissional = $con->lastInsertId();


$insEndereco = $con->prepare("update endereco set rua = '$rua', numero = '$numero', cep ='$cep', cidade = '$cidade' where id_profissional = '$row[0]'");


$insEndereco->execute();

$insTelefone = $con->prepare("update telefone set numero = '$telefone' where id_profissional = '$row[0]'");


$insTelefone->execute();

$insEmail = $con->prepare("update email set endereco_email ='$email'  where id_profissional = '$row[0]'");

$insEmail->execute();


if($verifica == 1){
  header("Location:".$url."?msg=sucesso");
} else{
 header("Location:".$url."?msg=error");
}




  function carregarSelect() {
        try {
            $sql = "SELECT * FROM categoria";

            $r = $this->con->query($sql);

            while ($linha = $r->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$linha[1]'>$linha[0]</option>";
            }
        } catch (PDOException $exc) {
            echo "Erro no carregarSelect de Profissional Fisico " . $exc->getMessage();
        }
    }


    
?>

    


