<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register - Friend System</title>

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
        
        <h3> Register a new account</h3>
        
        <form method="post">
            
            <?php
            
            if(isset($_POST['register'])){
                
                $username = $_POST['username'];
                $password = $_POST['password'];
               if(empty($username) or empty($password)){
                   $message="Os campos Login e/ou Senha estão vazios. Por favor Verifique";
               }
                else{
                   mysql_query("INSERT INTO users VALUES('','".$username."','".  md5($password)."')");
                    $message="OK !!! Agora você já pode logar.";
                }
                
                echo "<div class='box'>$message</div>";
                
            }
            
            ?>
            
            User Name:<br/>
            <input type="text" name="username" autocomplete="off"/>
            <br/><br/>
            
            Password:<br/>
            <input type="password" name="password"/>
            <br/><br/>
            
            <input type="submit" name="register" value="Register" />
        </form>
    </div>
</body>
</html>