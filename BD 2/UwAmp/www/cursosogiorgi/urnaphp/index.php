<?php

//Importa a conexão do banco.
require "config.php";

//Importa as funções cabecalho, rodape e menu.
require "funcoes.php";

//Chama a função cabecalho para montá-lo.
cabecalho();

// Obtém a variável erro, responsável por mostrar as mensagens abaixo depois de sair da apuração.
if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];
} else {
    $erro = "";
}

if ($erro == "login") {
    session_start();
    session_destroy();
    echo "<div class=\"erro\">É necessário fazer o login no sistema!</div>";
}
if ($erro == "logout") {
    session_start();
    session_destroy();
    echo "<div class=\"erro\">Sessão encerrada!</div>";
}

// Seleciona todos os candidatos cadastrados ordenado por código
$sql = "select * from candidatos order by codigo";
$res = mysql_query($sql, $con);
echo "<strong>CANDIDATOS CONCORRENDO NA ELEIÇÃO </strong><p>";
echo "<table width=\"100%\" ><tr>";

// Mostra os candidatos.
while ($row = mysql_fetch_assoc($res)) {
    echo "<td align=\"center\"><div class=\"logotipo\"><img src=\"img/$row[logo]\" width=80 height=30><p>
<strong>Número: $row[codigo]</strong></div></td>";
}

// Monta o formulário para a votação.
echo "
</tr></table><p>
<form action=\"gravavotos.php\" method=\"post\" name=\"furna\" id=\"furna\" onSubmit=\"return false\" >
<label>
Número:
<input type=\"text\" name=\"txtvoto\" size=\"3\" maxlength=\"3\" id=\"txtvoto\">
</label>
<p>
<span class=\"carregando2\"><img src=\"ajax-loader.gif\" /></span>
<span class=\"logo\" id=\"logo\">Informe o número do candidato.</span>

<script type=\"text/javascript\">
$(function(){
$('#txtvoto').keyup(function(){
if( $(this).val() ) {
$('#logo').hide();
$('.carregando2').show();

$.getJSON('buscacandidato.php?codigo=',{codigo: $(this).val(), ajax: 'true'},function(j){
var cand;
for (var i = 0; i < j.length; i++) {
var cand = '<p><div class=\"logotipo2\"><img src=img/'+j[i].logo+' width=150 height=80><p><strong>CANDIDATO: '+j[i].nome+' <br>Número: '+j[i].codigo+'</strong></div>';
} 

$('#logo').html(cand).show();
$('.carregando2').hide();
if (j[0].logo=='invalido.png'){
$('.confirma').hide(); 
$('.corrige').show(); 
}else{
$('.confirma').show();
$('.corrige').show();
}
});
} else {
$('#logo').html('Informe o número do candidato.');
$('.confirma').hide();
}
});
});
</script>
<p>
<table><tr><td>
<span class=\"corrige\">
<img src=\"img/corrige.png\" onClick=\"limpar();\">
</span>
</td><td>
<span class=\"confirma\">
<img src=\"img/confirma.png\" onClick=\"enviar();\">
</span>
</td></tr></table>
</p>
</form>
<script>
document.furna.txtvoto.focus();
</script>";

//Chama a função rodape.
rodape();
?>