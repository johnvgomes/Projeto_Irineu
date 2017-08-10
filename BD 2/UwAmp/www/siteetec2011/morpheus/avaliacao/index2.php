<?php

include "../conexao/conn.php";


$codAluno = $_SESSION['id'];

//pegar a ultima matricula do aluno no sistema
  $sqlMatriculas = "SELECT * FROM Matriculas WHERE codAluno=$codAluno ORDER BY codMatricula DESC LIMIT 1";
  $rsMatriculas = mysql_query($sqlMatriculas);
  $codMatricula = mysql_result($rsMatriculas, 0, "codMatricula");
  

$sql = "SELECT * FROM LogAvaliacao WHERE codMatricula=$codMatricula";

$rs = mysql_query($sql);

if (mysql_num_rows($rs)<=0) {

?>


<h2>Avaliação de Curso</h2>
<p>Você está começando o processo de avaliação do seu curso. Esse é um momento muito importante. As respostas fornecidas serão utilizadas para melhoria do curso.</p>
<p>Durante a avaliação você irá atribuir menções (I, R, B ou MB) para alguns critérios referentes as disciplinas e aos professores. Você também pode escrever observações livramente sobre cada critério.</p>
<p>Depois de responder todas as questões o botão <strong>Gravar</strong> será habilitado, clique nele para finalizar a avaliação.</p>

  <a href="avaliacao/index.php" target="_blank" class="btn btn-large">Iniciar Avaliação</a>

<?php
}else {
?>

<h2>Avaliação de Curso</h2>
<p>Você já respondeu a avaliação do seu curso nesse semestre. Obrigado pela sua participação.</p>

<?php
}
?>