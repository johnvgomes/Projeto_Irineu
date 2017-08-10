<?php


session_name('jcLogin');
session_start();

if(isset($_SESSION['id'])){
	header("Location: system.php");
	exit;
}

include "conexao/conn.php";

$sqlConfiguracoes = "SELECT valor FROM Configuracoes WHERE atributo='nome_escola'";
$rsConfiguracoes = mysql_query($sqlConfiguracoes);
$nome_escola = mysql_result($rsConfiguracoes, 0, "valor");

?>

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-BR"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $nome_escola; ?> Morpheus › Login</title>
	<link rel="shortcut icon" href="favicon.gif" type="image/x-icon">
	<link rel="stylesheet" id="wp-admin-css" href="http://etecia.com.br/portaletecia/wp-admin/css/wp-admin.css?ver=3.4.1" type="text/css" media="all">
<link rel="stylesheet" id="colors-fresh-css" href="http://etecia.com.br/portaletecia/wp-admin/css/colors-fresh.css?ver=3.4.1" type="text/css" media="all">
<meta name="robots" content="noindex,nofollow">
	</head>
	<body class="login">
	<div id="login">
		<h1><img src="logo_morpheus.png" /></h1>

	<?php if($_SESSION['msg']['login-err']){ ?>
		<div id="login_error"><strong>ERRO</strong>: <?php echo $_SESSION['msg']['login-err']; ?>
			<a href="login/recuperar.php" title="Recuperação de Senha">Esqueceu sua senha</a>?<br>
		</div>
	<?php
		unset($_SESSION['msg']['login-err']);
		}
	?>
<form name="loginform" id="loginform" action="login/logar.php" method="post">
	<p>
		<label for="user_login">Nome de usuário (RM se for aluno)<br>
		<input type="text" name="username" id="user_login" class="input" value="" size="20" tabindex="10"></label>
		<input type="hidden" name="login" value="login">
	</p>
	<p>
		<label for="user_pass">Senha<br>
		<input type="password" name="password" id="user_pass" class="input" value="" size="20" tabindex="20"></label>
	</p>
	<p class="forgetmenot"><label for="rememberMe"><input name="rememberMe" type="checkbox" id="rememberMe" value="forever" tabindex="90"> Lembrar</label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Login" tabindex="100">
		<input type="hidden" name="testcookie" value="1">
	</p>
</form>

<p id="nav">
<a href="login/recuperar.php" title="Recuperar senha">Perdeu a senha?</a>
</p>

<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('user_login');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>
	
	</div>

	
	<link rel="stylesheet" id="bizway-adminstyle-css" href="http://etecia.com.br/portaletecia/wp-content/themes/bizway/functions/admin-style.css?ver=3.4.1" type="text/css" media="all">
	<div class="clear"></div>
	
	
	</body></html>