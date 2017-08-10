<?php

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    

?>
<table>
    <form name="formlogin" id="formlogin" method="post">
        <tr>
            <th><h3>Cadastro de Usuário/Login</h3></th>
        </tr>
        <tr>
            <td>
                Email <input type="email" name="txtemail" 
                       id="txtemail" maxlength="100" size="50">
            </td>
        </tr>
        <tr>
            <td>
                Senha <input type="password" name="txtsenha" 
                       id="txtsenha" maxlength="20" size="50">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="btncadastrar" 
                       id="btncadastrar" value="..cadastrar">
            </td>
        </tr>
    </form>
</table>


<?php

// eixo/cadastrar.php

if(isset($_POST['btncadastrar'])){
    include_once '../class/Login.php';
    $l = new Login();
    
    $l->setEmail($_POST['txtemail']);
    $l->setSenha($_POST['txtsenha']);
    
    if($l->consultarEmail() != 1){
        $l->salvar();
    }else{
        echo "Email já cadastrado!";
    }
}

}
?>
