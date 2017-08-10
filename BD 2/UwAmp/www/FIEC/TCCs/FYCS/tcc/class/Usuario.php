<?php include_once './head.php'; ?>

<div class="login">

    <form  action="/tcc/class/CadUsuario.php" method="post" name="frmcadlogin" id="frmcadlogin">
        <?php
    if (isset($_GET["msg"])) {
        if ($_GET["msg"] == "sucessoU") {
            //mensagemUsuario é a class desses textos para css
            echo "<span class=\"mensagemUsuario\">Cadastrado com sucesso!</span>";
        } else if ($_GET["msg"] == "errorU") {
            echo "<span class=\"mensagemUsuario\">Erro ao cadastrar!</span>";
        
        }
        else if ($_GET["msg"] == "usuarioExiste") {
            echo "<span class=\"mensagemUsuario\">Nome de usuário já está sendo utilizado</span>";
        
        }
        else if ($_GET["msg"] == "emailExiste") {
            echo "<span class=\"mensagemUsuario\">Email em uso </span>";
        
        }
       
    }?><center>
        <table>
            <tr>
                <td>
                    <h3>Cadastro de Usuário</h3>
                </td>
            </tr>
             <tr>
                <td>
                    <label>Usuário:</label>
                    <input name="txtusuario" type="text" id="txtusuario"
                           maxlength="100" size="25" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>E-mail:</label>
                    <input name="txtemail" type="email" id="txtemail"
                           maxlength="100" size="26" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Senha:</label>
                    <input name="txtsenha" type="password" maxlength="10"
                           id="txtsenha" size="26" required>
                </td>
            </tr>
             <tr>
                <td>
                    <input type="radio" name="typeuser" value="COMUM" required>Comum<br>
                    <input type="radio" name="typeuser" value="PROFISSIONAL"required>Profissional
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
</center>
<?php
if(isset($_POST['btncadastrar']) && !empty($_POST['txtusuario']) && !empty($_POST['txtemail']) && 
        !empty($_POST['txtsenha'])){
     
      
}else{
   
}

?>

