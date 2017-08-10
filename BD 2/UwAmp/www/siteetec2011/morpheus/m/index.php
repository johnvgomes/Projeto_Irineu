<!DOCTYPE html> 
<html> 
<?php include "cabecalho.php"; ?>

<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Sistema Morpheus</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<img src="http://etecia.com.br/morpheus/logo_morpheus_tmb.png" alt="logo Morpheus" />
		
		<form action="disciplinas.php" method="post">
			<div data-role="fieldcontain" class="ui-hide-label i-field-contain ui-body ui-br">
				<label for="login">Nome de usuário:</label>
				<input type="text" name="login" id="login" value="" placeholder="Nome de Usuário"/>
			</div>
			<div data-role="fieldcontain" class="ui-hide-label i-field-contain ui-body ui-br">
				<label for="senha">Senha:</label>
				<input type="password" name="senha" id="senha" value="" placeholder="Senha"/>
			</div>
			<input type="submit" value="Entrar" data-theme="a" />
		</form>
	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>