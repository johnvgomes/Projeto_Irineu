<?php

//Importa o arquivo de configuração da conexão do Mysql.
require "config.php";

//Importa as funções cabecalho, rodape e menu.
require "funcoes.php";

//Chama a função cabecalho para montá-lo.
cabecalho();

// Recebe o voto do usuário.
$voto = $_POST['txtvoto'];

// Função que verifica a entrada do usuário.
$voto = verificacampo($voto);

// Comando SQL que inseri na tabela votos.
$sql = "insert into votos values(0,$voto)";
$res = mysql_query($sql, $con);

// Se o voto foi inserido com sucesso é disparado o som da urna e informado ao usuário.
// Após 4 segundos é redirecionado para a tela voto.
if ($res) {
    echo "<h1>Voto cadastrado. Obrigado!</h1>";
    echo "<audio controls autoplay=\"autoplay\" class=\"som\">
<source src=\"voto_confirma.wav\" type=\"audio/wav\" />
</audio>
";
    header("Refresh: 4; URL=index.php");
} else {
    echo "<h1>Erro ao votar.</h1>";
}
rodape();
?>