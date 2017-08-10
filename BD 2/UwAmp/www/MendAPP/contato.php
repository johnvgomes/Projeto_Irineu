<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "meta.php" ?>
	<script type="text/javascript">
    $(document).ready(function(){
        $("#form").submit(function(e){
            e.preventDefault();
            $.post("email.php", {
                nome:$("#name").val(),
                email:$("#email").val(),
                msg:$("#message").val()
            },function(data){
                alert(data);
                location.href="index.html";
            })
        })
    })
    </script>
</head>
<body>	
	<?php include "topo.php"; ?>
	<div id="centro">
		<div id="conteudo">
			<div class="centralizador">
				<div id="form">
					<div id="box">
						<form id="formulario" action="email.php" method="post">
							<label for="nome">Nome</label>
							<input class="frm" required type="text" id="name" placeholder="Nome" name="nome" class="formulario" />
							<label for="email">E-Mail</label>
							<input  class="frm"required type="text" id="name" placeholder="Nome" name="nome" class="formulario">
							<label for="">Mensagem</label>
							<textarea  class="areatext" required id="message" placeholder="Mensagem" name="msg"  class="formulario"></textarea>
							<button class="button" name="btnenviar" type="submit">Enviar</button>
							<a href="logout.php">kkkkk</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br class="clear"/>
	</div>
	<?php include "rodape.php"; ?>
</body>
</html>