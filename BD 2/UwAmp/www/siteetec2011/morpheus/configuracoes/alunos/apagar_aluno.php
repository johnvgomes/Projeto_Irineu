<html>
  <head>
    <meta charset="utf8">
    <title>Cadastro de Alunos</title>
    <script type="text/css" ></script>
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../../includes/jquery/js/jquery-1.7.2.min.js"></script>
    <script src="../../includes/bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../../includes/bootstrap/js/bootstrap-popover.js"></script>
    
<?php

include "../../conexao/conn.php";

  $codAluno = $_GET["codAluno"];

  $sql = "DELETE FROM Alunos WHERE codAluno=$codAluno LIMIT 1";
  $rs = mysql_query($sql);

if( mysql_errno() != 0){ ?>
  <div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Erro!</strong> Erro ao gravar dados no banco de dados. [<?php echo mysql_error().$sql;?>]
  </div>
<?php 
}else{
  $msg="Aluno apagado com sucesso";

  header("Location: cadastro_aluno.php?msg=$msg");
}


?>
