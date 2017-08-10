<?php
session_start();
if(!isset($_SESSION['sessao'])){
	 header("Location: logar.php");
}else{

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "meta.php" ?>
	<script>
	$(document).ready(function() {
		$(".upload").uploadify({
			height        : 40,
			swf           : './img/uploadify.swf',
			uploader      : './uploadify.php',
			width         : 320,
			onUploadSuccess : function(arg1, filename, arg3) {
				$("#form-queixa").prepend('<input type="hidden" name="images[]" value="'+filename+'" />');

			},
			buttonText: "Selecione as fotos"
		});
	})
    $(document).ready(function(){
        $(input.cep).mask
    })
    
	</script>
	<script src="js/maps.js"> </script>
	<script src="http://maps.google.com/maps/api/js?sensor=false&#038;ver=1.0" type="text/javascript" ></script>
	<script src="js/markerhome.js"> </script>
</head>
<body>	
	<?php include "topo.php" ?>
	<div id="centro">		
		<div id="conteudo">
			<div  class="centralizador">
				<div id="form">
					<div id="box">
						<form action="formindex.php" method="post" id="form-queixa"><?php
						if(isset($_GET["msg"])){
							if($_GET["msg"]=="sucesso"){
								echo "<span class=\"mensagem\"> Salvo Com Sucesso</span>";
							}
							else if($_GET["msg"]=="error"){
								echo "<span class=\"mensagem\"> Erro ao Salvar</span>";
							}
						}
						?>
						<label for="endereco">Endereço</label>
						<input  class="frm" placeholder="Digite o CEP" type="text" max="9"name="cep" id="cep"/>
						<select class="frm" name="uf" id="uf">
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AM">Amazonas</option>
							<option value="AP">Amapá</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espirito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MG">Minas Gerais</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MT">Mato Grosso</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="PR">Paraná</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="SC">Santa Catarina</option>
							<option value="SE">Sergipe</option>
							<option value="SP">São Paulo</option>
							<option value="TO">Tocantins</option>
						</select><br>
						<input  class="frm" placeholder="Digite o nome da rua" type="text" name="rua" id="rua"/>
						<input  class="frm" placeholder="Nº" type="text" name="num" id="num"/><br>
						<input  class="frm" placeholder="Bairro" type="text" name="bairro" id="bairro"/>
						<input  class="frm" placeholder="Cidade" type="text" name="cidade" id="cidade"/><br>
						<label for="categoria">Categoria</label>
						<select class="frm" name="categoria" id="categoria">
							<option value="saae">SAAE (Água)</option>
							<option value="cpfl">CPFL (Energia)</option>
							<optgroup label="Prefeitura">
								<option value="edu">Educação</option>
								<option value="sau">Saúde</option>
								<option value="transp">Transporte</option>
								<option value="transp">Vigilância Sanitária</option>
								<option value="transp">Transito</option>
								<option value="transp">SMSU</option>
								<option value="transp">Meio Ambiente</option>
							</optgroup>
							<option value="segp">Segurança pública</option>
							<option value="bombeiro">Bombeiros</option>
						</select>
						<input id="upload" name="upload"  placeholder="upload" class="upload" type="file"/>	
						<input id="longitude" name="longitude" type="hidden"/>	
						<input id="latitude" name="latitude" type="hidden"/>	
						<textarea placeholder="Mensagem" id="mensagem" name="mensagem"  class="frm"></textarea>
						<button class="button" id="btncadqueixa"type="submit">Enviar</button>
					</form>
				</div>
			</div>
			<div id="mapa">
					<div id="map-field"></div>
					<div id="msg-lat-lng"></div>
					<input type="hidden" name="latitude" id="latitude" value="" />
					<input type="hidden" name="longitude" id="longitude" value="" />
			</div>
		</div>
		<br class="clear"/>
	</div>
	<?php include "rodape.php" ?>
</body>
</html>

<?php
}
?>