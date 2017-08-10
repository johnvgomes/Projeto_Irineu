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

if(isset($_POST["acao"]) || isset($_GET["acao"])){
  if ( $_POST["acao"]=="alterarSenha") {
    $estouAlterandoSenha=true;
    $codAluno = $_POST["codAluno"];
    $senha = $_POST["senha"];
    $sql = "UPDATE Alunos SET senha=md5('$senha') WHERE codAluno=$codAluno";
  }
  if ( $_GET["acao"]=="removerFoto") {
    $estouRemovendoFoto=true;
    $codAluno = $_GET["codAluno"];
    $rm = $_GET["rm"];
    /* apaga todas as fotos anteriores desse aluno */
    if(file_exists("fotos/".$rm.".png")) unlink( "fotos/".$rm.".png");
    if(file_exists("fotos/".$rm.".gif")) unlink( "fotos/".$rm.".gif");
    if(file_exists("fotos/".$rm.".jpg")) unlink( "fotos/".$rm.".jpg");
    if(file_exists("fotos/".$rm.".jpeg")) unlink( "fotos/".$rm.".jpeg");
    if(file_exists("fotos/".$rm.".bmp")) unlink( "fotos/".$rm.".bmp");

    $sql = "UPDATE Alunos SET foto='' WHERE codAluno=$codAluno";
  }

}else{


  $codAluno = $_POST["codAluno"];
  $nome = $_POST["nomeAluno"];
  $rg = $_POST["rg"];
  $nascimento = $_POST["nascimento"];
  $endereco = $_POST["endereco"];
  $numero = $_POST["numero"];
  $ddd = $_POST["ddd"];
  $telefone = $_POST["telefone"];
  $email = $_POST["email"];
  $cidade = $_POST["cidadeNascimento"];
  $rm = $_POST["rm"];
  $login = $_POST["login"];

  //converter nascimento para o formato americano (YYYY-MM-DD)
  $nascimento = implode("-",array_reverse(explode("/",$nascimento)));

  $sql = "REPLACE Alunos(
            codAluno,
            nomeAluno,
            rg,
            nascimento,
            endereco,
            numero,
            ddd,
            telefone,
            email,
            cidadeNascimento,
            RM,
            login,
            foto
          )
          VALUES(
            $codAluno,
            '$nome',
            '$rg',
            '$nascimento',
            '$endereco',
            '$numero',
            '$ddd',
            '$telefone',
            '$email',
            '$cidade',
            '$rm',
            '$login',
            '$rm'
            )";
}

$rs = mysql_query($sql);

//se for operacao de cadastro , pegar a código do aluno que foi inserido
if ($codAluno==0) $codAluno=mysql_insert_id();

if( mysql_errno() != 0){ ?>
  <div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Erro!</strong> Erro ao gravar dados no banco de dados. [<?php echo mysql_error().$sql;?>]
  </div>
<?php 
}else{
  $msg="Dados gravados com sucesso";
  if($estouAlterandoSenha) $msg="Senha alterada com sucesso.";
  if($estouRemovendoFoto) $msg="Foto removida.";

  header("Location: cadastro_aluno.php?codAluno=$codAluno&msg=$msg");
}


?>
