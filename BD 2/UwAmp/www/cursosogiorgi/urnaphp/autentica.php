<?php

//Importa a conexão do banco.
require "config.php";

//Importa as funções cabecalho, rodape e menu.
require "funcoes.php";

// Reseta todas as variáveis de sessão.
session_start();
session_unset();
session_destroy();

// Obtém o logon e a senha
$login = isset($_POST['txtlogin']) ? $_POST['txtlogin'] : null;
$senha = isset($_POST['txtsenha']) ? $_POST['txtsenha'] : null;

// Faz a verificação das variáveis.
$login = verificacampo($login);
$senha = verificacampo($senha);

// Busca o usuário e a senha na tabela de usuários.
$sql = "select * from usuarios where
usuarios.usulogin='$login' and 
usuarios.ususenha='$senha'";

$res = mysql_query($sql, $con);
$usuarios = mysql_fetch_assoc($res);
$usucod = $usuarios['usucod'];

// Se não houve retorno de valores é redirecionado para a tela de login.
if (trim($usuarios['usucod']) == "") {
    header("Location: login.php?erro=invalido");
    exit;
}
// Inicia a sessão e registra as variávies na mesma.
session_start();
$_SESSION['usucod'] = $usuarios['usucod'];
$_SESSION['usulogin'] = $usuarios['usulogin'];
$_SESSION['usunome'] = $usuarios['usunome'];
$_SESSION['ususenha'] = $usuarios['ususenha'];

// Redireciona para a tela de apuração. 
header("Location: acessoapuracao.php");
exit;
?>