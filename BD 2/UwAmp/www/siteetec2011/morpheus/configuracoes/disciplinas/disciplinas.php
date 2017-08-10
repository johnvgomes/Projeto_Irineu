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

			$('#nbsCH').numberspinner({
				editable:true,
				precision:1  
			});  

			$('#cmbCursos').combogrid({  
			    panelWidth:150,  
			    value:'1',  
			   
			    idField:'codCurso',  
			    textField:'habilitacao',  
			    url:'../cursos/get_cursos.php',  
			    columns:[[  
			        {field:'codCurso',title:'Cód',width:30},  
			        {field:'habilitacao',title:'Curso',width:100}  
			     ]]  
			});  
	});


		var url;
		function cadastrarDisciplina(){
			$('#dlg').dialog('open').dialog('setTitle','Cadastrar Disciplina');
			$('#fm').form('clear');
			url = 'salvar_disciplina.php';
		}
		function editarDisciplina(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Dados da Disciplina');
				$('#fm').form('load',row);
				url = 'atualizar_disciplina.php?cod='+row.codDisciplina;
			}
		}
		function salvarDisciplina(){

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

		
		function apagarDisciplina(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirmar','Tem certeza que deseja apagar essa disciplina?',function(r){
					if (r){
						$.post('apagar_disciplina.php',{id:row.codDisciplina},function(result){
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
	<table id="dg" title="Disciplina" class="easyui-datagrid" style="width:870px;height:500px"
			url="get_disciplinas.php"
			toolbar="#toolbar"
			rownumbers="false" 
			fitColumns="true" 
			singleSelect="true" 
			pagination="true" 
			loadMsg="Carregando...">
		<thead>
			<tr>
				<th field="numeroPlanoDeCurso" width="50" sortable="true">Cód</th>
				<th field="disciplina" width="300" sortable="true">Disciplina</th>
				<th field="sigla" width="50" sortable="true">Sigla</th>
				<th field="cargaHoraria" width="50">CH</th>
				<th field="curso" width="100" sortable="true">Curso</th>
				<th field="modulo" width="50" sortable="true">Módulo</th>
			</tr>
		</thead>
	</table>
	</div>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="cadastrarDisciplina()">Cadastrar Disciplina</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarDisciplina()">Editar Disciplina</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="apagarDisciplina()">Apagar Disciplina</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:500px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Dados da Disciplina</div>
		<form id="fm" method="post">
			<div class="fitem">
				<label>Número Plano de Curso</label>
				<input name="numeroPlanoDeCurso" class="fitem" size=10>
			</div>
			<div class="fitem">
				<label>Disciplina</label>
				<input name="disciplina" size=30 class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Sigla</label>
				<input name="sigla" size=5 class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Carga Horária</label>
				<input id="nbsCH" name="cargaHoraria" required="true" style="width:80px;">
			</div>
			<div class="fitem">
				<label>Curso</label>
				<select id="cmbCursos" name="codCurso"></select>  
			</div>
			<div class="fitem">
				<label>Módulo</label>
				<input name="modulo" size=5 class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="salvarDisciplina()">Gravar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
	</div>
