<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <title>BuyOn - Login</title>

        <link rel='stylesheet' type='text/css' href='../css/login.css' />
    </head>

    <body>
        <div id="lBox">
            <form name="frmlogin" method="post" action="">
                <table>
                    <tr>
                        <td colspan="2" id="lTitle">ADMIN</td>
                    </tr>
                    <tr>
                        <td><label>Usu&aacute;rio</label></td>
                        <td><input name="user" type="text" id="lUser" class="textBox" style="text-transform: uppercase;" autofocus /></td>
                    </tr>
                    <tr>
                        <td><label>Senha</label></td>
                        <td><input name="password" type="password" id="lPassword" class="textBox" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="sbmButton"><input name="login" type="submit" id="lEntrar" value="Entrar" /></td>
                    </tr>
                </table>
            </form>

            <?php
            if (isset($_POST['login'])) {
                try {
                    session_start();

                    require_once '../class/Conectar.php';
                    $con = new Conectar();

                    $stmt = $con->prepare("SELECT * FROM admin WHERE nome=? AND senha=?");
                    $stmt->bindParam(1, $_POST['user'], PDO::PARAM_STR);
                    $stmt->bindParam(2, sha1($_POST['password']), PDO::PARAM_STR);
                    $stmt->execute();

                    $num = $stmt->rowCount();

                    if ($num > 0) {
                        $_SESSION['session'] = sha1(time());
                        if ($linha = $stmt->fetch(PDO::FETCH_NUM)) {
                            $_SESSION['lvl'] = $linha[0];
                            $_SESSION['adm'] = $linha[1];
                        }
                        header("Location: adm.php");
                    } else {
                        echo 'Usu&aacuterio ou senha inv&aacutelido!<br />' . '<hr />' .
                        '<a href="password.php">Esqueceu sua senha?</a>';
                    }
                } catch (PDOException $exc) {
                    echo $exc->getMessage();
                }
            }
            ?> 
        </div>
    </body>
</html>