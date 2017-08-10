<?php 
include '../../conexao/conn.php';
$codCurso =   $_GET["codCurso"]; 

$sqlCabecalho = "SELECT * FROM Cursos 
					WHERE codCurso=$codCurso ";
$rsCabecalho = mysql_query($sqlCabecalho);

$habilitacao = mysql_result($rsCabecalho, 0, "habilitacao");

$ordem = 1;

//pegar todas as turmas do curso
$sqlTurmas = "SELECT Turmas.codTurma FROM Turmas 
				INNER JOIN Series ON Series.codSerie=Turmas.codSerie 
				WHERE Series.codCurso=$codCurso";
$rsTurmas = mysql_query($sqlTurmas);

?>

<html>
<head>
	<meta charset="UTF8">
</head>

<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Relatório de PP</title>
		<link rel="stylesheet" href="../../includes/bootstrap.css">
		<style type="text/css">
			input.error {
			    border-color: red;
			    outline-color: red;
			}
		</style>
		<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="../../includes/jquery/js/jquery.maskedinput.min.js"></script>

		<script type="text/javascript">
		    $(function(){
		    	$(".campo_data").mask("99/99/9999", {placeholder: " "});  

		        $(".campo").change(function () {
		          var nomeCampo = $(this).attr("name");
		          var codDisciplina = $(this).attr("codDisciplina");
		          var codMatricula = $(this).attr("codMatricula");
		          var valor = $(this).val();
		          $(this).removeClass("error");
		          //alert(nomeCampo + " " + codDisciplina + " " + codMatricula + " " + valor);
		          $.post("gravar_form_pp.php", 
		            {codDisciplina: codDisciplina, codMatricula: codMatricula, campo: nomeCampo, valor : valor })
		              .error(function() { 
		              	$(this).addClass("error");
		              	alert("Erro ao gravar dados. Banco de Dados Indisponível. Refaça a digitação do campo marcado em vermelho."); 
		              }) 
		        });
		    });      
		  </script>
</head>

<h1>Controle dos Alunos em Progressão Parcial - <?php echo $habilitacao; ?></h1>
<table class="table table-condensed table-bordered">
	<tr>
		<th>Ordem</th>
		<th>Nome do Aluno</th>
		<th>Período</th>
		<th>PP na Série/Módulo</th>
		<th>Semestre/Ano</th>
		<th>Componente Curricular</th>
		<th>Professor Responsável</th>
		<th>Concluiu em</th>
		<th>Menção</th>
		<th>Motivo</th>

	</tr>
	<tbody>
	<?php

	while ($rowTurmas = mysql_fetch_array($rsTurmas)) {
		$codTurma = $rowTurmas["codTurma"];
		$sqlAlunos = "SELECT Alunos.nomeAluno, Periodos.descricaoPeriodo, Turmas.modulo, Series.serie, Etapas.etapa, Disciplinas.disciplina, Disciplinas.codDisciplina, Matriculas.codMatricula FROM Alunos
						INNER JOIN Matriculas ON Matriculas.codAluno=Alunos.codAluno 
						INNER JOIN ProgressoesParciais ON ProgressoesParciais.codMatricula=Matriculas.codMatricula
						INNER JOIN Turmas ON Turmas.codTurma=Matriculas.codTurma
						INNER JOIN Series ON Series.codSerie=Turmas.codSerie
						INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
						INNER JOIN Etapas ON Etapas.codEtapa=Turmas.codEtapa
						INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
						WHERE Matriculas.codTurma=$codTurma";
		$rsAlunos = mysql_query($sqlAlunos);

		while ($rowAluno = mysql_fetch_array($rsAlunos)) {
			$codDisciplina = $rowAluno["codDisciplina"];
			$codMatricula = $rowAluno["codMatricula"];
	
			//buscar dados da PP
			$sqlPP = "SELECT * FROM ProgressoesParciais WHERE codDisciplina=$codDisciplina AND codMatricula=$codMatricula";
			$rsPP = mysql_query($sqlPP);
			$rowPP = mysql_fetch_array($rsPP);
			$responsavel = $rowPP["responsavel"];
			$concluiuEm = $rowPP["concluiuEm"];
			if ($concluiuEm=="0000-00-00"){
				$concluiuEm = "";
			}else{
				$concluiuEm = implode("/",array_reverse(explode("-",$concluiuEm)));				
			}
			$mencao = $rowPP["mencao"];
			$motivo = $rowPP["motivo"];
		
			echo "<tr>";
			echo "<td>".$ordem."</td>";
			echo "<td>".$rowAluno["nomeAluno"]."</td>";
			echo "<td>".$rowAluno["descricaoPeriodo"]."</td>";
			echo "<td>".$rowAluno["modulo"].$rowAluno["serie"]."</td>";
			echo "<td>".$rowAluno["etapa"]."</td>";
			echo "<td>".$rowAluno["disciplina"]."</td>";
          	echo "<td><input type='text' name='responsavel' codDisciplina='$codDisciplina' codMatricula='$codMatricula' class='input-small campo' value='$responsavel' /></td>";
          	echo "<td><input type='text' name='concluiuEm' codDisciplina='$codDisciplina' codMatricula='$codMatricula' class='input-small campo campo_data' value='$concluiuEm' /></td>";
			echo "<td><select name='mencao' codDisciplina='$codDisciplina' codMatricula='$codMatricula' class='input-mini campo'><option></option>";
			if ($mencao=="MB") echo "<option value='MB' selected>MB</option>"; else echo "<option value='MB'>MB</option>";
			if ($mencao=="B") echo "<option value='B' selected>B</option>"; else echo "<option value='B'>B</option>";
			if ($mencao=="R") echo "<option value='R' selected>R</option>"; else echo "<option value='R'>R</option>";
			if ($mencao=="I") echo "<option value='I' selected>I</option>"; else echo "<option value='I'>I</option>";
			echo "</select></td>";
          	echo "<td><input type='text' name='motivo' codDisciplina='$codDisciplina' codMatricula='$codMatricula' class='input-meddium campo' value='$motivo' /></td>";
			echo "</tr>";
			$ordem++;
		}
	}
	?>
	</tbody>
</table>
