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
		function cadastrarProfessor(){
			$('#dlg').dialog('open').dialog('setTitle','Cadastrar Professor');
			$('#fm').form('clear');
			url = 'salvar_professor.php';
		}
		function editarProfessor(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Dados de Professor');
				$('#fm').form('load',row);
				url = 'atualizar_professor.php?cod='+row.codProfessor;
			}
		}
		function salvarProfessor(){

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

		
		function apagarProfessor(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirmar','Tem certeza que deseja apagar esse professor?',function(r){
					if (r){
						$.post('apagar_professor.php',{id:row.codProfessor},function(result){
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
	<table id="dg" title="Professores" class="easyui-datagrid" style="width:1000px;height:500px"
			url="get_professores.php"
			toolbar="#toolbar"
			rownumbers="false" fitColumns="true" singleSelect="true" pagination="true" loadMsg="Carregando...">
		<thead>
		
			<tr>
				<th field="nomeProfessor" width="130">Nome</th>
				<th field="telefone" width="40">Telefone</th>
				<th field="login" width="40">Login</th>
				<th field="email" width="150">E-mail</th>
			</tr>
		</thead>
	</table>
	</div>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="cadastrarProfessor()">Cadastrar Professor</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarProfessor()">Editar Professor</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="apagarProfessor()">Apagar Professor</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:480px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Dados do Professor</div>
		<form id="fm" method="post">
			<div class="fitem">
				<label>Nome completo:</label>
				<input name="nomeProfessor" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Telefone:</label>
				<input name="telefone" class="fitem">
			</div>
			<div class="fitem">
				<label>E-mail:</label>
				<input name="email" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Perfil</label>
				<select name="perfil">
					<option value=0>Professor</option>
					<option value=1>Administrador</option>
				</select>
			</div>
			<div class="fitem">
				<label>Login:</label>
				<input name="login" class="fitem">
			</div>
			<div class="fitem">
				<label>Senha:</label>
				<input type="password" name="senha" class="fitem">*
				<p>*a senha aparece criptografada, para alterar digite a nova senha e grave.</p>
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="salvarProfessor()">Gravar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
	</div>
