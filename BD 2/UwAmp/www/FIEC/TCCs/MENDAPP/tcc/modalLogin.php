
	<div id="boxes">
		<div id="dialog1" class="window">
			<div id="form">
				<center>
					<div class="logo-login">
						<img src="./img/logoSmall.png">
					</div>
					
					<span><b>Login</b></span><br />
					<small>Não é Cadastrado? Cadastre-se <a href="#dialog2"  name="modal">aqui!</a></small>
					<form action="loginCadastro.php" class="form-1" method="post">
						<label for="email" class="clearfix">Email</label>
						<input type="email" placeholder="email" name="txtemail" id="txtemail"/>
						<label for="txtsenha" class="clearfix">Senha</label>
						<input type="password" name="txtsenha" placeholder="senha" id="txtsenha" class="big" /><br>
						<a href="esqueci-senha.php" class="button" id="buttonsenha"><i class="icon icon-question-sign"></i>Esqueci minha senha</a><br>
						<button class="dark login" name="btnlogar" id="btnlogar" type="submit"><i class="icon-white icon-user"></i><strong>&nbsp;LOGIN</strong></button>
					</form>
				</center>
			</div>
		</div>
	</div>
		<div id="boxes">
		<div id="dialog3" class="window">
			<div id="form">
				<center>
					<div class="logo-login">
						<img src="./img/logoSmall.png">
					</div>
					
					<span><b>Login</b></span><br />
					<small>Não é Cadastrado? Cadastre-se <a href="#dialog2"  name="modal">aqui!</a></small>
					<form action="loginQueixa.php" class="form-1" method="post">
						<label for="email" class="clearfix">Email</label>
						<input type="email" placeholder="email" name="txtemail" id="txtemail"/>
						<label for="txtsenha" class="clearfix">Senha</label>
						<input type="password" name="txtsenha" placeholder="senha" id="txtsenha" class="big" /><br>
						<a href="esqueci-senha.php" class="button" id="buttonsenha"><i class="icon icon-question-sign"></i>Esqueci minha senha</a><br>
						<button class="dark login" name="btnlogar" id="btnlogar" type="submit"><i class="icon-white icon-user"></i><strong>&nbsp;LOGIN</strong></button>
					</form>
				</center>
			</div>
		</div>
	</div>
	<div id="boxes">  
		<!-- Janela Modal com caixa de diálogo -->  
		<div id="dialog2" class="window">
			<div id="form">
				<center>
					<div class="logo-login">
						<img src="./img/logoSmall.png">
					</div>
					<br>
					<div class="cadastro">
						<span><b>Cadastrar</b></span><br />
						<small>Cadastre para continuar</small><br />
						<form action="formcadastrouser.php" class="form-2" method="post">

							<label for="txtsenha" class="clear">Nome&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Senha</label>
							<input type="text" placeholder="Nome" name="txtCADnome" id="txtCADnome"/>
							<input type="password" placeholder="senha" name="txtCADsenha" id="txtCADsenha"/>
							<label for="txtsenha" class="clear">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirmar Senha</label>
							<input type="email" placeholder="Email" name="txtCADemail" id="txtCADemail"/>
							<input type="password" placeholder="Confirmar Senha" name="txtConfirmaSenha" id="txtConfirmaSenha"/><br>
							<button class="dark login" name="btnCad" id="btnCad" type="submit"><i class="icon-white icon-user"></i><strong>&nbsp;Cadastar</strong></button>
						</form>
					</div>
				</center>
			</div>
		</div>
		<!-- Máscara para cobrir a tela -->
		<div id="mask"></div>
