<?php 
include '../../conexao/conn.php';

$codTurma = $_GET["turma"];

?>
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
	$(function() {
		$("#matriculados").load("matriculados.php?codTurma=<?php echo $codTurma?>");
		$( "#alunos" ).autocomplete({
			source: "get_alunos.php",
			select: function( event, ui ) {
			
			$.post('matricular.php',{
						codTurma:<?php echo $codTurma?>, 
						codAluno:ui.item.id
						},
			function(result){
				if (result.success){
					//$("#matriculados").load("matriculados.php?codTurma=<?php echo $codTurma?>");
					$('#table_matriculados').datagrid('reload');
				} else {
					$.messager.show({	// show error message
						title: 'Erro',
						msg: result.msg
					});
				}
			},'json');
		}
	
		});
	});
	</script>


<div class="ui-widget" style="font-size:14">
	<label for="alunos">Adicionar aluno: </label>
	<input id="alunos" size=40/>
</div>
<br><br>
<div id="matriculados"></div>