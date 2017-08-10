<?php 
include '../../conexao/conn.php';
$codTurma = $_GET["codTurma"];
      
//pegar o modulo da turma selecionada
$sqlTurma = "SELECT modulo, codCurso, Series.serie FROM Turmas
                    INNER JOIN Series ON Series.codSerie=Turmas.codSerie
                    WHERE codTurma=$codTurma";
$rsTurmas = mysql_query($sqlTurma);
$modulo = mysql_result($rsTurmas, 0, "modulo");
$serie = mysql_result($rsTurmas, 0, "serie");
$codCursor = mysql_result($rsTurmas, 0, "codCurso");

//buscar as disciplinas da turma
$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCursor AND modulo=$modulo";
$rsDisciplinas = mysql_query($sqlDisciplinas);
$qtdeDisciplinas = mysql_num_rows($rsDisciplinas);

?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-BR">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Morpheus - Estatísticas</title>

<link type="text/css" href="../../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="../../includes/bootstrap.css">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Disciplina', 'Total de Faltas'],
          <?php

          while($rD = mysql_fetch_array($rsDisciplinas)){
            $sigla = $rD["sigla"];
            $cod = $rD["codDisciplina"];
            //buscar a quantidade de faltas
            $sqlFaltas = "SELECT COUNT(Faltas.codAula) as faltas FROM Faltas
                  INNER JOIN Aulas ON Aulas.codAula = Faltas.codAula
                  INNER JOIN Encontros ON Encontros.codEncontro = Aulas.codEncontro
                  WHERE Encontros.codDisciplina=$cod";
            $rsFaltas = mysql_query($sqlFaltas);
            $faltas = mysql_result($rsFaltas, 0, "faltas");
            echo "['$sigla', $faltas],\n";
          }
          ?>
          ['',  0]
          
        ]);

        var options = {
          title : 'Faltas por Disciplinas',
          vAxis: {title: "Total de Faltas"},
          hAxis: {title: "Disciplinas"},
          seriesType: "bars",
          series: {1: {type: "line"}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      google.setOnLoadCallback(drawVisualization);
    </script>
</head>
    <h2>Gráfico de Faltas - <?php echo $modulo.$serie;?></h2>
    <div id="chart_div" style="width: 1000px; height: 500px;"></div>


