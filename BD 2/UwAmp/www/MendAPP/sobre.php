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
	<?php include "topo.php" ?>
	<div id="centro">
		<div id="conteudo">
			<div class="metade">
				<div class="organizerSobre">
					<h2> O Mend App Solutions</h2>
					<p>O MendAPP Solutions é um software que visa beneficiar a sociedade de forma que sua usabilidade permite que seus usuários informem problemas de onde estejam, via celular ou site, sendo este processo realizado com base em fotos e informações fornecidas pelo mesmo.</p>
					<p>Sempre que houver algo de errado e algum de nossos usuários nos enviar uma queixa, a repassaremos aos devidos órgãos, sejam eles quais forem. Se por acaso um cano se romper em alguma rua, enviaremos um chamado e sua queixa ao órgão responsável pelos canos em sua região, se verem a necessidade de radar em alguma curva que ocorre muitos acidentes, nos envie e repassaremos a concessionária da rodovia, e assim por diante, problemas serão recebidos e repassados aos devidos órgãos.</p>
				</div>
			</div>
			<div class="metade">
				<div id="texto">
					<h1>O <small>MendAPP</small> é um  <small>software</small> que visa <small>beneficiar</small> a <small>sua cidade!</small></h1>
				</div>
			</div>
		</div>
		<br class="clear"/>
	</div>
	<?php include "rodape.php" ?>
</body>
</html>