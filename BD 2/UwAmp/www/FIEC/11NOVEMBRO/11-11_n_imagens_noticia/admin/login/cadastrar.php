<?php

session_start();
if(!isset($_SESSION['sessao'])){
    echo "Sem acesso!";
}else{
    

?>
<div class="login">
    <form method="post" name="frmcadlogin" id="frmcadlogin">
        <table>
            <tr>
                <td>
                    <h3>Cadastro de Usuário - Login</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>E-mail:</label>
                    <input name="txtemail" type="email" id="txtemail"
                           maxlength="100" size="50">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Senha:</label>
                    <input name="txtsenha" type="text" maxlength="10"
                           id="txtsenha" size="50">
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btncadastrar" type="submit" 
                           value="Cadastrar" id="btncadastrar">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
if(isset($_POST['btncadastrar']) && !empty($_POST['txtemail']) && 
        !empty($_POST['txtsenha'])){
     
    include_once '../class/Login.php';
    
    $login = new Login();
    $login->setEmail($_POST['txtemail']);
    $login->setSenha($_POST['txtsenha']);
    
    $login->cadastrar();    
}else{
    echo "Preencha email e senha para prosseguir";
}
}
?>