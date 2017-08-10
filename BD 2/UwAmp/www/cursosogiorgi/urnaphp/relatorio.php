<?php

//Importa o arquivo de configuração da conexão do Mysql.
require "config.php";

//Importa as funções cabecalho, rodape e menu.
require "funcoes.php";

//Função que verifica se o usuário está autenticado.
acesso();

// Define a constante da bibllioteca MPDF e inclui a mesma.
define('MPDF_PATH', 'MPDF57/');
include(MPDF_PATH . 'mpdf.php');

// Cria um novo documento.
$mpdf = new mPDF('', '', 0, '', 10, 10);

// Cria um array com valores de formatação
$arr = array(
    'L' => array(
        'content' => 'URNA ELETRÔNICA',
        'font-size' => 10,
        'font-style' => 'B',
        'font-family' => 'serif',
        'color' => '#000000'
    ),
    'C' => array(
        'content' => 'CURSO TÉCNICO EM INFORMÁTICA',
        'font-size' => 10,
        'font-style' => 'B',
        'font-family' => 'serif',
        'color' => '#000000'
    ),
    'R' => array(
        'content' => 'ETECLEME',
        'font-size' => 10,
        'font-style' => 'B',
        'font-family' => 'serif',
        'color' => '#000000'
    ),
    'line' => 1,
);

// Define cabeçalho e rodapé do documento.
$mpdf->SetHeader($arr, 'O');
$mpdf->SetFooter('2014 - Curso Técnico de Informática - Etecleme | Página: {nb}');

// Busca a totalização de votos geral. 
$sqltotal = "select count(*) as total from votos";
$restotal = mysql_query($sqltotal, $con);
$rowtotal = mysql_fetch_assoc($restotal);
$totalg = $rowtotal['total'];

// Busca o logo, nome e a totalização de votos de cada candidato. 
$sql = "SELECT logo,nome,count(codcand) as total FROM candidatos,votos where candidatos.codigo=votos.codcand group by codcand";
$res = mysql_query($sql, $con);

$i = 1;

while ($row = mysql_fetch_assoc($res)) {
// Calcula a porcentagem de cada candidato.
    $porc = ($row['total'] * 100) / $totalg;

// Escreve os resultados 
    $mpdf->WriteHTML("----------------------------------------------------------------------------------------------------------------------------------------------------------------");
    $mpdf->WriteHTML("<img src=\"img/$row[logo]\" width=80 height=30>");
    $mpdf->WriteHTML("$row[nome] : $row[total] votos");
    $mpdf->WriteHTML(number_format($porc, 2, '.', '') . " %");
}
$mpdf->WriteHTML("----------------------------------------------------------------------------------------------------------------------------------------------------------------");

$mpdf->Output();
exit();
?>
