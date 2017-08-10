<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "meta.php" ?>
	<script type="text/javascript">
	$(window).load(function () {
		
		setTimeout(function(){
			$(".metade:eq(1) #texto").fadeOut(500);
		},500)
		setTimeout(function(){
			$(".metade:eq(1)").css({overflow:"hidden",width:"40%"}).animate({width:0}, 1000);
			$(".metade:eq(0)").animate({width:"100%"}, 1000);
		},2000)
	})
	</script>
</head>
<body>	
	<div id="conteudo">
		<?php include "modalLogin.php";?>
		<?php include "topo.php" ?>
		<?php include "slider.php"; ?>
		<div  class="centralizador">
			
			<div id="form">
				<div id="box">
					<div class="metade">
						<div class="organizerSobre">
							<div  class="titulo"> O Mend App Solutions</div>
							<p>
								Somos a solução de sua cidade, somos aquilo que você precisa! Estamos a um clique de você, Somos o MendApp
								e o nosso foco é resolver problemas.
							</p>
							<p> 
								Se ver um  cano na calçada estourado, é so nos informar atraves de fotos e descrições e assim repassaremos o orgão responsável pela má situação, do local onde você está informando.
							</p>
							<p>
								E assim informaremos a você passo a passo do processo de restauração de seu problema. Para que o Senhor(a) 
								não precise passar horas nos telefones procurando saber quando seu problema será solucionado.
								<p>

								</div>
							</div>
						</div>
						<br class="clear"/>
					</div>
				</div>

			</div>
			<br class="clear"/>

			<?php include "rodape.php" ?>
		</body>
		</html>