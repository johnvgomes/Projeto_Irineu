<?php
//CONTAGEM REGRESSIVA

//configurar timezone
date_default_timezone_set("America/Sao_Paulo");

$agora = time();

//data do evento
$ano = 2015;
$mes = 12;
$dia = 25;
$hora = 22;
$minuto = 00;
$segundo = 00;

//monta o evento no formato time() como está $agora
$evento = mktime($hora,$minuto,$segundo,$mes,$dia,$ano);

//subtrair
$diferenca_em_segundos = $evento - $agora;

$dias_restantes = floor($diferenca_em_segundos/60/60/24);

$horas_restantes = floor(($diferenca_em_segundos-($dias_restantes*60*60*24))/60/60);

$minutos_restantes = floor(($diferenca_em_segundos-($dias_restantes*60*60*24)-($horas_restantes*60*60))/60);

$segundos_restantes = floor(($diferenca_em_segundos-($dias_restantes*60*60*24)-($horas_restantes*60*60))-($minutos_restantes*60));

//$anos = $diferenca_em_segundos/60/60/24/365;

//definir formato
$formato_data = "d/m/Y H:i:s";

$evento_formatado = date($formato_data,$evento);
$agora_formatado = date($formato_data,$agora);

?>

Data atual: <?php echo $agora_formatado; ?><br>
Data do evento: <?php echo $evento_formatado; ?><br>
Faltam: <?php echo "$dias_restantes dias, $horas_restantes horas, $minutos_restantes minutos, $segundos_restantes segundos, para o Natal!"; ?>






