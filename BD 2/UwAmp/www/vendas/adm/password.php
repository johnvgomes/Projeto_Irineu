<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <title>BuyOn - Recuperar senha</title>

        <link rel="shortcut icon" href="../imagem/adm.ico" />		
        <link rel='stylesheet' type='text/css' href='../css/login.css' />
    </head>

    <body>
        <div id="recuperar">
            <p>
                Para recuperar a senha atual, digite seu e-mail no campo abaixo e clique no bot&atilde;o Enviar.
                <a href="index.php">Clique aqui</a> para voltar.
            </p>

            <form name="frmRecup" method="post" action="">
                <table>
                    <tr>
                        <td><label>E-mail:</label></td>
                        <td><input name="txtEmail" type="email" id="rEmail" autofocus /></td>
                        <td colspan="2" class="sbmButton"><input name="recuperar" type="submit" id="rEnviar" value="Enviar"></td>
                    </tr>
                </table>
            </form>

            <div class="phpBox">
                <?php
                if (isset($_POST['recuperar'])) {

                    require_once '../class/Conectar.php';
                    require_once '../class/Admin.php';

                    $con = new Conectar();
                    $a = new Admin();

                    $newPass = $a->randomPassword();

                    $sqlprep = $con->prepare("SELECT nome FROM admin WHERE email=?");
                    $sqlprep->bindParam(1, strtolower($_POST['txtEmail']), PDO::PARAM_STR);
                    $sqlprep->execute();

                    $num = $sqlprep->rowCount();
                    $linha = $sqlprep->fetch(PDO::FETCH_NUM);


                    if ($num > 0) {
                        $remetente = 'buyon-commerce@outlook.com';
                        $para = $_POST['txtEmail'];
                        $assunto = 'Recuperar Senha - BuyOn';
                        $msg = "Mensagem enviada em: " . date("d/m/Y") .
                                "Os dados seguem abaixo: <br />" .
                                "Nome: " . $linha[0] . "<br />" .
                                "Senha temporária: " . $newPass . "<br /><br />" .
                                "Não esqueça de alterar sua senha.<br />" .
                                "<br /><br /><br />Favor não responder este e-mail.";

                        $headers = "MIME-Version 1.1\n";
                        $headers .= "Content-type: text/html; charset=utf-8\n";
                        $headers .= "From:$remetente\n";
                        $headers .= "Return-Path: $remetente\n";
                        $headers .= "Reply-To: $remetente";

                        $envio = mail($para, $assunto, $msg, $headers, "-f$remetente");

                        if ($envio) {
                            echo "Seu e-mail foi enviado com sucesso!";
                        } else {
                            echo '#Erro: O e-mail n&atilde;o pode ser enviado.';
                        }

                        $sqlprep = $con->prepare("UPDATE admin SET senha=? WHERE email=?");
                        $sqlprep->bindParam(1, sha1($newPass), PDO::PARAM_STR);
                        $sqlprep->bindParam(2, strtolower($_POST['txtEmail']), PDO::PARAM_STR);
                        $sqlprep->execute();
                    } else {
                        echo 'E-mail inv&aacute;lido, verifique se n&atilde;o h&aacute; erro de digita&ccedil;&atilde;o e tente de novo.';
                    }
                }
                ?> 
            </div>
        </div>
    </body>
</html>