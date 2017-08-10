<?php 
require '../conexao/conn.php';
define('INCLUDE_CHECK',true);
require 'functions.php';

session_name('jcLogin');
// iniciar sessao

session_set_cookie_params(2*7*24*60*60);
// fazer o cookie durar 2 semanas

session_start();

if($_SESSION['id'] && !isset($_COOKIE['jcRemember']) && !$_SESSION['rememberMe'])
{
	$_SESSION = array();
	session_destroy();
}

//comando para fazer logoff
if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: ../index.php");
	exit;
}

//comandos para fazer login
if(isset($_POST['login']))
{
	// verifica se o formulario de login foi submetido
	
	$err = array();
	// armazena os erros
	
	
	if(!$_POST['username'] || !$_POST['password'])
		$err[] = 'Todos os campos devem ser preenchidos!';
	
	if(!count($err))
	{
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		
		// verifica mysql injection

		$row = mysql_fetch_assoc(mysql_query("SELECT codProfessor,login,perfil,Substring_index(nomeProfessor,' ',1) as nome FROM Professores WHERE login='{$_POST['username']}' AND senha='".md5($_POST['password'])."'"));

		if($row['login'])
		{
			// se está tudo certo, loga

			$agent = $_SERVER['HTTP_USER_AGENT'];

			if ( strstr($agent, "Opera") ) $nav = "Opera";
			else if ( strstr($agent, "Firefox") ) $nav = "Mozilla Firefox";
			else if ( strstr($agent, "Chrome") ) $nav = "Google Chrome";
			else if ( strstr($agent, "Safari") ) $nav = "Safari";
			else if ( strstr($agent, "MSIE") ) $nav = "Internet Explorer";//pegar o navegador
		
			$codProf = $row["codProfessor"];
			mysql_query("UPDATE Professores SET dt = NOW(), browser='$nav' WHERE codProfessor=$codProf");
			
			$_SESSION['usr']=$row['nome'];
			$_SESSION['perfil']=$row['perfil'];
			$_SESSION['id'] = $row['codProfessor'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			$_SESSION['tipo'] = "professor";
			// armazena dados na sessao
			
			setcookie('jcRemember',$_POST['rememberMe']);
			
					// Se não houver erros
		
		}
		else{
			//procurar na tabela de alunos
			$sql = "SELECT codAluno,nomeAluno,substring_index(nomeAluno,' ',1) as nome FROM Alunos WHERE login='{$_POST['username']}' AND senha='".md5($_POST['password'])."'";
			$row = mysql_fetch_assoc(mysql_query("SELECT codAluno,nomeAluno,substring_index(nomeAluno,' ',1) as nome FROM Alunos WHERE login='{$_POST['username']}' AND senha='".md5($_POST['password'])."'"));
			if($row['codAluno'])
			{
				// se está tudo certo, loga como aluno

				$agent = $_SERVER['HTTP_USER_AGENT'];

				if ( strstr($agent, "Opera") ) $nav = "Opera";
				else if ( strstr($agent, "Firefox") ) $nav = "Mozilla Firefox";
				else if ( strstr($agent, "Chrome") ) $nav = "Google Chrome";
				else if ( strstr($agent, "Safari") ) $nav = "Safari";
				else if ( strstr($agent, "MSIE") ) $nav = "Internet Explorer";//pegar o navegador
			
				$codAluno = $row["codAluno"];
				mysql_query("UPDATE Alunos SET dt = NOW(), browser='$nav' WHERE codAluno=$codAluno");
				
				$_SESSION['usr']=$row['nome'];
				$_SESSION['id'] = $row['codAluno'];
				$_SESSION['rememberMe'] = $_POST['rememberMe'];
				$_SESSION['tipo'] = "aluno";
				$_SESSION['perfil'] = -1;
				
				// armazena dados na sessao
				
				setcookie('jcRemember',$_POST['rememberMe']);
				
					
			}
			else $err[]='Login e/ou senha incorretos';

		}
		
	}
	if($err)
	$_SESSION['msg']['login-err'] = implode('<br />',$err);
	// Save the error messages in the session

	header("Location: ../index.php");
	exit;
	
}

echo $_SESSION['msg']['login-err'];

?>
