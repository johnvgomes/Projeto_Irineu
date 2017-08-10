<?php

//Importa o arquivo de configuração da conexão do Mysql.
require "config.php";

//Importa as funções cabecalho, rodape e menu.
require "funcoes.php";

//Chama a função cabecalho para montá-lo.
cabecalho();

//Função que verifica se o usuário está autenticado.
acesso();

// Busca a totalização de votos geral. 
$sqltotal = "select count(*) as total from votos";
$restotal = mysql_query($sqltotal, $con);
$rowtotal = mysql_fetch_assoc($restotal);
$totalg = $rowtotal['total'];

// Busca o logo, nome e a totalização de votos de cada candidato.
$sql = "SELECT logo,nome,count(codcand) as total FROM candidatos,votos where candidatos.codigo=votos.codcand group by codcand";
$res = mysql_query($sql, $con);

// Variável para montar vários gráficos em HTML5.
$i = 1;

// Link para atualizar a tela de apuração.
echo "<div class=\"logotipo2\">
<div class=\"atualizar\"><a href=\"acessoapuracao.php\">Atualizar Dados</a></div>
<h2>APURAÇÃO DA ELEIÇÃO</h2>
<table bordercolor=\"#666666\" width=\"600\">
<tr>
<tH>LOGO</tH>
<tH>CANDIDATO</tH>
<tH>VOTOS</tH>
<tH>GRÁFICO</tH>
<tH>PORCENT.</tH>
</tr>
";
while ($row = mysql_fetch_assoc($res)) {
    $porc = ($row['total'] * 100) / $totalg;

// Por questão de estética essa fórmula foi criada para aumentar a proporção do gráfico.
    $porc2 = $porc * 2.8;

// Rotina em javascript para gerar o gráfico em HTML5.
    echo "<script>
window.addEventListener('load', function () {
// Busca a referencia do elemento 2d
var elem = document.getElementById('grafico_$i');
// Pegamos o contexto 2D.
var context = elem.getContext('2d');
// Definimos as propriedades de estilo, preenchimento cor.
context.fillStyle = '#003399';
// Desenho de um retangulo: (x, y, width, height)
context.fillRect (20, 30, $porc2, 80);
context.strokeStyle = '#000000';
context.strokeRect(18, 5, 280, 140); 
}, false);
</script>";
    echo "<tr>
<td><img src=\"img/$row[logo]\" width=80 height=30></td>
<td>$row[nome] : </td><td align=\"center\">$row[total]</td>
<td width=\"1\"> <canvas id='grafico_$i' style='width:160px; height:20px'></canvas></td>
<td>" . number_format($porc, 2, '.', '') . " %</td>
</tr>";
    $i++;
}
echo "</table>
<h3>
<a href=\"relatorio.php\" target=\"new\">Gerar relatório em PDF</a>
</h3></div>";
rodape();
?>
