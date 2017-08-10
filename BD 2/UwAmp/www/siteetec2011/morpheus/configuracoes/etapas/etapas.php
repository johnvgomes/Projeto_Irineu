	<link rel="stylesheet" type="text/css" href="../../jquery/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/icon.css">
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
	</style>

	<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="../../jquery/jquery.easyui.min.js"></script>
	
	<script type="text/javascript">

	$(document).ready(function() {	

		$.fn.datebox.defaults.formatter = function(date) {

			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '/' + (m < 10 ? '0' + m : m) + '/' + y;
			};

		$.fn.datebox.defaults.parser = function(s) {
			if (s) {
			var a = s.split('/');
			var d = new Number(a[0]);
			var m = new Number(a[1]);
			var y = new Number(a[2]);
			var dd = new Date(y, m-1, d);
			return dd;
			
			} else {
			return new Date();
			}
			};

			$('#dd').datebox({  
			    required:false
			      
			});  

			$('#cc').combogrid({  
			    panelWidth:450,  
			    value:'1',  
			   
			    idField:'codCidade',  
			    textField:'cidade',  
			    url:'get_cidades.php',  
			    columns:[[  
			        {field:'codCidade',title:'Cód',width:60},  
			        {field:'cidade',title:'Cidade',width:100},  
			        {field:'estado',title:'Estado',width:120},  
			        {field:'pais',title:'Pais',width:100}  
			    ]]  
			});  

			$('#ee').combogrid({  
			    panelWidth:450,  
			    value:'1',  
			   
			    idField:'codEscola',  
			    textField:'nomeEscola',  
			    url:'get_escolas.php',  
			    columns:[[  
			        {field:'codEscola',title:'Cód',width:60},  
			        {field:'nomeEscola',title:'Escola',width:100},  
			        {field:'cidadeEscola',title:'Cidade',width:120}  
			     ]]  
			});  
	});


		var url;
		function cadastrarEtapa(){
			$('#dlg').dialog('open').dialog('setTitle','Cadastrar Etapa');
			$('#fm').form('clear');
			url = 'salvar_etapa.php';
		}
		function editarEtapa(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Dados da Etapa');
				$('#fm').form('load',row);
				url = 'atualizar_etapa.php?cod='+row.codEtapa;
			}
		}
		function salvarEtapa(){

			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){

					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Erro',
							msg: result.msg
						});
					}
				}
			});
		}

		
		function apagarEtapa(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirmar','Tem certeza que deseja apagar essa etapa?',function(r){
					if (r){
						$.post('apagar_etapa.php',{id:row.codEtapa},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Erro',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}

		
	</script>
	<div id="pp" style="background:#efefef;border:1px solid #ccc;">
	<table id="dg" title="Etapas" class="easyui-datagrid" style="width:800px;height:500px"
			url="get_etapas.php"
			toolbar="#toolbar"
			rownumbers="false" fitColumns="true" singleSelect="true" pagination="true" loadMsg="Carregando...">
		<thead>
		
			<tr>
				<th field="etapa" width="200">Etapa</th>
				<th field="ano" width="60">Ano</th>
				<th field="semestre" width="50">Semestre</th>
				<th field="dataEntrega1" width="100">Data Entrega 1</th>
				<th field="dataEntrega2" width="100">Data Entrega 2</th>
				<th field="dataEntrega3" width="100">Data Entrega 3</th>
				<th field="dataEntrega4" width="100">Data Entrega 4</th>
			</tr>
		</thead>
	</table>
	</div>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="cadastrarEtapa()">Cadastrar Etapa</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarEtapa()">Editar Etapa</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="apagarEtapa()">Apagar Etapa</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:500px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Dados da Etapa</div>
		<form id="fm" method="post">
			<div class="fitem">
				<label>Ano:</label>
				<input name="ano" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Semestre:</label>
				<select name="semestre" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
					<option value=1>1o Semestre</option>
					<option value=2>2o Semestre</option>
					<option value=0>Todos</option>
				</select>
			</div>
			<div class="fitem">
				<label>Data Entrega 1: (aaaa-mm-dd)</label>
				<input name="dataEntrega1" class="easyui-validatebox" missingMessage="Campo obrigatório" required="false">
			</div>
			<div class="fitem">
				<label>Data Entrega 2: (aaaa-mm-dd)</label>
				<input name="dataEntrega2" class="easyui-validatebox" missingMessage="Campo obrigatório" required="false">
			</div>
			<div class="fitem">
				<label>Data Entrega 3: (aaaa-mm-dd)</label>
				<input name="dataEntrega3" class="easyui-validatebox" missingMessage="Campo obrigatório" required="false">
			</div>
			<div class="fitem">
				<label>Data Entrega 4: (aaaa-mm-dd)</label>
				<input name="dataEntrega4" class="easyui-validatebox" missingMessage="Campo obrigatório" required="false">
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="salvarEtapa()">Gravar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
	</div>
