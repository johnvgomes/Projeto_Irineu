<?php

  include "../../conexao/conn.php";

  //Só mostrar os alunos se foi realizada a pesquisa
  if (isset($_GET["busca"])){
    $busca = $_GET["busca"];
    $sqlAlunos = "SELECT *, date_format(nascimento, '%d/%m/%Y') as nascimentoFormatado FROM Alunos WHERE nomeAluno LIKE '%$busca%' OR RM='$busca' ORDER BY nomeAluno";
    $rsAlunos = mysql_query($sqlAlunos);
    $mostrarTabela=true;
  }
  
  //Mostrar quantos alunos estão cadastrados
  $sqlContAlunos = "SELECT COUNT(codAluno) as totalAlunos FROM Alunos";
  $rsContAlunos = mysql_query($sqlContAlunos);
  $qtdeAlunos = mysql_result($rsContAlunos, 0, "totalAlunos");

  
?>

<html>
  <head>
    <meta charset="utf8">
    <title>Cadastro de Alunos</title>
    <script type="text/css" ></script>
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../../includes/jquery/js/jquery-1.7.2.min.js"></script>
    <script src="../../includes/bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../../includes/bootstrap/js/bootstrap-popover.js"></script>
    
  </head>
  <body>
  
  <div>
    <form method="get" class="well" style="margin: 0px; ">
      <input type="search" id="busca" name="busca" value="" class="input-xxlarge search-query" placeholder="Buscar por nome parcial ou pelo RM do aluno" />
      <button type="submit" class="btn"><i class="icon-search"></i> Pesquisar</button>
          <span class="help-inline">
            [<?php echo $qtdeAlunos; ?> alunos cadastrados]              
            <a href="cadastro_aluno.php" class="btn btn-primary"><i class="icon-plus icon-white"></i> Cadastrar Aluno</a>

          </span>

    </form>
  </div>

  <?php if($mostrarTabela) { ?>

    <table class="table table-hover table-condensed table-bordered">
      <thead>
        <tr>
          <th>Nome do Aluno</th>
          <th>RG</th>
          <th>RM</th>
          <th>Nascimento</th>
          <th>Telefone</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($aluno = mysql_fetch_array($rsAlunos)){
          echo "<tr>";
          echo "<td><a href='cadastro_aluno.php?codAluno=".$aluno["codAluno"]."' >".$aluno["nomeAluno"]."</a></td>";
          echo "<td>".$aluno["rg"]."</td>";
          echo "<td>".$aluno["RM"]."</td>";
          echo "<td>".$aluno["nascimentoFormatado"]."</td>";
          echo "<td>".$aluno["telefone"]."</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

  <?php } // fim do if mostrarTabela ?>
  
  </body>
</html>

