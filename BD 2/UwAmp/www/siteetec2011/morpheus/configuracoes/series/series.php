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

			$('#cmbPeriodos').combogrid({  
			    panelWidth:250,  
			    value:'1',  
			   
			    idField:'codPeriodo',  
			    textField:'descricaoPeriodo',  
			    url:'get_periodos.php',  
			    columns:[[  
			        {field:'codPeriodo',title:'Cód',width:60},  
			        {field:'descricaoPeriodo',title:'Período',width:100}
			    ]]  
			});  

			$('#cmbCursos').combogrid({  
			    panelWidth:150,  
			    value:'1',  
			   
			    idField:'codCurso',  
			    textField:'habilitacao',  
			    url:'get_cursos.php',  
			    columns:[[  
			        {field:'codCurso',title:'Cód',width:30},  
			        {field:'habilitacao',title:'Habilitação',width:120}  
			     ]]  
			});  
	});


		var url;
		function cadastrarSerie(){
			$('#dlg').dialog('open').dialog('setTitle','Cadastrar Série');
			$('#fm').form('clear');
			url = 'salvar_serie.php';
		}
		function editarSerie(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Dados da Série');
				$('#fm').form('load',row);
				url = 'atualizar_serie.php?cod='+row.codSerie;
			}
		}
		function salvarSerie(){

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

		
		function apagarSerie(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirmar','Tem certeza que deseja apagar essa serie?',function(r){
					if (r){
						$.post('apagar_serie.php',{id:row.codSerie},function(result){
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
	<table id="dg" title="Séries" class="easyui-datagrid" style="width:470px;height:500px"
			url="get_series.php"
			toolbar="#toolbar"
			rownumbers="false" fitColumns="true" singleSelect="true" pagination="true" loadMsg="Carregando...">
		<thead>
		
			<tr>
				<th field="serie" width="70">Série</th>
				<th field="habilitacao" width="300">Curso</th>
				<th field="descricaoPeriodo" width="100">Período</th>
			</tr>
		</thead>
	</table>
	</div>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="cadastrarSerie()">Cadastrar Série</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarSerie()">Editar Série</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="apagarSerie()">Apagar Série</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:300px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Dados da Série</div>
		<form id="fm" method="post">
			<div class="fitem">
				<label>Série:</label>
				<input name="serie" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Curso:</label>
				<select id="cmbCursos" name="codCurso"></select>  
			</div>
			<div class="fitem">
				<label>Período</label>
				<select id="cmbPeriodos" name="codPeriodo"></select>  
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="salvarSerie()">Gravar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
	</div>
