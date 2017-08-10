
<?php @session_start(); ?>
<!-- DIV Menu começa aqui -->
<div class="menu">
	<div class="menuHeader">
		<div class="nav">
			<a href="index.php">Home</a>
			
			<?php

			if(@$_SESSION['tipoSessao']=="PROFISSIONAL" ){
				if(@$_SESSION['isProfissional']=="verdade" ){
					echo '<a href="  FormEditar.php">Editar</a>';
				}else{

			echo '<a href="Cadastro.php">Cadastro</a>';
		}
	}
			?>
			<a href="aboutUs.php">Sobre Nós</a>
		</div>
	</div>
	<div id="quadrologin">
		<?php include "class/login.php"; ?>
		
		<form name="frmlogin" id="frmlogin" method="post" id="frmlogin">

			
			<?php

			if(!isset($_SESSION['sessao'])){
				echo '<label>Usuário:</label>
				<input class="designlogin" name="txtemail" type="text" id="txtemail" maxlength="100"required size="10"/>
				<br>
				<label>Senha:</label>
				<input class="designlogin" name="txtsenha" type="password" id="txtsenha" maxlength="10" required size="10"/><br>';
                                

				echo '<input type="submit" name="btnlogar" value="Login"	id="btnlogar"/>';
                                echo '<a name="btnCadastrese" id="btnCadastrese" href="FormUsuario.php">cadastre-se</a>';
			} else{
				

				echo '<a class="bemvindo">Bem vindo'." " .$_SESSION["NomeUsuario"]."<br>".$_SESSION['tipoSessao'].'</a><br>';
				echo'<a  class ="logout" href="./class/logout.php">Sair</a>';

			}
			?>
			
		</form>
	</div>
</div>	
