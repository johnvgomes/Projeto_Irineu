<?php
session_name('jcLogin');
session_start();
include "../../conexao/conn.php";

$codProfessor = $_SESSION["id"];
$codDisciplina = $_GET["codDisciplina"];
$codTurma = $_GET["codTurma"];

$rsEtapaAtual = mysql_query("SELECT codEtapa FROM Etapas WHERE atual=1 ORDER BY semestre");
$codEtapaEM = mysql_result($rsEtapaAtual, 0, 0);
$codEtapa = mysql_result($rsEtapaAtual, 1, 0);	

//Buscar a atribuição do professor
$sqlAtribuicao = "SELECT * FROM Atribuicoes WHERE codProfessor=$codProfessor AND codDisciplina=$codDisciplina ORDER BY codAtribuicao DESC";
$rsAtribuicao = mysql_query($sqlAtribuicao);
$codAtribuicao = mysql_result($rsAtribuicao, 0, "codAtribuicao");
$sqlDisciplinas = "SELECT DISTINCT Turmas.codTurma, Turmas.modulo, Series.serie, Disciplinas.disciplina, Disciplinas.sigla, Disciplinas.codDisciplina FROM Atribuicoes
						INNER JOIN Disciplinas ON Disciplinas.codDisciplina=Atribuicoes.codDisciplina
						INNER JOIN Series ON Series.codSerie=Atribuicoes.codSerie
						INNER JOIN Turmas ON Turmas.codSerie=Series.codSerie
						WHERE codProfessor = $codProfessor
						AND (Atribuicoes.codEtapa=$codEtapa OR Atribuicoes.codEtapa=$codEtapaEM)
						AND Disciplinas.modulo=Turmas.modulo
						AND Turmas.codEtapa=Atribuicoes.codEtapa
					";
    					
$rsDisciplinas = mysql_query($sqlDisciplinas);

//Buscar observacoes
$sqlObservacoesProfessores = "SELECT * FROM ObservacoesProfessores WHERE codAtribuicao=$codAtribuicao";
$rsObservacoesProfessores = mysql_query($sqlObservacoesProfessores);

$sqlObservacoesDisciplinas = "SELECT * FROM ObservacoesDisciplinas WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina";
$rsObservacoesDisciplinas = mysql_query($sqlObservacoesDisciplinas);

//Pegar o nome da disciplina
$sqlDisciplina = "SELECT * FROM Disciplinas WHERE codDisciplina=$codDisciplina";
$rsDisciplina = mysql_query($sqlDisciplina);

$nomeDisciplina=mysql_result($rsDisciplina, 0, "disciplina");

//Calcular as notas do professor
$sqlSabeAMateria = "SELECT AVG(resposta) as valor FROM AvaliacaoProfessores WHERE codAtribuicao=$codAtribuicao AND pergunta=1";
$rsSabeAMateria = mysql_query($sqlSabeAMateria);
$nota1 = mysql_result($rsSabeAMateria, 0, "valor");
echo $sqlSabeAMateria;
$sqlSabeEnsinar = "SELECT AVG(resposta) as valor FROM AvaliacaoProfessores WHERE codAtribuicao=$codAtribuicao AND pergunta=2";
$rsSabeEnsinar = mysql_query($sqlSabeEnsinar);
$nota2 = mysql_result($rsSabeEnsinar, 0, "valor");

$sqlPontualidade = "SELECT AVG(resposta) as valor FROM AvaliacaoProfessores WHERE codAtribuicao=$codAtribuicao AND pergunta=3";
$rsPontualidade = mysql_query($sqlPontualidade);
$nota3 = mysql_result($rsPontualidade, 0, "valor");

$sqlRelacionamento = "SELECT AVG(resposta) as valor FROM AvaliacaoProfessores WHERE codAtribuicao=$codAtribuicao AND pergunta=4";
$rsRelacionamento = mysql_query($sqlRelacionamento);
$nota4 = mysql_result($rsRelacionamento, 0, "valor");

$sqlEnsinado = "SELECT AVG(resposta) as valor FROM AvaliacaoDisciplinas WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina AND pergunta=5";
$rsEnsinado = mysql_query($sqlEnsinado);
$nota5 = mysql_result($rsEnsinado, 0, "valor");

$sqlAprendi = "SELECT AVG(resposta) as valor FROM AvaliacaoDisciplinas WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina AND pergunta=6";
$rsAprendi = mysql_query($sqlAprendi);
$nota6 = mysql_result($rsAprendi, 0, "valor");

$sqlRecursos = "SELECT AVG(resposta) as valor FROM AvaliacaoDisciplinas WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina AND pergunta=7";
$rsRecursos = mysql_query($sqlRecursos);
$nota7 = mysql_result($rsRecursos, 0, "valor");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
    </title>
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Criterio', 'Média do Professor'],
          ['Sabe a matéria',  <?php echo $nota1;?>],
          ['Sabe ensinar',  <?php echo $nota2;?>],
          ['Pontualidade e dedicação',  <?php echo $nota3;?>],
          ['Relacionamento',  <?php echo $nota4;?>],
          ['O que foi ensinado',  <?php echo $nota5;?>],
          ['O que eu aprendi',  <?php echo $nota6;?>],
          ['Recursos',  <?php echo $nota7;?>]
        ]);

        var options = {
          title : 'Avaliação da disciplina <?php echo $nomeDisciplina;?>',
          vAxis: {title: "Nota"},
          hAxis: {title: "Critério"},
          seriesType: "bars",
          series: {1: {type: "line"}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body>
  	<h1> Avaliação de Professores</h1>
  	<ul class="nav nav-tabs">
  		<?php while ($rD = mysql_fetch_array($rsDisciplinas)){
  			$codTurma = $rD["codTurma"];
  			$codDisciplina = $rD["codDisciplina"];
  			$sigla = $rD["sigla"];
  			$turma = $rD["modulo"].$rD["serie"];
  			$classe = ($codTurma==$_GET["codTurma"] && $codDisciplina==$_GET["codDisciplina"])?"class='active'":" ";
  			echo "<li $classe><a href='relatorio.php?codTurma=$codTurma&codDisciplina=$codDisciplina'>$sigla ($turma)</a></li>";
  		}
  		?>
	</ul>

  	<h2>Gráfico</h2>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>

    <h2>Observações</h2>

    <?php

    while($rOP = mysql_fetch_array($rsObservacoesProfessores)){
    	echo "<blockquote><p>\"".$rOP["observacao"]."\"</p></blockquote>";
    }
    while($rOD = mysql_fetch_array($rsObservacoesDisciplinas)){
    	echo "<blockquote><p>\"".$rOD["observacao"]."\"</p></blockquote>";
    }
    ?>
  </body>
</html>
