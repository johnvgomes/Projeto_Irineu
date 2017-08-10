<form name="formlogin" method="post" action="">
    <table width="200" border="0" align="center" cellpadding="1" cellspacing="1">
        <tr>
            <td colspan="2">Efetuar login - Marcio Ferraz</td>
        </tr>
        <tr>
            <td><label>E-mail: </label>
                <input name="txtemail" type="email" id="email" size="40" maxlength="100">
            </td>
        </tr>
        <tr>
            <td><label>Senha: </label>
                <input name="txtsenha" type="password" id="senha" size="40" maxlength="20">
            </td>
        </tr>
        <tr>
            <td>
                <input name="enviar" type="submit" id="Enviar" value="Logar">
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['enviar'])) {
    try {
        //inicia sessão no S.O.
        session_start();
        //inclue a classe Conectar
        require_once '../class/Conectar.php';
        //instancia Conectar
        $con = new Conectar();
        // Preparando statement
        $stmt = $con->prepare("SELECT * FROM login WHERE email=? 
                    AND senha=?");
        $stmt->bindParam(1, $_POST['txtemail'], PDO::PARAM_STR);
        $stmt->bindParam(2, sha1($_POST['txtsenha']), PDO::PARAM_STR);
        $stmt->execute();

        //obter número de registros retornados
        $num = $stmt->rowCount();

        if ($num > 0) {
            //guarda o numero da sessão
            $_SESSION['sessao'] = sha1(time());
            //acessa a página adm.php
            header("Location: adm.php");
        } else {
            echo 'Login incorreto!';
        }
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}
?> 



