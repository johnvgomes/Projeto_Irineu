
    <form action="" method="post" >
        <table>
            <tr>
                <td><h3>Formul&aacute;rio de Cadastro de Adiministrador</h3>
                </td>
            </tr>
            <tr>
                <td><input name="txtuser" type="text" maxlength="100" 
                                  placeholder="Usuario"/>
                </td>
            </tr>
            <tr>
                <td><input name="txtsenha" type="password" maxlength="10" 
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
    if (!empty($_POST['txtuser']) && !empty($_POST['txtsenha']) && isset($_POST['enviar'])) {
        //instanciando a class
        require_once '../class/Login_admin.php';
        @$l = new Login_admin("", $_POST['txtuser'], $_POST['txtsenha']);
        if ($l->consultarUsuario() != 1) {
            $l->setNivel("admin");
            @$l->salvar();
        } else {
            echo 'Usuario já cadastrado';
        }
    } else {
        echo 'Preencha todos os campos';
    }
    ?>