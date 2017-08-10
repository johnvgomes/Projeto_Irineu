<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - Friend System</title>

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
        
        <h3> Login to your account</h3>
        
        <form method="post">
            
            <?php
            
            if(isset($_POST['login'])){
                
                $username = $_POST['username'];
                $password = $_POST['password'];
               if(empty($username) or empty($password)){
                   $message="Os campos Login e/ou Senha estão vazios. Por favor Verifique";
               }
                else{
                   
                    $check_login= mysql_query("SELECT id FROM users WHERE username='$username' AND password='".md5($password)."'");
                    
                    if(mysql_num_rows($check_login)==1){
                        
                       $message="OK ! Você está logado como $username."; 
                       
                       $get = mysql_fetch_array($check_login);
                       $user_id= $get['id'];
                       $_SESSION['user_id'] = $user_id;
                       
                       header('location: index.php');
                    }
                    else{
                        $message="Nome e/ou senha incorretos"; 
                         
                    }
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
            
            <input type="submit" name="login" value="Entrar" />
        </form>
    </div>
</body>
</html>