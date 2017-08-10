<?php
//Importa a conexão do banco.
require "config.php";

//Importa as funções cabecalho, rodape e menu.
require "funcoes.php";

//Chama a função cabecalho para montá-lo.
cabecalho();

// Obtém a variável erro, responsável por mostrar as mensagens abaixo depois de algum erro de autenticação.
if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];
} else {
    $erro = "";
}

if ($erro == "login") {
    session_destroy();
    echo "<div class=\"erro\">É necessário fazer o login no sistema!</div>";
}
if ($erro == "invalido") {
    session_start();
    session_destroy();
    echo "<div class=\"erro\">Usuário ou senha inválidos!</div>";
}
?>

<form action="autentica.php" method="post" name="f1">
    Usuário:
    <input type="text" id="txtlogin" name="txtlogin" class="txtbox" />
    Senha:
    <input type="password" id="txtsenha" name="txtsenha" class="txtbox" />
    <input type="submit" id="btnEntrar" value="Entrar" class="button" />
</form>
<script>
    document.f1.txtlogin.focus();
</script>
<?php
rodape();
?>