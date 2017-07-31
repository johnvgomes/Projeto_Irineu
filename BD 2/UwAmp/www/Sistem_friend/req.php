<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Request - Friend System</title>

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
        
        <h3> Requests: </h3>
     <?php
     $my_id = $_SESSION['user_id'];
     $req_query= mysql_query("SELECT de FROM frnd_req WHERE para='$my_id '");
     
     while($run_req = mysql_fetch_array($req_query)){
         $de=$run_req['de'];
         $de_username= getuser($de, 'username');
         echo "<a href='profile.php?user=$de' class='box' style='display:block'>$de_username</a>";
         
         
     }
     ?>
    </div>
</body>
</html>