<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Friends - Friend System</title>

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
        
        <h3> Friends: </h3>
     <?php
        $my_id = $_SESSION['user_id'];
     $frnd_query= mysql_query("SELECT user_one, user_two FROM frnds WHERE user_one='$my_id' OR user_two='$my_id'");
     while($run_frnd = mysql_fetch_array($frnd_query)){
         
         $user_one = $run_frnd['user_one'];
         $user_two = $run_frnd['user_two'];
         
         if($user_one == $my_id){
             $user = $user_two;
         }else{
             $user = $user_one;
     }
         $username = getuser($user, 'username');
         echo "<a href'profile.php?user=$user' class='box' style='display:block'>$username</a>";
     }
   
     ?>
    </div>
</body>
</html>