<?php

include 'Conectar.php';


$action = $_GET['action'];
$con = new Conectar();
        $email_user= $_SESSION["usuario"];
        $pegaUser = $con->prepare(" SELECT * from usuario WHERE email = '$email_user'");
        $pegaUser->execute(array($_SESSION['usuario']));
	$dadosUser = $pegaUser->fetch();

$user = $_GET['user'];

$my_id = $dadosUser['id_usuario'];

if($action == 'send'){
   
    $sql_send_frnds = "INSERT INTO frnd_req VALUES('','$my_id','$user')";
    $sql_send_frnds_prep = $con->prepare($sql_send_frnds );
    $sql_send_frnds_prep->execute();
}


if($action == 'cancel'){
   
    $sql_cancel_frnds = "DELETE FROM frnd_req WHERE de='$my_id' AND para='$user'";
    $sql_cancel_frnds_prep = $con->prepare($sql_cancel_frnds );
    $sql_cancel_frnds_prep->execute();
    
}

if($action == 'noaccept'){
   
    $sql_noacept_frnds = "DELETE FROM frnd_req WHERE de='$user' AND para='$my_id'";
    $sql_noacept_frnds_prep = $con->prepare($sql_noacept_frnds );
    $sql_noacept_frnds_prep->execute();
    
     
     
}

if($action == 'accept'){
    
    $sql_delet_frnds = "DELETE FROM frnd_req WHERE de='$user' AND para='$my_id'";
    $sql_delet_frnds_prep = $con->prepare($sql_delet_frnds );
    $sql_delet_frnds_prep->execute();
            
    $sql_insert_frnds = "INSERT INTO frnds VALUES('','$user','$my_id')";
    $sql_insert_frnds_prep = $con->prepare($sql_insert_frnds );
    $sql_insert_frnds_prep->execute();
    
}

if($action == 'unfrnd'){
   
   
    $sql_unfrd_frnds = "DELETE FROM frnds WHERE (user_one='$my_id' AND user_two='$user') OR (user_one='$user' AND user_two='$my_id')";
    $sql_unfrd_frnds_prep = $con->prepare($sql_unfrd_frnds );
    $sql_unfrd_frnds_prep->execute();
}

header('location: ../Perfil/visualizar.php?user='.$user);
?>

