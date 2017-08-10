<!DOCTYPE html>
<html>
 
<?php include_once "head.php" ?>
    
<body>
	<!-- Aqui é DIV tudo -->
	<div class="tudo">
		
		<!-- DIV header, onde contém a imagem logo e o texto "FYCS" -->
		<?php include_once "header.php" ?>
                <!-- Menu -->
		
                <!-- DIV Conteúdo começa aqui -->
                <?php

if(!isset($_SESSION['sessao'])){
     echo 
          "<div class='precisalogin'>FAÇA LOGIN OU CADASTRE-SE PARA UTILIZAR ESTA FUNCIONALIDADE</div>";
    header("Location: FormUsuario.php");
}else{

?>
		<div class="conteudo">
                <?php include_once "testeAvaliacao.php" ?> 
               
                   
		</div>
                
<?php
}
?>
		<!-- DIV Rodapé aqui -->
		 <?php include_once "rodape.php" ?>
	</div>

</body>
</html>