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
		function cadastrarCurso(){
			$('#dlg').dialog('open').dialog('setTitle','Cadastrar Curso');
			$('#fm').form('clear');
			url = 'salvar_curso.php';
		}
		function editarCurso(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Dados do Curso');
				$('#fm').form('load',row);
				url = 'atualizar_curso.php?cod='+row.codCurso;
			}
		}
		function salvarCurso(){

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

		
		function apagarCurso(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirmar','Tem certeza que deseja apagar esse curso?',function(r){
					if (r){
						$.post('apagar_curso.php',{id:row.codCurso},function(result){
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
	<table id="dg" title="Cursos" class="easyui-datagrid" style="width:500px;height:500px"
			url="get_cursos.php"
			toolbar="#toolbar"
			rownumbers="false" fitColumns="true" singleSelect="true" pagination="true" loadMsg="Carregando...">
		<thead>
		
			<tr>
				<th field="habilitacao" width="350" sortable="true">Habilitação</th>
				<th field="numeroCurso" width="100" sortable="true">Cód CPS</th>
				<th field="doe" width="150">D.O.E.</th>
				<th field="periodicidade" width="150">Periodicidade</th>
			</tr>
		</thead>
	</table>
	</div>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="cadastrarCurso()">Cadastrar Curso</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarCurso()">Editar Curso</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="apagarCurso()">Apagar Curso</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:300px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Dados do Curso</div>
		<form id="fm" method="post">
			<div class="fitem">
				<label>Habilitação:</label>
				<input name="habilitacao" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Número CPS:</label>
				<input name="numeroCurso">
			</div>
			<div class="fitem">
				<label>D.O.E.</label>
				<input name="doe">
			</div>			
			<div class="fitem">
				<label>Periodicidade</label>
				<select name="periodicidade">
					<option value="anual">anual</option>
					<option value="semestral">semestral</option>
				</select>
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="salvarCurso()">Gravar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
	</div>
