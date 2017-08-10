		
    <script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="../../jquery/jquery.easyui.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/icon.css">
	<link type="text/css" href="../../jquery/css/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	
	<style type="text/css">
	.accordion .accordion-header{
		background:#fafafa;
	}
	.accordion .accordion-header-selected{
		background:url('../images/nav.png') center bottom no-repeat;
		height:35px;
		border:0;
	}
	.pitem{
		list-style-type:none;
		margin:0;
		padding:2px 0 10px 20px;
	}
	.pitem li{
		font-size:12px;
		line-height:18px;
	}
	.demo-c{
		width:740px;
		height:550px;
		float:right;
		background:#fff;
		border:1px solid #ccc;
		border-radius:5px;
		-moz-border-radius:5px;
		-webkit-border-radius: 5px;
	}
</style>

<script type="text/javascript">
	$(function(){
		var serie;
		$('#mm').accordion('select','Application');
		open1('/tutorial/app/crud/index.html');

		$("#treeTurmas").tree({
			onClick: function(id, text, checked, attributes, target){  


				var disciplina = $('#treeTurmas').tree('getSelected').text;
				//var turma = $(this).html();
				var array_disciplina = disciplina.split("#");
				var cod_disciplina = array_disciplina[2];
				var cod_etapa = array_disciplina[3];
				
				
				var node = $('#treeTurmas').tree('getSelected');
				var busca = node.text.substring(0, 5);
				//var turma = node.text.substring(node.text.length - 2);

				var node = $('#treeTurmas').tree('getSelected');
				var pai = $('#treeTurmas').tree('getParent', node.target);

				$("#main_atrib").load("frame_atrib.php?turma="+pai.text+"&materia="+cod_disciplina+"&codetapa="+cod_etapa);
				//alert(cod_etapa);
				

			   }  
		});

		
	});
	function open1(url){
		$('#cc').attr('src',url);
	}
	function atualizar(){
		$('#table_professores').datagrid('reload');
	}
</script>
	
<div class="easyui-layout" style="width:1000px;height:600px;">

        <div region="west" split="true" title="Turmas" style="width:200px;">
		   <?php include "get_tree_turmas.php"?>
        </div>
        <div region="center" title="Atribuições" style="background:#fafafa;overflow:hidden">
            <div id="main_atrib"></div>
        </div>
       
        <div  region="east" title="Professores" split="true" style="width:180px;">
        	 <div id="professores">		
        	 	<table id="table_professores" title="Carga H." class="easyui-datagrid" style="width:150x;height:500px"
					url="get_professores_atrib.php"
					rownumbers="false" 
					fitColumns="true" 
					singleSelect="true" 
					loadMsg="Carregando...">
					<thead>
						<tr>
							<th field="professor" width="100">Professor</th>
							<th field="ch" width="50">CH</th>
						</tr>
					</thead>
				</table>
				<div class="toolbar" align="center">
					<a href="#" class="easyui-linkbutton l-btn" id="atualizar" onclick="atualizar()">
					  <span class="l-btn-text icon-reload" style="padding-left: 20px; ">Atualizar</span>
					</a>
				</div>
        	 </div>
        </div>        
    </div>
