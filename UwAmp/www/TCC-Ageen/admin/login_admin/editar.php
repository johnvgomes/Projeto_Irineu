
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
        require_once '../class/Login_admin.php';
        @$l = new Login_admin();
        if ($_POST['txtsenha'] == $_POST['txtconfirme']) {
            $novasenha=$_POST['txtsenha'];
           $l->setSenha($novasenha);
           $l->setUsuario($_SESSION['usuario_admin']);
            $l->editarSenha();
        } else {
            echo "Digite a senha e confirmação de senha novamente (devem ser iguais)";
        }
        
    } else {
        echo 'Preencha todos os campos';
    }

?>