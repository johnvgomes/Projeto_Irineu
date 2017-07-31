<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Members - Friend System</title>

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
        
        <h3> Members: </h3>
        
        <?php
        
        $mem_query = mysql_query("SELECT id FROM users WHERE id != ".$_SESSION['user_id']."");
                while($run_men= mysql_fetch_array($mem_query)){
                    
                    $user_id = $run_men['id'];
                    
                    $username =  getuser($user_id,'username');
                    
                    echo "<a href='profile.php?user=$user_id' class='box' style='display:block'>$username</a>";
                            
                    
                    
                }
        ?>
    </div>
</body>
</html>