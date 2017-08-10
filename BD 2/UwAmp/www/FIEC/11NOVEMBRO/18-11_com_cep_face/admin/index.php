<html>
    <head>
        <link href="../css/login.css" type="text/css" rel="stylesheet" >
        <title>Acesso Administrador</title>
    </head>
    <body>
        <div class="login">
            <form name="frmlogin" method="post" id="frmlogin">
                <table>
                    <tr>
                        <td>
                            <h3>Efetuar Login - FIEC</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>E-mail:</label>
                            <input name="txtemail" type="email" id="txtemail"
                                   size="50" maxlength="100">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Senha:</label>
                            <input name="txtsenha" type="password" id="txtsenha"
                                   size="50" maxlength="10">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="reset" name="btnlimpar" value="Limpar"
                                   id="btnlimpar">
                            <input type="submit" name="btnlogar" value="Logar"
                                   id="btnlogar">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
<?php
if (isset($_POST['btnlogar'])) {
    try {
        //iniciar sessão
        session_start();

        include_once '../class/Conectar.php';
        $con = new Conectar();

        $sql = $con->prepare("SELECT * FROM login WHERE email=? "
                . "AND senha=?");
        $sql->bindParam(1, $_POST['txtemail'], PDO::PARAM_STR);
        $sql->bindParam(2, @sha1($_POST['txtsenha']), PDO::PARAM_STR);
        $sql->execute();

        //obter numero de registros encontrados
        $num = $sql->rowCount();

        if ($num > 0) {
            $_SESSION['sessao'] = sha1(time());
            header("Location: adm.php");
        } else {
            echo "Email e/ou senha incorreto(s)";
        }
    } catch (PDOException $exc) {
        echo "Erro ao logar usuário " . $exc->getMessage();
    }
}
?>
