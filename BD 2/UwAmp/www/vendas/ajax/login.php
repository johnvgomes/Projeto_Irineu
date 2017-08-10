<?php

session_start();

try {
    include_once '../class/Conectar.php';
    $con = new Conectar();

    $stmt = $con->prepare("SELECT * FROM clientes WHERE email=? AND senha=?");
    $stmt->bindParam(1, $_POST['emailCli'], PDO::PARAM_STR);
    $stmt->bindParam(2, sha1($_POST['senhaCli']), PDO::PARAM_STR);
    $stmt->execute();

    $num = $stmt->rowCount();

    if ($num > 0) {
        $_SESSION['cliente'] = sha1(time());
        if ($linha = $stmt->fetch(PDO::FETCH_NUM)) {
            $_SESSION['clienteId'] = $linha[0];
            $_SESSION['clienteNome'] = $linha[1];
        }
    } else {
        echo 'Usuário ou senha inválido! Tente novamente.';
    }
} catch (PDOException $exc) {
    echo $exc->getMessage();
}
?>
