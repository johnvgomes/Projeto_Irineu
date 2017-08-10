<?php

include "../../conexao/conn.php";
require( "funcao_mostrar_foto.php");

if (isset($_GET["codAluno"])){
  $codAluno=$_GET["codAluno"];
  $sqlAluno = "SELECT *, 
                date_format(nascimento, '%d/%m/%Y') as nascimentoFormatado,
                (YEAR(now()) - YEAR(nascimento) - if( DATE_FORMAT(now(), '%m%d') > DATE_FORMAT(nascimento, '%m%d') ,0 , 1)) as idade
                FROM Alunos WHERE codAluno=$codAluno";
  $rsAluno = mysql_query($sqlAluno);
  $aluno = mysql_fetch_array($rsAluno);

  //Mostrar as turmas onde o aluno já passou
  $sqlMatriculas = "SELECT Turmas.modulo, Series.serie, Etapas.etapa FROM Matriculas
                    INNER JOIN Turmas ON Matriculas.codTurma=Turmas.codTurma
                    INNER JOIN Series ON Series.codSerie=Turmas.codSerie
                    INNER JOIN Etapas ON Etapas.codEtapa=Turmas.codEtapa
                    WHERE codAluno=$codAluno";
  $rsMatriculas = mysql_query($sqlMatriculas);

  $nome = $aluno["nomeAluno"];
  $rg = $aluno["rg"];
  $nascimento = $aluno["nascimentoFormatado"];
  $idade = $aluno["idade"]. " anos";
  $endereco = $aluno["endereco"];
  $numero = $aluno["numero"];
  $ddd = $aluno["ddd"];
  $telefone = $aluno["telefone"];
  $email = $aluno["email"];
  $cidade = $aluno["cidadeNascimento"];
  $rm = $aluno["RM"];
  $login = $aluno["login"];
}else{
  $codAluno=0;
}
?>
<html>
  <head>
    <meta http-equiv="pragma" content="no-cache" />
    <meta charset="utf8">
    <script type="text/css" ></script>
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../includes/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <script src="../../includes/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../includes/jquery/js/jquery-1.7.2.min.js"></script>
    <script src="../../includes/bootstrap/js/bootstrap-modal.js"></script>
    <script src="../../includes/bootstrap/js/bootstrap-transition.js"></script>
    <script src="../../includes/jquery/js/jquery.form.js" type="text/javascript"></script>
    <script src="../../includes/jquery/js/upload.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#btnEnviar').click(function(){
            $('#formUpload').ajaxForm({
                uploadProgress: function(event, position, total, percentComplete) {
                    $('progress').attr('value',percentComplete);
                    $('#porcentagem').html(percentComplete+'%');
                },        
                success: function(data) {
                    $('progress').attr('value','100');
                    $('#porcentagem').html('100%');                
                    if(data.sucesso == true){
                        $('#resposta').html('<img src="'+ data.msg +'" />');
                        $('#btnCancelar').html("Fechar");
                        //Recarrega a página para mostrar a nova foto
                        location.reload();
                    }
                    else{
                        location.reload();
                        $('#resposta').html(data.msg);
                    }                
                },
                error : function(){
                    $('#resposta').html('Erro ao enviar requisição!!!?'+data.msg);
                },
                dataType: 'json',
                url: 'enviar_arquivo.php',
                resetForm: true
            }).submit();

        })
    })
    </script>

    <style type="text/css">
      body{
        margin: 10 50 10 50;
      }
      #foto{
        float: right;
      }
      #campos{
        float: left;
      }
    </style>
  </head>
  <body>

    <?php if (isset($_GET["msg"])) { ?>
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $_GET["msg"]; ?>
    </div>
    <?php }  ?>

    <div id="foto">
      <?php if ($codAluno!=0) { //mostrar o campo foto apenas se não for o primeiro cadastro ?>
        <?php echo mostrarFoto($rm); ?><br>
        <a href="#uploadModal" role="button" class="btn btn-smal" data-toggle="modal"><i class="icon-user"></i> alterar foto</a>
        <a href="gravar_aluno.php?acao=removerFoto&rm=<?php echo $rm; ?>&codAluno=<?php echo $codAluno; ?>" class="btn btn-smal btn-danger"><i class="icon-trash icon-white"></i> remover foto</a>
        <div>
          <table class="table">
            <tr><th colspan=2>Matrículas</th></tr>
        <?php
          while($rowMatricula = mysql_fetch_array($rsMatriculas)){
            echo "<tr>";
            echo "<td>".$rowMatricula["etapa"]."</td>";
            echo "<td>".$rowMatricula["modulo"].$rowMatricula["serie"]."</td></th>";
          }
        ?>
      </table>
      </div>
      <?php } ?>
    </div>

    
    
    <div  id="campos">

    <form class="form-horizontal" action="gravar_aluno.php" method="POST">
      <input type="hidden" name="codAluno" value="<?php echo $codAluno; ?>">
      <div class="control-group">
        <label  class="control-label" for="inputNome">Nome</label>
        <div class="controls">
          <input class="input-xxlarge" type="text" id="inputNome" name="nomeAluno" placeholder="Nome completo do aluno" required value="<?php echo $nome ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputRG">RG</label>
        <div class="controls">
          <input class="input-medium" type="text" id="inputRG" name="rg" placeholder="rg"  value="<?php echo $rg ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputNascimento">Nascimento</label>
        <div class="controls">
          <input class="input-medium" type="text" id="inputNascimento" name="nascimento" placeholder="Data de Nascimento"  value="<?php echo $nascimento?>" />
          <span class="help-inline"> <?php echo $idade; ?> </span>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputEndereco">Endereço</label>
        <div class="controls">
          <input class="input-xlarge" type="text" id="inputEndereco" name="endereco" placeholder="Rua..."  value="<?php echo $endereco ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputNumero">Número</label>
        <div class="controls">
          <input class="input-mini" type="text" id="inputNumero" name="numero"  value="<?php echo $numero ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputTelefone">Telefone</label>
        <div class="controls">
          (  <input class="input-mini" type="text" id="inputTelefone" name="ddd" value="<?php echo $ddd ?>"> )
          <input class="input-medium" type="text" name="telefone" value="<?php echo $telefone ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputEmail">E-Mail</label>
        <div class="controls">
          <input class="input-xlarge" type="email" name="email" value="<?php echo $email ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputCidade">Cidade de Nascimento</label>
        <div class="controls">
          <input class="input-large" type="text" name="cidadeNascimento" id="inputCidade"  value="<?php echo $cidade ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputRM">RM</label>
        <div class="controls">
          <input class="input-small" type="text" name="rm" id="inputRM" value="<?php echo $rm ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputLogin">Login</label>
        <div class="controls">
          <input class="input-medium" type="text" name="login" id="inputLogin" value="<?php echo $login ?>">
          <?php if ($codAluno!=0) { //mostrar botao alterar senha apenas se o aluno já for cadastrado ?>
            <a href="#formSenhaModal" role="button" data-toggle="modal" class="btn btn-small btn-danger" ><i class="icon-lock icon-white"></i> alterar senha </a>
          <?php } ?>
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <a class="btn" href="alunos.php"><i class="icon-arrow-left"></i> Voltar </a>
          <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i>Gravar</button>
          <?php if ($codAluno!=0) { //mostrar botao apagar aluno apenas se o aluno já for cadastrado ?>
            <a href="#formApagarAluno" role="button" data-toggle="modal" class="btn btn-danger"><i class="icon-trash icon-white"></i> Apagar aluno </a>
          <?php } ?>
        </div>
      </div>
    </form>
</div>
    
<!-- Formulário de exclusão de aluno (modal) -->
<div id="formApagarAluno" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Apagar Aluno</h3>
  </div>
  <div class="modal-body">
     <p>
      Tem certeza que deseja apagar esse aluno? Essa ação não poderá ser desfeita. Todos os dados do aluno serão perdidos.
     </p>
  </div>
  <div class="modal-footer">
    <a class="btn btn-danger" href="apagar_aluno.php?codAluno=<?php echo $codAluno; ?>"><i class="icon-trash icon-white"></i> Confirmar Exclusão ! </a>
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelar">Cancelar</button>
  </div>
</div>


<!-- Formulário de alteração de senha (modal) -->
<div id="formSenhaModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Alteração de Senha de Aluno</h3>
  </div>
  <div class="modal-body">
     <form name="alterarSenha" id="formAlterarSenha" method="post" action="gravar_aluno.php">
        <input type=hidden name="acao" value="alterarSenha">
        <input type=hidden name="codAluno" value="<?php echo $codAluno; ?>">
        <label>Nova Senha: <input type="password" name="senha" class="input-medium" /></label>
        <button type="submit" class="btn btn-primary">Alterar</button>
     </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelar">Cancelar</button>
  </div>
</div>

<!-- Formulário de upload de foto (modal) -->
<div id="uploadModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Upload de Foto de Aluno</h3>
  </div>
  <div class="modal-body">
     <form name="formUpload" id="formUpload" method="post">
            <input type=hidden name="rm" value="<?php echo $rm; ?>">
            <label>Selecione o arquivo: <input type="file" name="arquivo" id="arquivo" size="45" /></label>
            <br />
            <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
            <br />
            <input type="button" id="btnEnviar" value="Enviar Arquivo" />
        </form>
        <div id="resposta"></div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelar">Cancelar</button>
  </div>
</div>

  </body>
</html>

