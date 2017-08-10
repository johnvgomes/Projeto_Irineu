
<?php


if (isset($_POST['btnlogar'])) {
    try {

        include_once './class/Conectar.php';
        $con = new Conectar();

        $sql = $con->prepare("select * from usuario where usuario=? "
                . "AND senha=?");
        $sql->bindParam(1, $_POST['txtemail'], PDO::PARAM_STR);
        $sql->bindParam(2, $_POST['txtsenha'], PDO::PARAM_STR);
        $sql->execute();

        //obter numero de registros encontrados
        $num = $sql->rowCount();

        $tipoUsuario = "select * from usuario where usuario = '".$_POST['txtemail']."'";  

        $res = $con->query($tipoUsuario); 

        $row = $res->fetch(PDO::FETCH_NUM);


       $cadastroExiste = "select * from profissional where id_usuario ='".$row[0]."'";
       $tes = $con->query($cadastroExiste); 



        
        if ($num > 0) {
            session_start();
            $_SESSION['sessao'] = time();
            $_SESSION['tipoSessao'] = $row[5];
            $_SESSION['IdUsuario'] = $row[0];

        if($tes->fetch(PDO::FETCH_NUM)){
         $_SESSION['isProfissional'] = "verdade";
            
        }
            
            $_SESSION['NomeUsuario'] = $_POST['txtemail'];
            
            header("Location: index.php");
        } else {
            echo "Email e/ou senha incorreto(s)";
        }




    } catch (PDOException $exc) {
        echo "Erro ao logar usuário " . $exc->getMessage();
    }
}