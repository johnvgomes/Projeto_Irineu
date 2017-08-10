<?php


if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
    <form action="" method="post" >
        <table>
            <tr>
                <td><h3>Formul&aacute;rio de Cadastro de Usuario</h3>
                </td>
            </tr>
            <tr>
                <td><input name="txtemail" type="email" maxlength="100" 
                                  placeholder="Email"/>
                </td>
            </tr>
            <tr>
                <td><input name="txtsenha" type="text" maxlength="10" 
                           placeholder="Senha" />
                </td>
            </tr>
            <tr>
                <td><input name="enviar" type="submit" id="cadastrar" value="Cadastrar Usuario" />
                </td>
            </tr>
        </table>
    </form>
    <?php
//cadastrar.php salvo na pasta adm/eixo
    if (!empty($_POST['txtemail']) && !empty($_POST['txtsenha']) && isset($_POST['enviar'])) {
        //instanciando a class
        require_once '../class/Login.php';
        @$l = new Login("", $_POST['txtemail'], $_POST['txtsenha']);
        if ($l->consultarEmail() != 1) {
            @$l->salvar();
        } else {
            echo 'Email já cadastrado';
        }
    } else {
        echo 'Preencha todos os campos';
    }
    echo '<br><br><br>';
    include_once 'editar.php';
}
?>