<?php

if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
    <form action="" method="post" >
        <table>
            <tr>
                <td><h3>Formul&aacute;rio de Alteração de Senha</h3>
                </td>
            </tr>

            <tr>
                <td>Senha:<input name="txtsenha" type="text" maxlength="10" size="50">
                </td>
            </tr>
            <tr>
                <td>Confirme a senha:<input name="txtconfirme" type="text" maxlength="10" size="50">
                </td>
            </tr>
            <tr>
                <td><input name="senha" type="submit" id="cadastrar" value="Alterar Senha">
                </td>
            </tr>
        </table>
    </form>
    <?php
//cadastrar.php salvo na pasta adm/eixo
    if (!empty($_POST['txtconfirme']) && !empty($_POST['txtsenha']) && isset($_POST['senha'])) {
        //instanciando a class
        require_once '../class/Login.php';
        @$l = new Login();
        if ($_POST['txtsenha'] == $_POST['txtconfirme']) {
            $l->setSenha($_POST['txtsenha']);
            $l->setEmail($_SESSION['usuario']);
            $l->editarSenha();
        } else {
            echo "Digite a senha e confirmação de senha novamente (devem ser iguais)";
        }
        
    } else {
        echo 'Preencha todos os campos';
    }
}
?>