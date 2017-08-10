<?php

session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "meta.php" ?>
	<link rel="stylesheet" href="./css/login.css">
</script>
</head>
<body><?php include "loaderscreen.php"; ?>
	<?php include "slider.php"; ?>
	<?php include "topo.php";?>
	<div id="conteudo">

		<div class="metade">
			
		</div>
		<div class="metade">
			<div class="btn"><?php
				if(!isset($_SESSION['sessao'])){                                                             
					echo '<a href="#dialog2" name="modal"><button class="BTNindex" type="submit">&nbsp;Cadastro</button></a><br>';
					echo '<a href="#dialog1" name="modal"><button class="BTNindex"  type="submit">&nbsp;Login</button></a>';
				}else{
				}

				include "modalLogin.php";?></div>
		</div>
	</div>
</div>
<br class="clear"/>
<?php include "rodape.php" ?>
</body>
</html>