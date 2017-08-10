<?php 
include '../../conexao/conn.php';
$codTurma =   $_GET["codTurma"]; 

$result = mysql_query ( " select concat(Turmas.modulo, Series.serie) as turma, Turmas.modulo, Series.codCurso FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie where codTurma=$codTurma");
$row = mysql_fetch_row($result);
$turma = $row[0];
$modulo = $row[1];
$codCurso = $row[2];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>Build CRUD DataGrid with jQuery EasyUI - jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/icon.css">
	<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="../../jquery/jquery.easyui.min.js"></script>	
	<script type="text/javascript" src="../../jquery/jquery.edatagrid.js"></script>
	<script type="text/javascript">
	function apagarAluno(){
			var row = $('#table_matriculados').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirmar','Tem certeza que deseja apagar esse aluno dessa turma?',function(r){
					if (r){
						$.post('desmatricular.php',{id:row.codMatricula},function(result){
							if (result.success){
								$('#table_matriculados').datagrid('reload');	// reload the user data
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

		function zerarSenha(){
			var row = $('#table_matriculados').datagrid('getSelected');
			if (row){
				$.messager.confirm('Senha', 'Confirma reset da senha de' + row.nomeAluno, function(r){
					if(r) {
						$.post('zerarSenha.php',{id:row.rg},function(result){
							if (result.success){
								$.messager.show({	// show error message
									title: 'Sucesso',
									msg: 'A senha foi alterada para etecia@238'
								});
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
		function fichaMatricula(){
			var row = $('#table_matriculados').datagrid('getSelected');
			if (row){
				window.open("ficha_matricula.php?codMatricula="+row.codMatricula);
			}else{
				$.messager.show({	// show error message
									title: 'Ficha de Matrícula',
									msg: 'Selecione um aluno'
								});
			}
		}

		function dispensar(){
			var row = $('#table_matriculados').datagrid('getSelected');
			if (row){
				<?php 
					$sqlDiscipinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo";
					$rsDisciplinas = mysql_query($sqlDiscipinas);
					$str_disciplinas = "";
					while ($row_disciplinas = mysql_fetch_array($rsDisciplinas)) {
						$codDisciplina = $row_disciplinas["codDisciplina"];
						$disciplina = $row_disciplinas["disciplina"];
						$str_disciplinas .= $codDisciplina . " - " . $disciplina . "<br>";
					}
					$str_disciplinas .= "<br>Digite o código da disciplina que o aluno é dispensado:";
				?>
				var str_disciplinas = '<?php echo $str_disciplinas; ?>';
				
				$.messager.prompt('Disciplina', str_disciplinas, function(r){
					if (r){
						$.post('dispensar.php',{id:row.codMatricula, codDisciplina: r},function(result){
							if (result.success){
								$.messager.show({	// show error message
									title: 'Sucesso',
									msg: 'Aluno dispensado com sucesso'
								});
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

		$(function(){
			$('#table_matriculados').edatagrid({
				url: 'get_matriculados.php?codTurma=<?php echo $codTurma ?>',
				updateUrl: 'alterar_matricula.php',
				destroyUrl: 'desmatricular.php',
			});
		});
	</script>
</head>
<body>
		
	<table id="table_matriculados" title="Matriculados no <?php echo $turma?>" class="easyui-datagrid" style="width:150x;height:500px"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="nChamada" width="15" editor="{type:'validatebox',options:{required:true}}">N.</th>
				<th field="nomeAluno" width="200">Aluno</th>
				<th field="rg" width="50">RG</th>
				<th field="status" width="50" editor="{type:'validatebox',options:{required:true}}">Status</th>
				<th field="codMatricula" width="2">id</th>

			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="apagarAluno()">Apagar Aluno</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#table_matriculados').edatagrid('saveRow')">Salvar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#table_matriculados').edatagrid('cancelRow')">Cancelar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="javascript:dispensar()">Dispensas</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="javascript:zerarSenha()">Zerar Senha</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:fichaMatricula()">Ficha de Matrícula</a>
		
	</div>
	
</body>
</html>