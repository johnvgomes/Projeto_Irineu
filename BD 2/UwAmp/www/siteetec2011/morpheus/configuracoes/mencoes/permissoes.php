<html>
	<head>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ETEC Capela do Socorro - Sistema Morpheus</title>
		<link type="text/css" href="../../jquery/css/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../../jquery/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
	
		<style type="text/css">
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 00px; margin-top: 0px}
			div#users-contain { width: 600px; margin: 20px 0; }
			div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
			div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: 0em 10px; text-align: left; }
		</style>	
	</head>
	
	<style>
	.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
	</style>

	<script>
	function habilitar(mencao){
		$.post('habilitar_mencao.php',{	campo:mencao },
		function(result){
			if (!result.success){
				alert(result.msg);
			}
		},'json');
	}
	
	$(function() {
		$("#btn_relatorio").button();
		$("#radio").buttonset();
		$("#radioEM").buttonset();
		$("#opt_intermediaria").click(function(){
			habilitar("habilitaIntermediaria");
		});
		$("#opt_final").click(function(){
			habilitar("habilitaFinal");
		});
		$("#opt_nenhum").click(function(){
			habilitar("habilitaNenhum");
		});

		$("#opt_intermediariaEM").click(function(){
			habilitar("habilitaIntermediariaEM");
		});
		$("#opt_finalEM").click(function(){
			habilitar("habilitaFinalEM");
		});
		$("#opt_nenhumEM").click(function(){
			habilitar("habilitaNenhumEM");
		});
	});
	</script>

<form action="">
   		<div id="radio">
   			<h3>Cursos Técnicos: Habilitar digitação de:</h3>
   			<input type="radio" name="radio" id="opt_intermediaria" /><label for="opt_intermediaria">M. Intermediária</label>
        	<input type="radio" name="radio" id="opt_final" /><label for="opt_final">M. Final</label>
        	<input type="radio" name="radio" id="opt_nenhum" /><label for="opt_nenhum">Nenhuma</label>
        </div>
</form>

<form action="">
   		<div id="radioEM">
   			<h3>Ensino Médio: Habilitar digitação de:</h3>
   			<input type="radio" name="radioEM" id="opt_intermediariaEM" /><label for="opt_intermediariaEM">M. Intermediária</label>
        	<input type="radio" name="radioEM" id="opt_finalEM" /><label for="opt_finalEM">M. Final</label>
        	<input type="radio" name="radioEM" id="opt_nenhumEM" /><label for="opt_nenhumEM">Nenhuma</label>
        </div>
</form>

<a id="btn_relatorio" href="http://etecia.com.br/morpheus/configuracoes/mencoes/relatorio_entregas.php" target="_blank">Relatório de Entrega</a>
