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
		function cadastrarAluno(){
			$('#dlg').dialog('open').dialog('setTitle','Cadastrar Aluno');
			$('#fm').form('clear');
			url = 'salvar_aluno.php';
		}
		function editarAluno(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Dados de Aluno');
				$('#fm').form('load',row);
				url = 'atualizar_aluno.php?cod='+row.codAluno;
			}
		}
		function salvarAluno(){

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

		
		function apagarAluno(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirmar','Tem certeza que deseja apagar esse aluno?',function(r){
					if (r){
						$.post('apagar_aluno.php',{id:row.codAluno},function(result){
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
	<table id="dg" title="Alunos" class="easyui-datagrid" style="width:1000px;height:500px"
			url="get_alunos.php"
			toolbar="#toolbar"
			fitColumns="true" 
			singleSelect="true" 
			title="Load Data" 
        	rownumbers="false" 
        	pagination="true"
			loadMsg="Carregando...">
		<thead>
		
			<tr>
				<th field="nomeAluno" width="130" sortable="true" >Nome</th>
				<th field="rg" width="40">RG</th>
				<th field="endereco" width="120">Endereço</th>
				<th field="numero" width="20">N.</th>
				<th field="telefone" width="40">Telefone</th>
				<th field="email" width="130">E-mail</th>
				<th field="dataNascimento" sortable="true" width="40">Nascimento</th>
				<th field="cidade" width="40" sortable="true">Cidade</th>
			</tr>
		</thead>
	</table>
	</div>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="cadastrarAluno()">Cadastrar Aluno</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarAluno()">Editar Aluno</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="apagarAluno()">Apagar Aluno</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:480px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Dados do Aluno</div>
		<form id="fm" method="post">
			<div class="fitem">
				<label>Nome completo:</label>
				<input name="nomeAluno" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>RG:</label>
				<input name="rg" class="easyui-validatebox"  missingMessage="Campo obrigatório" required="true">
			</div>
			<div class="fitem">
				<label>Orgão Expeditor:</label>
				<input name="orgaoExpeditor" class="fitem">
			</div>
			<div class="fitem">
				<label>Nascimento:</label>
				<input id="dd" name="nascimento" class="fitem">
			</div>
			<div class="fitem">
				<label>Endereço:</label>
				<input name="endereco" class="fitem">
			</div>
			<div class="fitem">
				<label>Número:</label>
				<input name="numero" class="fitem">
			</div>
			<div class="fitem">
				<label>Complemento:</label>
				<input name="complemento" class="fitem">
			</div>
			<div class="fitem">
				<label>Bairro:</label>
				<input name="bairro" class="fitem">
			</div>
			<div class="fitem">
				<label>Cidade:</label>
				<select id="cc" name="cidade" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true" style="width:150px;"></select>  
			</div>
			<div class="fitem">
				<label>CEP:</label>
				<input name="cep" class="fitem">
			</div>
			<div class="fitem">
				<label>DDD:</label>
				<input name="ddd" class="fitem">
			</div>
			<div class="fitem">
				<label>Telefone:</label>
				<input name="telefone" class="fitem">
			</div>
			<div class="fitem">
				<label>DDD2:</label>
				<input name="ddd2" class="fitem">
			</div>
			<div class="fitem">
				<label>Telefone2:</label>
				<input name="telefone2" class="fitem">
			</div>
			<div class="fitem">
				<label>E-mail:</label>
				<input name="email" class="fitem">
			</div>
			<div class="fitem">
				<label>Estado Cívil:</label>
				<select name="estadoCivil">
					<option value="SOLTEIRO">Solteiro</option>
					<option value="CASADO">Casado</option>
					<option value="OUTRO">Outro</option>
				</select>
			</div>
			<div class="fitem">
				<label>Sexo:</label>
				<select name="sexo"><option value="M">Masculino</option><option value="F">Feminino</option></select>
			</div>
			<div class="fitem">
				<label>RM:</label>
				<input name="RM" class="fitem">
			</div>
			<!-- div class="fitem">
				<label>Escola Ensino Médio:</label>
				<select id="ee" name="codEscolaEM" class="easyui-validatebox" missingMessage="Campo obrigatório" required="true" style="width:150px;"></select>  
			</div-->
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="salvarAluno()">Gravar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
	</div>
