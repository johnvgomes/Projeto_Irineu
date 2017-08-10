<?php 
include '../../conexao/conn.php';
$codTurma =   $_GET["codTurma"]; 
$result = mysql_query ( " select concat(Turmas.modulo, Series.serie) as turma  FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie where codTurma=$codTurma");
$row = mysql_fetch_row($result);
$turma = $row[0];
$modulo = substr($turma, 0, 1);
$serie = substr($turma, 1, 1);

//pegar o código do curso
$result = mysql_query ( " select Turmas.codTurma, Series.codCurso FROM Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie WHERE modulo=$modulo and serie='$serie'");
$codCurso = mysql_result($result, 0, "codCurso");

//consultar as disciplinas da turma
$sqlDisciplinas =  "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo ORDER BY numeroPlanoDeCurso" ;
$rsDisciplinas = mysql_query ($sqlDisciplinas);
?>	
		
    <script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="../../jquery/jquery.easyui.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/icon.css">
	<link type="text/css" href="../../jquery/css/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	<script type="text/javascript">
	$(function() {
		$('#table_alunos').datagrid();  
	});

	function formatFreq(val,row){  
	    if (val < 75){  
	        return '<span style="color:red;">'+val+'</span>';  
	    } else {  
	        return val;  
	    }  
	}  	
	function formatMencao(val,row){  
	    if (val == "I"){  
	        return '<span style="color:red;"><strong>'+val+'</strong></span>';  
	    } else {  
	        return val;  
	    }  
	} 
	
	function editar(){
		var row = $('#table_alunos').datagrid('getSelected');
		if (row){
			$('#dlg').dialog('open').dialog('setTitle','Decisões do Conselho');
			$('#fm').form('load',row);
			url = 'gravar_decisoes.php?cod='+row.codMatricula;
		}
	}

	function salvar(){

		$('#fm').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){

				var result = eval('('+result+')');
				if (result.success){
					$('#dlg').dialog('close');		// close the dialog
					$('#table_alunos').datagrid('reload');	// reload the user data
				} else {
					$.messager.show({
						title: 'Erro',
						msg: result.msg
					});
				}
			}
		});
	}

	function abrirConselho(){
		var row = $('#table_alunos').datagrid('getSelected');
		if (row){
			url = "intermediario/conselho_intermediario2.php?codturma=<?php echo $codTurma ?>&nchamada="+row.nChamada;
		}else{
			url = "intermediario/conselho_intermediario2.php?codturma=<?php echo $codTurma ?>&nchamada=1";

		}
			window.open(url);
	}

	function deliberar(){
		var row = $('#table_alunos').datagrid('getSelected');
			if (row){
				var codMatricula = row.codMatricula;
				window.open("../deliberacao11/relatorio.php?codMatricula="+codMatricula);
			}else{
				alert ("Selecione um aluno");
			}
			
	}
	
	function abrir_ata(){
		window.open("ata/relatorio_ata2.php?codTurma=<?php echo $codTurma ?>");		
	}
</script>

<div id='excel'></div>


	<table id="table_alunos" title="2o Conselho Intermediário do <?php echo $turma ?>" class="easyui-datagrid" style="width:150x;height:500px"
			url="get_alunos.php?etapa=2&codTurma=<?php echo $codTurma?>"
			toolbar="#toolbar"
			rownumbers="false" 
			fitColumns="true" 
			singleSelect="true" 
			loadMsg="Carregando...">
			<thead>
			<tr>
				<th field="nChamada" width="10">N.</th>
				<th field="nomeAluno" width="80">Aluno</th>
				<th field="aulasDadas" width="20" align="center">Aulas Dadas</th>
				<th field="faltas" width="20" align="center">Faltas</th>
				<th field="frequencia" width="22" align="center" formatter="formatFreq">% Freq.</th>
				<?php 
				while ($row = mysql_fetch_array($rsDisciplinas)){
					$codDisciplina = $row["codDisciplina"];
					$disciplina = $row["sigla"];
					echo "<th field='$codDisciplina' width='20' align='center' formatter='formatMencao'>$disciplina</th>";
				}
				?>
				<th field="resumo" width="50">Resumo das discussões</th>
				<th field="resultado" width="50">Resultado Final</th>
			</tr>
			</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editar()">Editar Decisões do Conselho</a>
		<a href="export/exportar.php?etapa=I&codturma=<?php echo $codTurma ?>" target="_blank" class="easyui-linkbutton" iconCls="icon-save" plain="true">Salvar como Planilha</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="deliberar()">Deliberação 11</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="abrir_ata()">Ata do Conselho</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="abrirConselho()">Tela Cheia</a>
	</div>

	<div id="dlg" class="easyui-dialog" style="width:500px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle"></div>
		<form id="fm" method="post">
			<div class="fitem">
				<label>Aluno:</label>
				<input name="nomeAluno" readonly="readonly" size=70 style="border:0px" />
			</div>
			<div class="fitem">
				<label>Resumo das discussões:</label>
				<input name="resumo" size=50 />
			</div>
			<div class="fitem">
				<label>Resultado Final:</label>
				<select name="resultado">
					<option>Promovido</option>
					<option>Retido</option>
					<option>Promovido com Progressão Parcial</option>
					<option>Reclasificado pelo Conselho</option>
				</select>
			</div>
			
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="salvar()">Gravar</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
	</div>
	