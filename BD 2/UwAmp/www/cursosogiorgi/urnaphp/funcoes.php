<?php

// Função responsável por montar o cabecalhos de todos os scripts.
function cabecalho() {
    echo "<!doctype html>
        <html lang=\"pt-br\">
        <head>
        <meta charset=\"utf-8\">
        <title>Urna Eletrônica</title>
        <link type=\"text/css\" rel=\"stylesheet\" href=\"estilo.css\">
        <script type=\"text/javascript\" src=\"js/jquery-1.10.2.min.js\"></script>
        ";

// Se for a tela de votos aciona as funções em javascript para enviar o voto ou corrigi-lo
    if ($_SERVER['PHP_SELF'] == "/urna/index.php") {
        echo "
        <script>
        function enviar(){
        document.furna.submit();
        }
        function limpar(){
        document.furna.txtvoto.value='';
        document.furna.txtvoto.focus();
        $('#logo').hide();
        $('.confirma').hide();
        $('.corrige').hide(); 
        }
        </script>";
    }
// Monta os divs responsáveis pelo layout em css.
    echo"
        </head>
        <body>
        <div id=\"principal\">
        <div id=\"cabecalho\">
        <div class=\"titulo\">
        Urna Eletrônica <br> Etecleme - Curso Técnico em Informática.
        </div>
        <div class=\"login\"><a href=\"login.php\">Apuração</a></div>
        <div class=\"sair\"><a href=\"index.php?erro=logout\">Sair</a></div>
        </div>
        <div id=\"centro\">";
}

// Função responsável por montar o rodape de todos os scripts.
function rodape() {
    echo "</div>
        <div id=\"rodape\">2014</div>
        </div>
        </body>
        </html>";
}

##################### Função responsável por verificar a entrada dos usuários ##############################

function verificacampo($campo) {
    $naopode = array(";", " or ", " and ", "delete", "update", "insert", "select", "=", "drop table");
    for ($j = 0; $j < sizeof($naopode); $j++) {
        if (preg_match("/$naopode[$j]/i", $campo)) {
            $campo = ' erro ';
        }
    }
    $campo = htmlentities($campo);
    return $campo;
}

###################### Função que verifica se o usuário está logado ##########################################

function acesso() {
    @session_start();
    if (!isset($_SESSION['ususenha'])) {
        header("Location: index.php?erro=login");
        exit;
    }
}

?>
