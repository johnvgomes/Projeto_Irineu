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

			$('#cmbSeries').combogrid({  
			    panelWidth:250,  
			    value:'1',  
			   
			    idField:'codSerie',  
			    textField:'serie',  
			    url:'../series/get_series.php',  
			    columns:[[  
			        {field:'codSerie',title:'Cód',width:60},  
			        {field:'serie',title:'Série',width:100}
			    ]]  
			});  

			$('#cmbEtapas').combogrid({  
			    panelWidth:150,  
			    value:'1',  
			   
			    idField:'codEtapa',  
			    textField:'etapa',  
			    url:'../etapas/get_etapas.php',  
			    columns:[[  
			        {field:'codEtapa',title:'Cód',width:60},  
			        {field:'etapa',title:'Etapa',width:100}  
			     ]]  
			});  
	});


		var url;
		function cadastrarTurma(){
			$('#dlg').dialog('open').dialog('setTitle','Cadastrar Turma');
			$('#fm').form('clear');
			url = 'salvar_turma.php';
		}
		function editarTurma(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Dados da Turma');
				$('#fm').form('load',row);
				url = 'atualizar_turma.php?cod='+row.codTurma;
			}
		}
		function salvarTurma(){

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

		
		function apagarTurma(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirmar','Tem certeza que deseja apagar essa turma?',function(r){
					if (r){
						$.post('apagar_turma.php',{id:row.codTurma},function(result){
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

	function certificado(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				window.open("certificado/certificado_modulo.php?codTurma="+row.codTurma);	
				
			}else{
				$.messager.show({
					title: 'Erro',
					msg: 'Selecione uma turma'
				});
			}
	}

		
	</script>
	<div id="pp" style="background:#efefef;border:1px solid #ccc;">
	<table id="dg" title="Turmas" class="easyui-datagrid" style="width:670px;height:500px"
			url="get_turmas.php"
			toolbar="#toolbar"
			rownumbers="false" fitColumns="true" singleSelect="true" pagination="true" loadMsg="Carregando...">
		<thead>
		
			<tr>
				<th field="turma" width="50">Turma</th>
				<th field="modulo" width="70">Módulo</th>
				<th field="serie" width="50">Série</th>
				<th field="etapa" width="200">Etapa</th>
			</tr>
		</thead>
	</table>
	</div>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="cadastrarTurma()">Cadastrar Turma</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarTurma()">Editar Turma</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="apagarTurma()">Apagar Turma</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="certificado()">Certificado de Modulo</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:300px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Dados da Turma</div>
		<form id="fm" method="post">
			<div class="fitem">
				<label>Módulo:</label>
				<input name="modulo" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Série:</label>
				<select id="cmbSeries" name="codSerie"></select>  
			</div>
			<div class="fitem">
				<label>Etapa</label>
				<select id="cmbEtapas" name="codEtapa"></select>  
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="salvarTurma()">Gravar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
	</div>
