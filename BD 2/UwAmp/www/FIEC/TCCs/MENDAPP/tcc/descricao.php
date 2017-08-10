<?php
session_start();
$id_queixa = isset($_GET['queixa']) ? $_GET['queixa'] : 0;
if ($id_queixa == 0){
	header( 'location:index.php');
}
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
	<?php include "topo.php";
	include "slider.php"; ?>
	<div id="conteudo">
		<div  class="centralizador">
			
			<div id="form">
				
				<?php	

				$resultBD = $con->prepare("SELECT *, date_format(dateTime, '%d/%m/%Y - %H:%ih') AS fdatahora from queixas  where id_queixas='$id_queixa'");
				$resultBD->execute();
				if($resultBD->rowCount()>=1){
					while ($row=$resultBD->fetch(Conectar::FETCH_ASSOC)){
						echo '<div class="dadosQueixa">';
						echo '<p>ID Queixa:&nbsp;&nbsp;&nbsp;'.utf8_encode($row['id_queixas']).'</p>';   
						echo '<p>Categoria:&nbsp;&nbsp;&nbsp;'.utf8_encode($row['txt_categoria']).'</p>'; 
						echo '<p>Data:&nbsp;&nbsp;&nbsp;'.utf8_encode($row['fdatahora']).'</p>';  
						echo '<p><b>Endereço </b><br>'; 
						echo '<p>Rua:&nbsp;&nbsp;&nbsp;'.utf8_encode($row['txt_rua']).'</p>'; 
						echo '<p>Número:&nbsp;&nbsp;&nbsp;'.utf8_encode($row['txt_numero']).'</p>';  
						echo '<p>Bairro:&nbsp;&nbsp;&nbsp;'.utf8_encode($row['txt_bairro']).'</p>';  
						echo '<p>CEP:&nbsp;&nbsp;&nbsp;'.utf8_encode($row['txt_cep']).'</p>';  
						echo '<p>Cidade:&nbsp;&nbsp;&nbsp;'.utf8_encode($row['txt_cidade']).'-'.utf8_encode($row['txt_uf']).'</p>';  
						echo '</div>';

						echo '<div class="dadosQueixa">';
						echo '<p>Descrição: '.utf8_encode($row['txt_queixas']).'</p>'; 
						echo '</div>';

					}
				}
				else{
					echo '<span class="msgDes"> FODEU  </span>';
				}
				?>	<center><div id="owl-demo"><?php
				$resultFoto = $con->prepare("select * from fotos where id_queixas='$id_queixa'");
				$resultFoto->execute();
				if($resultFoto->rowCount()>=1){
					while ($foto=$resultFoto->fetch(Conectar::FETCH_ASSOC)){
						echo '<div class="item"><a class="fancybox-thumbs" data-fancybox-group="thumb" href="./uploads/'.$foto['name_foto'].'"><img src="./uploads/'.$foto['name_foto'].'"></a></div>';   
					}
				}
				?>
			</div></center>
		</div>
	</div>
	<br class="clear"/>
</div>		
<?php include "rodape.php" ?>
</body>
</html>
