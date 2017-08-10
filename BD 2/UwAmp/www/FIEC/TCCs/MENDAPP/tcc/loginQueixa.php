<?php include "conectar.php" ?>

<?php
$url = "/tcc/index.php";

if (isset($_POST['btnlogar'])) {
    try {
        //iniciar sessão
        $con = new Conectar();

        $sql = $con->prepare("SELECT * FROM usuarios WHERE txt_email=? AND txt_senha=?");
        $sql->bindParam(1, $_POST['txtemail'], PDO::PARAM_STR);
        $sql->bindParam(2, @sha1($_POST['txtsenha']), PDO::PARAM_STR);
        $sql->execute();

        //obter numero de registros encontrados
        $num = $sql->rowCount();

        if ($num > 0) {
            $rowValid=$sql->fetch(Conectar::FETCH_ASSOC);
            session_start();
            $_SESSION['sessao'] = sha1(time());
            $_SESSION['email'] = $rowValid["txt_email"];
            $_SESSION['nome'] = $rowValid["txt_usuario"];
            $_SESSION['id'] = $rowValid["id_usuario"];
            header("Location:queixas.php");
        } else {
          header("Location:".$url."?msg=erro");
        }
    } catch (PDOException $exc) {
        header("Location:".$url."?msg=erro");
    }
}
?>
