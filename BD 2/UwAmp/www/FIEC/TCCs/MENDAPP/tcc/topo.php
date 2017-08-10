<?php							
				if(isset($_GET["msg"])){
					if($_GET["msg"]=="sucesso"){
						echo "<span class='mensagemSucesso'> Cadastro Realizado</span>";
					}
					else if($_GET["msg"]=="error"){
						echo "<span class='mensagemCadUser'> Erro ao Cadastrar</span>";
					}
					else if($_GET["msg"]=="senhaInvalida"){
						echo "<span class='mensagemCadUser'> Senhas não conferem </span>";
					}
					else if($_GET["msg"]=="userExists"){
						echo "<span class='mensagemCadUser'> Usuário Já cadastrado </span>";
					}
					else if($_GET["msg"]=="emailExists"){
						echo "<span class='mensagemCadUser'> Email Já cadastrado  </span>";
					}
					else if($_GET["msg"]=="erro"){
						echo "<span class='mensagemCadUser'>Erro ao logar usuário</span>";
					}
				}

include_once "conectar.php";

$con = new Conectar();


if(!isset($_SESSION['sessao'])){  

}else{
	
	$contador =$con->prepare("SELECT COUNT(*) AS count FROM respostas INNER JOIN queixas ON respostas.id_queixa = queixas.id_queixas WHERE respostas.status = 1 and queixas.id_usuario = :usuario");
	$contador -> bindValue(":usuario", $_SESSION['id']);
	$contador -> execute();
	$num_linhas = $contador  -> rowCount();
}

?>

<div id="header">
	<div id="logo">
		<center>	<a href="./"><img src="./img/logo.png" alt="Mend APP" /></a> <?php 
		if(!isset($_SESSION['sessao'])){  

		}else{
			if(($num_linhas)> 0){
				$row=$contador->fetch(Conectar::FETCH_ASSOC);
				echo'<a href="listarespostas.php"><div class="number">'.'Nova(s) Notificações '.$row['count'].'</div></a>';
			}
		}
		?>
	</center>
</div>


</div>
<div class='logout'>
	<?php
	if(!isset($_SESSION['sessao'])){  

	}else{
		echo "<center><p>&nbsp;&nbsp;Seja bem Vindo 
		<span class='nomeuser'>"." <br>".utf8_encode($_SESSION['nome'])."&nbsp;&nbsp;<br></span>
		<a href='logout.php'>Sair"." "."
		<img src='./img/off.png'>
		</a>
		</p></center>";
	}
	?> 
</div>
<br class="clear"/>


<div id="LISTAMENU">
	<nav  class="nav">					
		<ul>
			<li>
				<a href="./">
					<span class="icon">
						<i aria-hidden="true" class="icon-home">
							<img src="./img/home.png">
						</i>
					</span>
					<span class="textMenu">
						Home
					</span>
				</a>
			</li>


			<?php
			if(!isset($_SESSION['sessao'])){  
				echo'<li><a href="#dialog1"  name="modal"><span class="icon"> 
				<i aria-hidden="true" class="icon-services"><img src="./img/queixas.png"></i></span>
				<span class="textMenu">Cadastrar Queixas</span></a></li>';
			}else{
				echo'<li><a href="cadastrar-queixa.php"><span class="icon"> 
				<i aria-hidden="true" class="icon-services"><img src="./img/queixas.png"></i>
				</span><span class="textMenu">Cadastrar Queixas</span></a></li>';
			}
			?> 	
			<?php
			if(!isset($_SESSION['sessao'])){  						
				echo'<li>
				<a href="#dialog3"  name="modal">
				<span class="icon">
				<i aria-hidden="true" class="icon-portfolio">
				<img src="./img/listaqueixas.png">
				</i></span><span class="textMenu">Lista de Queixas</span></a></li>';
			}
			else{
				echo'<li>
				<a href="queixas.php">
				<span class="icon">
				<i aria-hidden="true" class="icon-portfolio">
				<img src="./img/listaqueixas.png">
				</i>
				</span>
				<span class="textMenu">	Lista de Queixas</span></a></li>';

			}
			?> 
			<li>
				<a href="mapa.php">
					<span class="icon">
						<i aria-hidden="true" class="icon-blog">
							<img src="./img/mapa.png">
						</i>
					</span>
					<span class="textMenu">
						Mapa
					</span>
				</a>
			</li>

			<li>
				<a href="sobre.php">
					<span class="icon">
						<i aria-hidden="true" class="icon-team">
							<img src="./img/sobre.png">
						</i>
					</span>
					<span class="textMenu">
						Sobre Nós
					</span>
				</a>
			</li>
			<li>
				<a href="contato.php">
					<span class="icon">
						<i aria-hidden="true" class="icon-contact">
							<img src="./img/contato.png">
						</i>
					</span>
					<span class="textMenu">
						Contato
					</span>
				</a>
			</li>
		</ul>
	</nav>
</div>