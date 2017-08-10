<?php  
include "../../../conexao/conn.php";
$rs = mysql_query("SELECT MIN(CLASS) AS menor, MAX(CLASS) AS maior FROM AlunosImport");
$min = mysql_result($rs,0, "menor");
$max = mysql_result($rs,0, "maior");

?>

<html>
	<head>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ETEC Capela do Socorro - Sistema Morpheus</title>
		<script type="text/javascript" src="../../../jquery/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="../../../jquery/jquery.easyui.min.js"></script>
		<link type="text/css" href="../../../jquery/css/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<link rel="stylesheet" type="text/css" href="../../../jquery/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="../../../jquery/themes/icon.css">
		<style type="text/css">
			#fm{
				margin:0;
				padding:10px 30px;
			}
			.ftitle{
				font-size:14px;
				font-weight:bold;
				color:#666;
				padding:5px 0;
				margin-bottom:10px;
				border-bottom:1px solid #ccc;
			}
			.fitem{
				margin-bottom:5px;
			}
			.fitem label{
				display:inline-block;
				width:80px;
			}
		
			body{ font: 70% "Trebuchet MS", sans-serif; margin: 50px; margin-top: 0px}
			div#users-contain { width: 600px; margin: 20px 0; }
			div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
			div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: 0em 10px; text-align: left; }
		</style>	
		<script>
			$(function() {
				$( "input:submit, a, button, file", ".config", "#fileselect" ).button();
			$( "#slider-range" ).slider({
				range: true,
				min: <?php echo $min?>,
				max: <?php echo $max?>,
				values: [ <?php echo $min?>, <?php echo $max?> ],
				slide: function( event, ui ) {
					$( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
					$( "#minimo" ).val( ui.values[ 0 ] );
					$( "#maximo" ).val( ui.values[ 1 ] );
				}
			});
			$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
				" - " + $( "#slider-range" ).slider( "values", 1 ) );
			});

		</script>
	</head>

<br>
<form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">
<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="9000000" />
<div class="config">
	<label for="fileselect">Upload de arquivo CSV de alunos </label>
	<input type="file" id="fileselect" name="fileselect[]" multiple="multiple"  />
	<button type="submit">Enviar arquivo</button>
</div>
</form>

<form action="confirmar_importacao.php" method="post">
<div class="config" >
<label for="amount">Faixa de classificação:</label>
<input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
<input type="hidden" id="minimo" value="<?php echo $min?>" name="minimo" style="border:0; color:#f6931f; font-weight:bold;" />
<input type="hidden" id="maximo" value="<?php echo $max?>" name="maximo" style="border:0; color:#f6931f; font-weight:bold;" />
<div class="config" id="slider-range" style="width: 300px"></div>
<label for="turmas">Escolha a turma:</label>
<?php  include "get_cmb_turmas.php"?><br>
<button type="submit">Confirmar Importação</button>
</div>
</form>
<br>



	<div id="pp" style="background:#efefef;border:1px solid #ccc;">

	<table id="dg" title="Alunos que serão importados" class="easyui-datagrid" style="width:1100px;height:500px"
			url="get_alunosimport.php"
			rownumbers="false" fitColumns="true" singleSelect="true" pagination="true" loadMsg="Carregando...">
		<thead>
		
			<tr>
				<th field="CLASS" width="32" align="center">CLASS</th>
				<th field="NR_INSCRICAO" width="70">INSCRICAO</th>
				<th field="COD_CURSO" width="30">CURSO</th>
				<th field="HABILITACAO" width="50">HABILIT.</th>
				<th field="NOME" width="180">NOME</th>
				<th field="RG" width="45">RG</th>
				<th field="DT_NASCIMENTO" width="43">NASC</th>
				<th field="ENDERECO" width="160">ENDERECO</th>
				<th field="NUMERO" width="20">N.</th>
				<th field="TELEFONE" width="50">TELEFONE</th>
				<th field="PERIODO" width="40">PERIODO</th>
			</tr>
		</thead>
	</table>
	</div>
<br>


	


