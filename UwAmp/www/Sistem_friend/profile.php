<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile - Friend System</title>

<link rel='stylesheet' href="css/style.css" />
</head>

<body> 
<?php 
include 'class/connect.php';
?>

<?php 
include 'class/functions.php';
?>

    
<?php 
include 'header.php';
?>
    
    
    <div class="container">
        <?php
        if(isset($_GET['user']) && !empty($_GET['user'])){
            $user = $_GET['user'];
            
        }else{
            
            $user = $_SESSION['user_id'];
        }
        
        $my_id = $_SESSION['user_id'];
        $username = getuser($user, 'username')
        ?>
        <h3> <?php echo $username; ?></h3>
          <?php
          if($user!=$my_id){
              
             $check_frnd_query= mysql_query("SELECT id FROM frnds WHERE (user_one='$my_id' AND user_two='$user') OR (user_one='$user' AND user_two='$my_id')");
          
             if(mysql_num_rows($check_frnd_query ) == 1){
                 
                 echo "<a href='#' class='box'>Vocês já são amigos</a> | <a href='class/actions.php?action=unfrnd&user=$user' class='box'>Desfazer Amizade com $username</a>";
                 
             }else{
                $de_query = mysql_query("SELECT id FROM frnd_req WHERE de='$user' AND para='$my_id'") ;
                $para_query = mysql_query("SELECT id FROM frnd_req WHERE de='$my_id' AND para='$user'") ;
                
                if(mysql_num_rows($de_query) == 1){
                
                    echo "<a href='class/actions.php?action=noaccept&user=$user'  class='box'>Ignorar</a> | <a href='class/actions.php?action=accept&user=$user' class='box'>Aceitar</a>";
                
                    
                }else if(mysql_num_rows($para_query) == 1){
                    
                     echo "<a href='class/actions.php?action=cancel&user=$user' class='box'>Cancelar Solicitação de Amizade</a>";
                    
                }else{
                    
                    echo "<a href='class/actions.php?action=send&user=$user' class='box'>Enviar Solicitação de Amizade</a>";
                   
                }
                
           
            }
         }
          ?>
    </div> 
</body>
</html>