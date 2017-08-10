<?php

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    

?>
<table>
    <form name="formlogin" id="formlogin" method="post">
        <tr>
            <th><h3>Alteração de senha</h3></th>
        </tr>
        <tr>
            <td>
                Senha <input type="text" name="txtsenha" 
                       id="txtsenha" maxlength="20" size="50">
            </td>
        </tr>
        <tr>
            <td>
                Confirmar Senha <input type="text" name="txtconf" 
                       id="txtconf" maxlength="20" size="50">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="btncadastrar" 
                       id="btncadastrar" value="alterar senha">
            </td>
        </tr>
    </form>
</table>


<?php
if(isset($_POST['btncadastrar']) && !empty($_POST['txtsenha'])
        && !empty($_POST['txtconf'])){
       
    if($_POST['txtsenha'] == $_POST['txtconf']){
        include_once '../class/Login.php';
        @$l = new Login();
        $l->setSenha($_POST['txtsenha']);
        $l->setEmail($_SESSION['usuario']);
        $l->editarSenha();
    }else{
        echo "Digite a senha e confirmação de senha novamente";
    }
}

}
?>
