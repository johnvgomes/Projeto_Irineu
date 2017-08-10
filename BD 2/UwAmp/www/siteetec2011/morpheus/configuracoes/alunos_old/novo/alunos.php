<html>
  <head>
    <meta charset="utf8">
    <title>Cadastro de Alunos</title>
    <script type="text/css" ></script>
    <link href="../../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../../includes/bootstrap/jquery.js"></script>
    <style type="text/css">
      body{
        margin: 50px;
      }
    </style>
  </head>
  <body>

    <form class="form-horizontal">
      <img src="sem_foto.gif" class="img-polaroid"><br>
      <a class="btn btn-small" href="#"><i class="icon-user"></i> alterar foto </a>

      <div class="control-group">
        <label  class="control-label" for="inputNome">Nome</label>
        <div class="controls">
          <input class="input-xxlarge" type="text" id="inputNome" name="nome_aluno" placeholder="Nome completo do aluno">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputRG">RG</label>
        <div class="controls">
          <input class="input-medium" type="text" id="inputRG" name="rg" placeholder="RG">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputEndereco">Endereço</label>
        <div class="controls">
          <input class="input-xlarge" type="text" id="inputEndereco" name="endereco" placeholder="Rua...">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputNumero">Número</label>
        <div class="controls">
          <input class="input-mini" type="text" id="inputEndereco" name="nome" >
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputTelefone">Telefone</label>
        <div class="controls">
          (  <input class="input-mini" type="text" id="inputTelefone" name="ddd" value=11> )
          <input class="input-medium" type="text" name="telefone">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputEmail">E-Mail</label>
        <div class="controls">
          <input class="input-large" type="email" required>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputCidade">Cidade de Nascimento</label>
        <div class="controls">
          <input class="input-large" type="text" name="cidade" id="inputCidade" value="São Paulo">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputRM">RM</label>
        <div class="controls">
          <input class="input-small" type="text" name="rm" id="inputRM">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputLogin">Login</label>
        <div class="controls">
          <input class="input-medium" type="text" name="login" id="inputLogin">
          <a class="btn btn-small btn-danger" href="#"><i class="icon-lock icon-white"></i> alterar senha </a>
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn btn-primary">Gravar</button>
        </div>
      </div>
    </form>

  </body>
</html>

