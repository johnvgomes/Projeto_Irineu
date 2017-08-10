<?php
?>

	<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="../../jquery/jquery.easyui.min.js"></script>
	
	<script type="text/javascript">

	$(document).ready(function() {	

		$('#cc').combogrid({  
		    panelWidth:450,  
		    value:'1',  
		   
		    idField:'codCidade',  
		    textField:'cidade',  
		    url:'../get_cidades.php',  
		    columns:[[  
		        {field:'codCidade',title:'Cód',width:60},  
		        {field:'cidade',title:'Cidade',width:100},  
		        {field:'estado',title:'Estado',width:120},  
		        {field:'pais',title:'Pais',width:100}  
		    ]]  
		});  

	});  
	</script>
	
<select id="cc" name="turma"></select>  
