<?php
session_start();
$id_queixa = isset($_GET['queixa']) ? $_GET['queixa'] : 0;
if ($id_queixa == 0){
	header( 'location:index.php');
}
include_once 'conectar.php';
$con = new Conectar;

$id_pagina = $_GET["queixa"];
$query = $con->prepare("UPDATE respostas SET status=0 WHERE id_queixa =:pagina");
$query->bindValue(":pagina",$id_pagina);
$query -> execute();

?>                                                                                        
<!DOCTYPE html>                                                            
<html lang="pt-br">
<head>
	<?php include "meta.php" ?>
	<!-- Banner -->
	<script src="./js/owl.carousel.min.js"></script>
	<!-- Estilo Banner -->
	<link rel="stylesheet" href="./css/owl.carousel.css">
	<!-- Box -->
	<script src="./js/jquery.fancybox-thumbs.js"></script>
	<!-- Box -->
	<script src="./js/jquery.fancybox.js"></script>
	<!-- Estilo Banner -->
	<link rel="stylesheet" href="./css/jquery.fancybox-thumbs.css">
	<!-- Estilo Banner -->
	<link rel="stylesheet" href="./css/jquery.fancybox.css">
</script>	

</head>
<body>	
	<?php include "topo.php" ?>
	<?php include "slider.php"; ?>
	<div id="conteudo">
		<div  class="centralizador">
			
			<div id="formRespostas">
				
				<?php	
				$resultBD = $con->prepare("SELECT *, date_format(data, '%d/%m/%Y - %H:%ih') AS fdatahora from respostas  where id_queixa=:queixa");
				$resultBD->bindValue(":queixa",$id_queixa);
				$resultBD->execute();

				
				if($resultBD->rowCount() > 0){
					while ($row=$resultBD->fetch(Conectar::FETCH_ASSOC)){




						echo '<div class="respostas"><b><center><p><em>'.utf8_encode($row['fdatahora']).'  |</em>'.utf8_encode($row['resposta']).'</p></center></b></div>';  					}
					}
					else{
						echo '<span class="msgDes"> Sem resposta ainda  </span>';
					}
					?>
				</div>
			</div>
			<br class="clear"/>
		</div>		
		<?php include "rodape.php" ?>
	</body>
	</html>
