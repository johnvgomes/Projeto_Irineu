<?php

include_once 'Conectar.php';

$con = new Conectar();

$url = "/tcc/FormUsuario.php";




@$usuario = utf8_decode($_POST['txtusuario']);
@$email =  utf8_decode($_POST['txtemail']);
@$senha =  utf8_decode($_POST['txtsenha']);
@$tipo = utf8_decode($_POST['typeuser']);



$cUsuario =$con->prepare ("select * from usuario where usuario = '$usuario'");
$cEmail =$con->prepare ("select * from usuario where email = '$email'");

$cUsuario->execute();
$cEmail->execute();
    $usuarioExiste = $cUsuario->rowCount();  
    $emailExiste = $cEmail->rowCount();
   if($usuarioExiste>0){
       header("Location:".$url."?msg=usuarioExiste");
   exit;}
   else if ($emailExiste>0) {
        header("Location:".$url."?msg=emailExiste");
    exit;
}



$insert  = $con->prepare('insert into usuario (id_usuario, status, usuario, email, senha, tipousuario)'
        . 'values'
        . '(null, "ATIVO", :txt_usuario, :txt_email, :txt_senha, :rbusuario)');

$insert->bindValue(":txt_usuario", $usuario);
$insert->bindValue(":txt_email", $email);
$insert->bindValue(":txt_senha", $senha);
$insert->bindValue(":rbusuario", $tipo);


$verifica = $insert->execute();

if($verifica == 1){
  header("Location:".$url."?msg=sucessoU");
} else{
 header("Location:".$url."?msg=errorU");
}