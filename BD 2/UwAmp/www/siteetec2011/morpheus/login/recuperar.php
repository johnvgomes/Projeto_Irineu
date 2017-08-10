<?php include "../jquery.inc" ?>

<script>
	$(function() {
		$( "#recuperar" ).button({ icons: { primary: "ui-icon-locked"} });
		$( "#alterar" ).button({ icons: { primary: "ui-icon-locked"} });
		$("#confirmacao_senha").keyup(function(){
			var nova = $("#nova_senha").val();
			var confirmacao = $("#confirmacao_senha").val();
			//alert(nova + " " + confirmacao);
			if ( nova != confirmacao){
				$("#valid_msg").show();
			}else{
				$("#valid_msg").hide();
			}
		});
		$("#nova").keyup(function(){
			var nova = $("#nova_senha").val();
			var confirmacao = $("#confirmacao_senha").val();
			//alert(nova + " " + confirmacao);
			if ( nova != confirmacao){
				$("#valid_msg").show();
			}else{
				$("#valid_msg").hide();
			}
		});
		$( "#recuperar" ).click(function(){ 
			$("#form-alterar-senha").hide();
			$("#erro_msg").hide();
			$("#alert_msg").hide();
			$.post('login/enviar_cod.php',{ email:$("#email").val() },
				function(result){
					if (result.sucess){
						$("#dialog-form").slideUp("slow");
						$("#alert").html(result.msg);
						$("#alert_msg").slideDown("slow");
						$("#form-alterar-senha").slideDown("slow");
						$("#cod").attr('value', result.cod);
					}else{
						$("#erro").html(result.msg);
						$("#erro_msg").slideDown("slow");
					}
					
				},'json');

			});
		$( "#alterar" ).click(function(){ 
			$("#erro_msg").hide();
			$.post('login/mudar_senha.php', $("#mudar_senha").serialize() ,
				function(result){
					if (result.sucess){
						$("#alert").html("");
						$("#alert").html("<br>Senha alterada com sucesso<br>");
						

					}else{
						$("#erro").html(result.msg);
						$("#erro_msg").slideDown("slow");
					}
					
				},'json');
		});
		$("#form-alterar-senha").hide();
		$("#erro_msg").hide();
		$("#alert_msg").hide();
		$("#valid_msg").hide();

	});
	</script>

	<style>
		body { font-size: 62.5%; }
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain { width: 350px; margin: 20px 0; }
		div#dialog-form { width: 350px; margin: 20px auto; }
		div#form-alterar-senha { width: 350px; margin: 20px auto; }
		div#erro_msg { width: 350px; margin: 20px auto; }
		div#alert_msg { width: 350px; margin: 20px auto; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; font-size: 2em; }
	</style>

	
		<div id="dialog-form" title="Alterar senha" width='200px'>
			<p class="validateTips">Informe o seu e-mail e clique em Recuperar senha.</p>

			<form>
			<fieldset>
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
				
			</fieldset>
			</form>
			<button id="recuperar">Recuperar Senha</button>
		</div>

		<div id="alert_msg" class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em; font-size: 1.3em"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
					<div id="alert"></div></p>
				</div>
		</div>

		<div id="form-alterar-senha" width='200px'>
			<p class="validateTips">Preencha os campos abaixo para alterar a sua senha.</p>

			<form id="mudar_senha">
			<fieldset>
				<input id="cod" type="hidden" name="cod" value="" />
				<label for="senha_atual">Senha atual (enviada por e-mail)</label>
				<input type="password" name="senha_atual" id="senha_atual" value="" class="text ui-widget-content ui-corner-all" />
				<label for="nova_senha">Nova senha</label>
				<input type="password" name="nova_senha" id="nova_senha" value="" class="text ui-widget-content ui-corner-all" />
				<label for="confirmacao_senha">Confirmação de senha</label>
				<input type="password" name="confirmacao_senha" id="confirmacao_senha" value="" class="text ui-widget-content ui-corner-all" />
				<div id="valid_msg" class="ui-state-error ui-corner-all" style="padding: 0 2em; width=350px; font-size: 1em"> 
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em"></span> 
				<div id="valid">Senha não confere!</div></p>
				</div>
			</fieldset>
			</form>
			<button id="alterar">Alterar Senha</button>
		</div>

		<div id="erro_msg" class="ui-state-error ui-corner-all" style="padding: 0 2em; width=350px; font-size: 1.5em"> 
			<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em"></span> 
			<strong>Erro:</strong> <div id="erro"></div></p>
		</div>



