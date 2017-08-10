<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "meta.php" ?>
	<link rel="stylesheet" type="text/css" href="css/login.css" />
    
</head>
<body>	
	<?php include "topo.php" ?>
	<div id="centro">

		<div id="login">
			<div class="col-1">
				<div class="box">
					<div class="title">
						<div class="logo-login">
							<img src="./img/logo.png">
						</div>
						<strong>Área Restrita</strong><br />
						<small>Faça login para continuar</small>
					</div>
					<form action="#" class="form-1" method="post">
						<label for="email" class="clearfix">Usuário</label>
						<input type="text" placeholder="usuário" name="txtemail" id="txtemail" class="big" />
						<label for="txtsenha" class="clearfix">Senha</label>
						<input type="password" name="txtsenha" placeholder="senha" id="txtsenha" class="big" />
						<a href="esqueci-senha.php" class="button"><i class="icon icon-question-sign"></i>Esqueci minha senha</a>
						<div class="actions">
							<button class="dark login" name="btnlogar" id="btnlogar" type="submit"><i class="icon-white icon-user"></i><strong>&nbsp;LOGIN</strong></button>
						</div>
					</form>
				</div>
			</div>
		</div>              
	</div>	
</div>
</div>
<br class="clear"/>
</div>
<?php include "rodape.php" ?>
</body>
</html>
<?php

class Conectar extends PDO {

    private static $instancia;
    private $query;
    private $host = "127.0.0.1";
    //private $host = "endereco.com.br";
    private $usuario = "root";
    //private $usuario = "site123456";
    private $senha = "";
    private $db = "mendapp";

    public function __construct() {
        parent::__construct("mysql:host=$this->host;dbname=$this->db", "$this->usuario", "$this->senha");
    }

    public static function getInstance() {
        // Se o a instancia não existe eu faço uma
        if (!isset(self::$instancia)) {
            try {
                self::$instancia = new Conectar;
            } catch (Exception $e) {
                echo 'Erro ao conectar';
                exit();
            }
        }
        // Se já existe instancia na memória eu retorno ela
        return self::$instancia;
    }

    public function sql($query) {
        $this->getInstance();
        $this->query = $query;
        $stmt = $pdo->prepare($this->query);
        $stmt->execute();
        $pdo = null;
    }

}

?>

<?php
if (isset($_POST['btnlogar'])) {
    try {
        //iniciar sessão
        session_start();
        $con = new Conectar();

        $sql = $con->prepare("SELECT * FROM usuarios WHERE txt_usuario=? "
                . "AND txt_senha=?");
        $sql->bindParam(1, $_POST['txtemail'], PDO::PARAM_STR);
        $sql->bindParam(2, @sha1($_POST['txtsenha']), PDO::PARAM_STR);
        $sql->execute();

        //obter numero de registros encontrados
        $num = $sql->rowCount();

        if ($num > 0) {
            $_SESSION['sessao'] = sha1(time());
            header("Location: cadastrar-queixa.php");
        } else {
            echo "Email e/ou senha incorreto(s)";
        }
    } catch (PDOException $exc) {
        echo "Erro ao logar usuário " . $exc->getMessage();
    }
}
?>