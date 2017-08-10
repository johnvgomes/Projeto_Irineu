<?php
session_start();
include_once 'Conectar.php';
include_once 'UltimoID.php';

$con = new Conectar();

$url = "/tcc/FormFisico.php";
$nome= utf8_decode($_POST['txtnome']);
$cpf= utf8_decode($_POST['txtcpf']);
$rg =utf8_decode($_POST['txtrg']);
$descricao_servico= utf8_decode($_POST['txtdescricao']);

$id_usuario=$_SESSION['IdUsuario'];
$id_categoria=utf8_decode($_POST['cbocategoria']);
$rua=utf8_decode($_POST['txtrua']);
$cep=utf8_decode($_POST['txtcep']);
$numero=utf8_decode($_POST['txtnumero']);
$cidade=utf8_decode($_POST['txtcidade']);
$email=utf8_decode($_POST['txtemail']);
$telefone=utf8_decode($_POST['txttelefone']);

//tratando o erros caso o RG e/ou CPF já existam no banco
$cCPF =$con->prepare ("SELECT * FROM profissional WHERE cpf = '$cpf'");

$cRG =$con->prepare ("SELECT * FROM profissional WHERE rg = '$rg'");

   $cCPF->execute();
   $cRG->execute();
    $cpfExiste = $cCPF->rowCount();  
    $rgExiste = $cRG->rowCount();
   if($cpfExiste>0){
       header("Location:".$url."?msg=cpfExiste");
   exit;}  else if ($rgExiste>0) {
        header("Location:".$url."?msg=rgExiste");
    
}

$insert = $con->prepare('insert into profissional (id_profissional,nome,cnpj, rg,cpf, descricao_servico, ie, id_categoria, tipo, status, id_usuario)'
        . ' values '
        . '(null, :txt_nome, null, :txt_rg, :txt_cpf, :txt_descricao, null, :cbo_categoria, "Fisico", "INATIVO", :user)');

$insert->bindValue(":txt_nome", $nome);
$insert->bindValue(":txt_rg", $rg);
$insert->bindValue(":txt_cpf", $cpf);
$insert->bindValue(":txt_descricao", $descricao_servico);

$insert->bindValue(":cbo_categoria", $id_categoria);
$insert->bindValue(":user", $id_usuario);



$verifica = $insert->execute();

$idProfissional = $con->lastInsertId();


$insEndereco = $con->prepare('insert into endereco (numero,cep,cidade, rua,id_profissional)'
        . ' values '
        . '(:txt_numero, :txt_cep, :txt_cidade, :txt_rua, :id_pro)');

$insEndereco->bindValue(":txt_numero", $numero);
$insEndereco->bindValue(":txt_cep", $cep);
$insEndereco->bindValue(":txt_cidade", $cidade);
$insEndereco->bindValue(":txt_rua", $rua);
$insEndereco->bindValue(":id_pro", $idProfissional);
$insEndereco->execute();

$insTelefone = $con->prepare('insert into telefone (numero,id_profissional)'
        . ' values '
        . '(:txt_numero, :id_pro)');

$insTelefone->bindValue(":txt_numero", $telefone);
$insTelefone->bindValue(":id_pro", $idProfissional);
$insTelefone->execute();

$insEmail = $con->prepare('insert into email (endereco_email,id_profissional)'
        . ' values '
        . '(:txt_email, :id_pro)');

$insEmail->bindValue(":txt_email", $email);
$insEmail->bindValue(":id_pro", $idProfissional);
$insEmail->execute();


if($verifica == 1){
  header("Location:".$url."?msg=sucesso");
} else{
 header("Location:".$url."?msg=error");
}




  function carregarSelect() {
        try {
            $sql = "select * from categoria";

            $r = $this->con->query($sql);

            while ($linha = $r->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$linha[1]'>$linha[0]</option>";
            }
        } catch (PDOException $exc) {
            echo "Erro no carregarSelect de Profissional Fisico " . $exc->getMessage();
        }
    }
?>

    


