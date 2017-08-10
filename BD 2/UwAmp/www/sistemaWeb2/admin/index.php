<link href="css/contato.css" type="text/css"
      rel="stylesheet">

<div class="login">
    <h3>Acesso Admin</h3>
    <form name="formlogin" method="post" 
          id="formlogin">
        E-mail:
        <input name="txtemail" type="email" 
               size="50" maxlength="100" 
               id="txtemail">
        <br>
        Senha:
        <input type="password" name="txtsenha"
               size="50" maxlength="20"
               id="txtsenha">
        <br>
        <input type="submit" name="btnenviar"
               id="btnenviar" value="logar">
        
    </form>
</div>

<?php
if(isset($_POST['btnenviar'])){
    //inicia sessão no SO
    session_start();
    
    include_once '../class/Conectar.php';
    
    $con = new Conectar();
    
    $sql = $con->prepare("SELECT * FROM login 
        WHERE email=? AND senha=?");
    
    @$sql->bindParam(1, $_POST['txtemail'],
            PDO::PARAM_STR);
    @$sql->bindParam(2, sha1($_POST['txtsenha']),
            PDO::PARAM_STR);
    @$sql->execute();
    
    //obter numero de usuarios cadastrados
    $num = $sql->rowCount();
    
    if($num > 0){
        $_SESSION['sessao'] = sha1(time());
        //time() função que retorna data e hora atual
        //sha1 função que criptografa time()
        $_SESSION['usuario'] = $_POST['txtemail'];
        //acessa a 1ª página do admin
        header("Location: admin.php");
    }else{
        echo "Login incorreto!";
    }
}


?>
