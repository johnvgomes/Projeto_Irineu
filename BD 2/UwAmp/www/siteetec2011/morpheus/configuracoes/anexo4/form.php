<?php
session_name('jcLogin');
session_start();

include "../../conexao/conn.php";

$id = $_SESSION['id'];

$meses = array( 1=>"Janeiro", 2=>"Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

// pegar as etapas atuais
$rsEtapaAtual = mysql_query("SELECT codEtapa FROM Etapas WHERE atual=1 ORDER BY semestre");
$codEtapaEM = mysql_result($rsEtapaAtual, 0, 0);
$codEtapa = mysql_result($rsEtapaAtual, 1, 0);

//Se for coordenador mostrar o menu com as turmas do curso
$sqlCurso = "SELECT * FROM Cursos WHERE codCoordenador=$id";
$rsCurso = mysql_query($sqlCurso);


if (mysql_num_rows($rsCurso)>0 ){ 
    $codCurso = mysql_result($rsCurso, 0, "codCurso");

    if (isset($_GET["codTurma"])) {
      $codTurma = $_GET["codTurma"];
      
      //pegar o modulo da turma selecionada
      $sqlTurma = "SELECT modulo, codCurso FROM Turmas
                    INNER JOIN Series ON Series.codSerie=Turmas.codSerie
                    WHERE codTurma=$codTurma";
      $rsTurmas = mysql_query($sqlTurma);
      $modulo = mysql_result($rsTurmas, 0, "modulo");
      $codCursor = mysql_result($rsTurmas, 0, "codCurso");


      //buscar as disciplinas da turma
      $sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCursor AND modulo=$modulo";
      $rsDisciplinas = mysql_query($sqlDisciplinas);
      $qtdeDisciplinas = mysql_num_rows($rsDisciplinas);
    }

      $sqlTurmas = "SELECT Turmas.*, Series.* FROM Turmas 
          INNER JOIN Series ON Series.codSerie=Turmas.codSerie
          WHERE ";

      $contCurso=1;
      $rsCurso = mysql_query($sqlCurso);
      $sqlTurmas.="(";
      while($rCursos=mysql_fetch_array($rsCurso)){
        $codCurso = $rCursos["codCurso"];
        if ($contCurso==1) $sqlTurmas.=" Series.codCurso=$codCurso";
        else $sqlTurmas.=" OR Series.codCurso=$codCurso";
        $contCurso++;
      }
      $sqlTurmas.=")";
          
      $sqlTurmas .= " AND (Turmas.codEtapa=$codEtapa OR Turmas.codEtapa=$codEtapaEM) 
              ORDER BY modulo, serie";
    
    //echo $sqlTurmas;
    $rsTurmas = mysql_query($sqlTurmas);

}
?>

<html>
  <head>
    <meta charset="utf8">
    <title>Anexo IV</title>
    <script type="text/css" ></script>
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="style_anexo4.css" rel="stylesheet" media="screen">
    <script src="../../includes/jquery/js/jquery-1.7.2.min.js"></script>
    <style type="text/css">
      body{
        margin: 10px;
      }
    </style>
  <script type="text/javascript">
    $(function(){

        $(".campo").change(function () {
          var nomeCampo = $(this).attr("name");
          var codDisciplina = $(this).attr("codDisciplina");
          var mes = $(this).attr("mes");
          var valor = $(this).attr("value");
          //alert(nomeCampo + " " + codDisciplina + " " + mes + " " + valor);
          $.post("gravar_anexo4.php", 
            {coddisciplina: codDisciplina, codturma: <?php echo $codTurma;?>, campo: nomeCampo, mes: mes, valor : valor })
              .error(function() { alert("Erro ao gravar dados. Banco de Dados Indisponível"); }) 
        });
    });      
  </script>
    
  </head>
  <body>
    <h1>Anexo IV</h1>
    <div class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="#">Escolha a turma</a>
        <ul class="nav">
       <?php
        while($rTurma = mysql_fetch_array($rsTurmas)){
          $codTurmar = $rTurma["codTurma"];
          $modulo = $rTurma["modulo"];
          $serie = $rTurma["serie"];
          $turma = $modulo.$serie;
          $active = ($codTurma==$codTurmar)?"class='active'":"";
          echo "<li $active><a href='form.php?codTurma=$codTurmar' >$turma</a></li>";
        }
      ?>
        </ul>
      </div>
    </div>

  <table>
    <thead>
      <tr>
        <th>Disciplina</th>
        <?php 
        while ($rDisciplina = mysql_fetch_array($rsDisciplinas)){
          $disciplina = $rDisciplina["disciplina"];
          echo "<th colspan=5 class='cabecalho_disciplinas'>".$disciplina."</th>";
        }
        echo "<th colspan=5>TOTAL</th>";
        ?>
      </tr>
      <tr>
        <th>Mês</th>
        <?php
        for($i=0;$i<=$qtdeDisciplinas;$i++){
           echo "<th class='vertical cabecalho_aulas'>APDCT</th>"; 
           echo "<th class='vertical cabecalho_aulas'>AP</th>"; 
           echo "<th class='vertical cabecalho_aulas'>AD</th>"; 
           echo "<th class='vertical cabecalho_aulas'>DEF</th>"; 
           echo "<th class='vertical cabecalho_aulas'>REP/SUB</th>"; 
        }
        ?>
      </tr>
    </thead>
    <tbody>
      <?php

        $total_total_divisao = 0;
        $total_total_previstas = 0;
        $total_total_dadas = 0;
        $total_total_dif = 0;
        $total_total_reposicao = 0;

      for ($i=2; $i < 8 ; $i ++ ){
        echo "<tr>";
        echo "<td>".$meses[$i]."</td>";
        //recarregar consulta das matérias
        $rsDisciplinas = mysql_query($sqlDisciplinas);
        
        $total_divisao = 0;
        $total_previstas = 0;
        $total_dadas = 0;
        $total_dif = 0;
        $total_reposicao = 0;

        while ($rDisciplina = mysql_fetch_array($rsDisciplinas)) {
          $codDisciplina = $rDisciplina["codDisciplina"];
          //buscar valores digitados no anexo 4
          $sqlAnexo4 = "SELECT * FROM Anexo4 
                        WHERE codDisciplina=$codDisciplina
                        AND codTurma=$codTurma
                        AND mes=$i";
          $rsAnexo4 = mysql_query($sqlAnexo4);
          $aulas_com_divisao = mysql_result($rsAnexo4, 0, "aulasComDivisao");
          $aulas_previstas = mysql_result($rsAnexo4, 0, "aulasPrevistas");
          $reposicao_substituicao = mysql_result($rsAnexo4, 0, "reposicaoSubstituicao");
          $aulasDadas = mysql_result($rsAnexo4, 0, "aulasDadas");

          //calcular o deficite de aulas
          $def = ($aulas_com_divisao + $aulas_previstas) - $aulasDadas;

          $total_divisao += $aulas_com_divisao;
          $total_previstas += $aulas_previstas;
          $total_dadas += $aulasDadas;
          $total_dif += $def;
          $total_reposicao += $reposicao_substituicao;

          echo "<td><input type='text' name='aulasComDivisao' codDisciplina='$codDisciplina' mes='$i' class='input-micro campo' maxlength=4 value='$aulas_com_divisao' /></td>";
          echo "<td><input type='text' name='aulasPrevistas' codDisciplina='$codDisciplina' mes='$i' class='input-micro campo' maxlength=4 value='$aulas_previstas'/></td>";
          echo "<td><input type='text' name='aulasDadas' codDisciplina='$codDisciplina' mes='$i' class='input-micro campo' maxlength=4 value='$aulasDadas'/></td>";
          echo "<td class='conteudo'>$def</td>";
          echo "<td><input type='text' name='reposicaoSubstituicao' codDisciplina='$codDisciplina' mes='$i' class='input-micro campo' maxlength=4 value='$reposicao_substituicao'/></td>";
        }

          echo "<td class='conteudo'>$total_divisao</td>";
          echo "<td class='conteudo'>$total_previstas</td>";
          echo "<td class='conteudo'>$total_dadas</td>";
          echo "<td class='conteudo'>$total_dif</td>";
          echo "<td class='conteudo'>$total_reposicao</td>";
          
          $total_total_divisao += $total_divisao;
          $total_total_previstas += $total_previstas;
          $total_total_dadas += $total_dadas;
          $total_total_dif += $total_dif;
          $total_total_reposicao += $total_reposicao;

        echo "</tr>";
      }



      //Linha TOTAL
      echo "<tr>";
      echo "<th>Total</th>";
      $rsDisciplinas = mysql_query($sqlDisciplinas);
      while ($rDisciplina = mysql_fetch_array($rsDisciplinas)) {
        $codDisciplina = $rDisciplina["codDisciplina"];

        //buscar valores digitados no anexo 4
          $sqlAnexo4 = "SELECT sum(aulasComDivisao) as aulasComDivisao,
                                sum(aulasPrevistas) as aulasPrevistas,
                                sum(reposicaoSubstituicao) as reposicaoSubstituicao
                        FROM Anexo4 
                        WHERE codDisciplina=$codDisciplina
                        AND codTurma=$codTurma";
          $rsAnexo4 = mysql_query($sqlAnexo4);
          $aulas_com_divisao = mysql_result($rsAnexo4, 0, "aulasComDivisao");
          $aulas_previstas = mysql_result($rsAnexo4, 0, "aulasPrevistas");
          $reposicao_substituicao = mysql_result($rsAnexo4, 0, "reposicaoSubstituicao");
          $aulasDadas = mysql_result($rsAnexo4, 0, "aulasDadas");

        $def = ($aulas_com_divisao + $aulas_previstas) - $aulasDadas;

        echo "<th class='conteudo'>$aulas_com_divisao</th>";
        echo "<th class='conteudo'>$aulas_previstas</th>";
        echo "<th class='conteudo'>$aulasDadas</th>";
        echo "<th class='conteudo'>$def</th>";
        echo "<th class='conteudo'>$reposicao_substituicao</th>";
      }
        
        echo "<th class='conteudo'>$total_total_divisao</th>";
        echo "<th class='conteudo'>$total_total_previstas</th>";
        echo "<th class='conteudo'>$total_total_dadas</th>";
        echo "<th class='conteudo'>$total_total_dif</th>";
        echo "<th class='conteudo'>$total_total_reposicao</th>";

      echo "</tr>";

      //Linha Aulas Dadas + Reposição
      echo "<tr>";
      echo "<th>Aulas Dadas + Reposição</th>";
      $rsDisciplinas = mysql_query($sqlDisciplinas);
      while ($rDisciplina = mysql_fetch_array($rsDisciplinas)){
        $codDisciplina = $rDisciplina["codDisciplina"];
        $sqlAnexo4 = "SELECT SUM(reposicaoSubstituicao) as reposicaoSubstituicao FROM Anexo4 
                      WHERE codDisciplina=$codDisciplina 
                      AND codTurma=$codTurma";
        $rsAnexo4 = mysql_query($sqlAnexo4);
        $aulasDadas = mysql_result($rsAnexo4, 0, "aulasDadas");
        $reposicaoSubstituicao = mysql_result($rsAnexo4, 0, "reposicaoSubstituicao");
        $total = $aulasDadas + $reposicaoSubstituicao;
        echo "<th colspan=5 class='subtotal'>$total</th>";
      }

      //TOTAL FINAL
      $total_final = $total_total_dadas + $total_total_reposicao;
      echo "<th colspan=5 rowspan=2 class='total'>$total_final</th>";

      echo "</tr>";

      //Linha Reposição de Aulas
      echo "<tr>";
      echo "<th>Reposição (Aulas)</th>";
      $rsDisciplinas = mysql_query($sqlDisciplinas);
      while ($rDisciplina = mysql_fetch_array($rsDisciplinas)){
        $codDisciplina = $rDisciplina["codDisciplina"];
        $sqlAnexo4 = "SELECT SUM(reposicaoSubstituicao) as reposicaoSubstituicao FROM Anexo4 
                      WHERE codDisciplina=$codDisciplina 
                      AND codTurma=$codTurma";
        $rsAnexo4 = mysql_query($sqlAnexo4);
        $reposicaoSubstituicao = mysql_result($rsAnexo4, 0, "reposicaoSubstituicao");
        echo "<th colspan=5 class='subtotal'>$reposicaoSubstituicao</th>";
      }

  
      echo "</tr>";
        ?>
      
    </tbody>
  </table>
  <br />
  <form action="form.php" method="get">
<input type="hidden" name="codTurma" value="<?php echo $codTurma;?>" />
<input type="submit" class='btn btn-primary' value="Gravar" />
</form>

  </body>
</html>

