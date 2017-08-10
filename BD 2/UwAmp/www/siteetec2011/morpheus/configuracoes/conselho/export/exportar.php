<?php

session_name('jcLogin');
session_start();

if(!$_SESSION['id']){
  ?>
  <div class="ui-widget">
    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
      <strong>Acesso Negado: </strong>Você precisa estar logado para acessar essa página.
      <a href="../index.php">Fazer Login</a></p>
    </div>
  </div>
  <?php
  
  exit();
}

$codTurma =   $_GET["codturma"]; 
$etapa =   $_GET["etapa"]; 



include ("../../../conexao/conn.php");
include("excelwriter.inc.php");


// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Etapas WHERE atual=1");
$codEtapa = mysql_result($rsEtapaAtual, 0);

$result = mysql_query ( " select concat(Turmas.modulo, Series.serie) as turma  FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie where codTurma=$codTurma");
$row = mysql_fetch_row($result);
$turma = $row[0];
$modulo = substr($turma, 0, 1);
$serie = substr($turma, 1, 1);

//pegar o código do curso
$result = mysql_query ( " select Turmas.codTurma, Series.codCurso FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie WHERE modulo=$modulo and serie='$serie'");
$codCurso = mysql_result($result, 0, "codCurso");

//consultar as disciplinas da turma
$sqlDisciplinas =  "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ORDER BY numeroPlanoDeCurso" ;

//simplifiquei a consulta porque não estava retornando registro
//$sql = " select Alunos.codAluno, Alunos.nomeAluno, Matriculas.status, Matriculas.codMatricula, AulasDadas.aulasDadas, Frequencia.faltas, format((((aulasDadas-faltas)/aulasDadas)*100),1) as frequencia, DecisoesConselho.resumo, DecisoesConselho.resultado from Matriculas INNER JOIN Alunos ON Matriculas.codAluno=Alunos.codAluno INNER JOIN AulasDadas ON Matriculas.codTurma=AulasDadas.codTurma LEFT JOIN Frequencia ON Frequencia.codMatricula=Matriculas.codMatricula LEFT JOIN DecisoesConselho ON DecisoesConselho.codMatricula=Matriculas.codMatricula WHERE Matriculas.codTurma=$codTurma ORDER BY nomeAluno;";

$sql = "select Alunos.codAluno, Alunos.nomeAluno, Matriculas.status, Matriculas.codMatricula, Matriculas.nChamada from Matriculas INNER JOIN Alunos ON Matriculas.codAluno=Alunos.codAluno WHERE Matriculas.codTurma=$codTurma ORDER BY nChamada;";
$rs = mysql_query($sql);
//echo $sql;

$nomeArquivo = "arquivos/conselho_".$etapa."_".$turma.".xls";

$excel=new ExcelWriter($nomeArquivo);

    if($excel==false){
        //echo $excel->error;
   }


//montar cabeçalho da planilha
$registro[] = "N.";
$registro[] = "Nome";
$rsDisciplinas = mysql_query ($sqlDisciplinas);
while ($row = mysql_fetch_array($rsDisciplinas)){
  $registro[] = $row["sigla"];
}
$excel->writeLine($registro);


while($row = mysql_fetch_array($rs)){
  unset($registro); 
  $rsDisciplinas = mysql_query ($sqlDisciplinas);
  
  $codAluno = $row["codAluno"];
  $status = $row["status"];

  $registro[] = $row["nChamada"];
  $registro[] = $row["nomeAluno"]; 

  while ($row = mysql_fetch_array($rsDisciplinas)){
    $codDisciplina = $row["codDisciplina"];
    if ($status != "MA"){

    }else{
      if ($etapa == "I") $sqlMencao = "SELECT mencaoIntermediaria as mencao FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa";
      if ($etapa == "F") $sqlMencao = "SELECT mencaoFinal as mencao FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa";
      $rsMencao = mysql_query($sqlMencao); //TODO só funciona para menção final
      if (mysql_num_rows($rsMencao)>0) $mencao = mysql_result($rsMencao, 0, "mencao"); else $mencao="";
      //echo $sqlMencao."<br>";
      $registro[] = $mencao; 
    }
  }

//print_r($registro);
$excel->writeLine($registro);

}

$excel->close();

// Configuramos os headers que serão enviados para o browser
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$nomeArquivo.'"');
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($nomeArquivo));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');

// Envia o arquivo para o cliente
readfile($nomeArquivo);
?>

