<!DOCTYPE html>
<html>

<?php


 include_once "head.php" ;


?>
<body>
	<!-- Aqui é DIV tudo -->
	<div class="tudo">	
		<!-- DIV header, onde contém a imagem logo e o texto "FYCS" -->
		<div class="header">
			<?php include "header.php" ?>
		</div>		
		<!-- DIV Conteúdo começa aqui -->
		<div class="conteudo">
			<center>
			
				<div class="nome" id="nomeindex">
					<p id="txt_nome"> F&nbsp;Y&nbsp;C&nbsp;S</p>
					<p id="txt_slogan">Find Your Closest Solution</p>
				</div>
			</center>			
			<?php include "buscar.php" ?>
		</div>       
		<?php include "rodape.php" ?>
	</div>
</body>
</html>
