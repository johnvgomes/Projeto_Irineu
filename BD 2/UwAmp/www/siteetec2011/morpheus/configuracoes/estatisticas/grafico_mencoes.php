<?php 
include '../../conexao/conn.php';
$codTurma = $_GET["codTurma"];

// pegar as etapas atuais
$rsEtapaAtual = mysql_query("SELECT codEtapa FROM Etapas WHERE atual=1 ORDER BY semestre");
$codEtapaEM = mysql_result($rsEtapaAtual, 0, 0);
$codEtapa = mysql_result($rsEtapaAtual, 1, 0);
      
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
          ['Disciplina', 'MB', 'B', 'R', 'I' ],
          <?php

          while($rD = mysql_fetch_array($rsDisciplinas)){
            $sigla = $rD["sigla"];
            $cod = $rD["codDisciplina"];
            //buscar a quantidade de faltas
            $sqlMencoes = "SELECT COUNT(Mencoes.codAluno) as total FROM Mencoes
                  WHERE codDisciplina=$cod
                  AND (codEtapa=$codEtapa OR codEtapa=$codEtapaEM)
                  AND mencaoFinal='I'
                  ";
            $rsMencoes = mysql_query($sqlMencoes);
            $totalI = mysql_result($rsMencoes, 0, "total");
            $sqlMencoes = "SELECT COUNT(Mencoes.codAluno) as total FROM Mencoes
                  WHERE codDisciplina=$cod
                  AND (codEtapa=$codEtapa OR codEtapa=$codEtapaEM)
                  AND mencaoFinal='R'
                  ";
            $rsMencoes = mysql_query($sqlMencoes);
            $totalR = mysql_result($rsMencoes, 0, "total");
            $sqlMencoes = "SELECT COUNT(Mencoes.codAluno) as total FROM Mencoes
                  WHERE codDisciplina=$cod
                  AND (codEtapa=$codEtapa OR codEtapa=$codEtapaEM)
                  AND mencaoFinal='B'
                  ";
            $rsMencoes = mysql_query($sqlMencoes);
            $totalB = mysql_result($rsMencoes, 0, "total");
            $sqlMencoes = "SELECT COUNT(Mencoes.codAluno) as total FROM Mencoes
                  WHERE codDisciplina=$cod
                  AND (codEtapa=$codEtapa OR codEtapa=$codEtapaEM)
                  AND mencaoFinal='MB'
                  ";
            $rsMencoes = mysql_query($sqlMencoes);
            $totalMB = mysql_result($rsMencoes, 0, "total");
            echo "['$sigla', $totalMB, $totalB, $totalR, $totalI],\n";
          }
          ?>
          ['',  0, 0, 0, 0]
          
        ]);

        var options = {
          title : 'Menções por Disciplinas',
          vAxis: {title: "Total de Menções"},
          hAxis: {title: "Disciplinas"},
          seriesType: "bars"
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      google.setOnLoadCallback(drawVisualization);
    </script>
</head>
    <h2>Gráfico de Menções - <?php echo $modulo.$serie;?></h2>
    <div id="chart_div" style="width: 1000px; height: 500px;"></div>


