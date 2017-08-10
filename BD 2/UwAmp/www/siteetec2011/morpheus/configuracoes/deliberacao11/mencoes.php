<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Relatório de Menções</title>
		<link rel="stylesheet" href="bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
<?php

//verificar se usuário está logado e se tem permissões
session_name('jcLogin');
session_start();

include '../../conexao/conn.php';
 
if($_SESSION['id']){

	//verificar se é um professor
	if (isset($_GET["codturma"])){
		$codTurma = $_GET["codturma"];
		$codDisciplina = $_GET["coddisciplina"];
		$mes = $_SESSION["mes"];
		$perfil = "professor";

	}else{
	$id = $_SESSION['id'];

	//verificar se é um perfil da secretaria que tem acesso a todas as turmas
	$sqlPerfil = "SELECT * FROM Professores WHERE codProfessor=$id";
	$rsPerfil = mysql_query($sqlPerfil);
	$perfil = mysql_result($rsPerfil, 0, "perfil");

	//Se for coordenador mostrar o menu com as turmas do curso
	$sqlCurso = "SELECT * FROM Cursos WHERE codCoordenador=$id";
	$rsCurso = mysql_query($sqlCurso);

	if (mysql_num_rows($rsCurso)>0 || $perfil==1){
		$codTurma = (isset($_POST["cmb_turmas"]))?$_POST["cmb_turmas"]:0;
		$codDisciplina = (isset($_POST["cmb_disciplinas"]))?$_POST["cmb_disciplinas"]:0;
		$mes = $_POST["mes"];
		$codCurso = mysql_result($rsCurso, 0, "codCurso");
		//se for secretaria mostrar todos os cursos
		if ($perfil==1){
			$sqlTurmas = "SELECT Turmas.*, Series.* FROM Turmas 
				INNER JOIN Series ON Series.codSerie=Turmas.codSerie
				INNER JOIN Etapas ON Etapas.codEtapa=Turmas.codEtapa
				WHERE Turmas.codEtapa=6 OR Etapas.semestre=0
				ORDER BY modulo, serie";
			
		}else{

			
			$sqlTurmas = "SELECT Turmas.*, Series.* FROM Turmas 
					INNER JOIN Series ON Series.codSerie=Turmas.codSerie
					WHERE Series.codCurso=$codCurso
					ORDER BY modulo, serie";
		}
		$rsTurmas = mysql_query($sqlTurmas);

		?>
		
		<script type="text/javascript">
			jQuery(window).load(function($){
   				getValor(<?php echo $codTurma; ?>);
			});

				$( "#dialog-obs" ).dialog({
					autoOpen: false,
					resizable: false,
					height:240,
					modal: true,
					buttons: {
						Gravar: function() {
							var codencontro = $("#dialog-confirm").attr("cod");
							var linha = "#linha" + codencontro;
							$.post("chamada/apagar_aula.php", {codEncontro: codencontro})
								.success(function(){
									$( this ).dialog( "close" );
									$("#linha_"+codencontro).hide('highlight' );


							})
							.error(function(){
								$("#retorno").html("Erro ao apagar aula");
							}); 
							$( this ).dialog( "close" );
						},
						Cancelar: function() {
							$( this ).dialog( "close" );
						}
					}
				});

		   function getValor(valor){

		     $("#cmb_disciplinas").html("<option value='0'>Carregando...</option>");
		     setTimeout(function(){
		          $("#cmb_disciplinas").load("get_disciplinas.php",{codturma:valor, codDisciplina:<?php echo $codDisciplina?>})
		   		}, 500)
			};
		</script>
		</head>
		<body>
		<div class="no-print" style="text-align: right;">
		<form action="diario.php" method="post">
			<select name="cmb_turmas" id="cmb_turmas" onchange="getValor(this.value)">
		    <option value=0>Selecione a turma</option>
			   <?php
			   		while ($row = mysql_fetch_array($rsTurmas)) {
			   			$codTurmar = $row["codTurma"];
			   			$modulo = $row["modulo"];
			   			$turma = $row["modulo"]. $row["serie"];
			   			$selected = ($codTurma==$codTurmar)?"selected=selected":"";
			   			echo "<option value=$codTurmar $selected>$turma</option>"; 
			   		}
			   ?>
			</select>

			<select name="cmb_disciplinas" id="cmb_disciplinas" >
			    <option value="0"> </option>
			</select>
			<?php $mes = (isset($_POST["mes"]))?$_POST["mes"]:date("m"); ?>
			Mês:<input class="input-mini" style="height:30px" id="mes" type=text size=3 name="mes" value=<?php echo $mes;?> >
			<input type="submit" value="Gerar diário" tabindex="62" class="btn btn-primary">
		    </form>
			<?php if (isset($_POST["cmb_turmas"])){
				echo "<br><form action=observar.php method=post name=form_obs>";
				echo "<input type=hidden name='codTurma' value=$codTurma>";
				echo "<input type=hidden name='codDisciplina' value=$codDisciplina>";
				echo "<input type=hidden name='mes' value=$mes>";
				echo "<input class='input-xxlarge' style='height:30px' id='observacao' type=text name='observacao'> ";
				echo "<input type=submit id=btn_observar value='Fazer Observação' class='btn btn-primary'>"; 
				echo "</form>";
			}
			?>
		
		</div>
		<?php
		
	}	
	}

}else{
	echo "Você não tem autorização para acessar essa página";
}

//if (!isset($_POST["mes"])) exit();

$sqlCabecalho = "SELECT Professores.nomeProfessor, Periodos.descricaoPeriodo, Etapas.*, Disciplinas.disciplina, Cursos.habilitacao, concat(Turmas.modulo,Series.serie) as turma FROM Disciplinas
				INNER JOIN Cursos ON Disciplinas.codCurso=Cursos.codCurso
				INNER JOIN Series ON Series.codCurso=Cursos.codCurso
				INNER JOIN Turmas ON Turmas.codSerie=Series.codSerie
				INNER JOIN Etapas ON Etapas.codEtapa=Turmas.codEtapa
				INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
				INNER JOIN Atribuicoes ON  ( Atribuicoes.codDisciplina = Disciplinas.codDisciplina AND Atribuicoes.codSerie = Series.codSerie ) 
				INNER JOIN Professores ON Atribuicoes.codProfessor=Professores.codProfessor
				WHERE Disciplinas.codDisciplina=$codDisciplina
				AND Turmas.codTurma=$codTurma";

$rsCabecalho = mysql_query($sqlCabecalho);

$sqlAlunos = "SELECT Alunos.codAluno, Alunos.nomeAluno, Alunos.rg, Matriculas.nChamada, Matriculas.codMatricula, Matriculas.status FROM Alunos
			INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno
			WHERE Matriculas.codTurma=$codTurma
			ORDER BY nChamada" ;

$rsAlunos = mysql_query($sqlAlunos);

$sqlAvaliacoes = "SELECT * FROM Avaliacoes 
				WHERE codTurma=$codTurma 
				AND codDisciplina=$codDisciplina";

$rsAvaliacoes = mysql_query($sqlAvaliacoes);

$semestre = mysql_result($rsCabecalho, 0, "semestre");
$codetapa = mysql_result($rsCabecalho, 0, "codEtapa");


?>

<style>
table {
	font-size: 8px;
}
td {
	padding: 1px;
}
.espacado td {
	padding: 2px 1px;
}
.avaliacoes, .resumo {
	float: left;
	margin: 8px;
	text-align: center;
	border: 1px solid #000;
	padding: 15px;
}
.maior {
	font-size: 150%;
}
</style>

<table class="relatorio">
	<colgroup>
		<col style="width: 10px;">
		<col style="width: 227px;">
		<col style="width: 80px;">
		<col span="34" style="width: 13px;">
		<col span="10" style="width: 24px;">
	</colgroup>
	<tbody>

	<tr>
		<td colspan="2" rowspan="5"><img src="logo_relatorio.png" style="width: 360px;"></td>
		<td colspan="45" class="centro maior">REGISTRO DO HISTÓRICO DO DESEMPENHO ESCOLAR</td>
	</tr>
	<tr>
		<td colspan="15">SEMESTRE/ANO:</td>
		<td colspan="19">TURMA:</td>
		<td colspan="11">DISCIPLINA:</td>
	</tr>
	<tr>
		<td colspan="15" class="centro maior"><?php echo mysql_result($rsCabecalho, 0, "etapa")?></td>
		<td colspan="19" class="centro maior"><?php echo mysql_result($rsCabecalho, 0, "turma")?></td>
		<td colspan="11" class="centro maior"><?php echo ( mysql_result($rsCabecalho, 0, "disciplina") )?></td>
	</tr>
	<tr>
		<td colspan="15">CURSO:</td>
		<td colspan="19">PERÍODO:</td>
		<td colspan="11">PROFESSOR:</td>
	</tr>
	<tr>
		<td colspan="15" class="centro maior"><?php echo ( mysql_result($rsCabecalho, 0, "habilitacao") ) ?></td>
		<td colspan="19" class="centro maior"><?php echo ( mysql_result($rsCabecalho, 0, "descricaoPeriodo") )?></td>
		<td colspan="11" class="centro maior">
			<?php echo  (mysql_result($rsCabecalho, 0, "nomeProfessor")); ?> 
			<?php if (mysql_num_rows($rsCabecalho)>1) echo " e ". ( mysql_result($rsCabecalho, 1, "nomeProfessor")); ?> 
		</td>
	</tr>
	<tr>
		<td class="centro bold" style="height:20px;">Nº</td>
		<td class="centro bold">NOME DO ALUNO</td>
		<td class="centro bold">RM</td>
		<td class="centro bold"></td>

		<?php
			// cabeçalho de avaliações
			$qtde_avaliacoes = 0;
			while ($row = mysql_fetch_array($rsAvaliacoes)) {
				echo "<td class='centro bold'>";
				echo $row["sigla"];
				echo "</td>";
				$qtde_avaliacoes++;
				
			}
			//preencher as celulas vazias
			if ($semestre==0) $colunas = 38; else $colunas = 40;
			while ($qtde_avaliacoes<$colunas) {
				echo "<td style='max-width: 9px; vertical-align: bottom;'><span class='vertical'></span></td>";
				$qtde_avaliacoes++;
			}

		?>

		<td class="centro bold">Nº</td>
		<?php if ($semestre==0) { ?>
			<td class="centro bold">MI</td>
			<td class="centro bold">MI</td>
		<?php } ?>
		<td class="centro bold">MI</td>
		<td class="centro bold">MF</td>
	
	</tr>

<?php
$qtde_aluno = 0;
while ($row = mysql_fetch_array($rsAlunos)) {
	$qtde_aluno++;
	$codAluno = $row["codAluno"];
	$nChamada = $row["nChamada"];
	$nome = utf8_encode($row["nomeAluno"]);
	$rm = $row["rg"];
	$codMatricula = $row["codMatricula"];
	$status = $row["status"];
	echo "<tr><td class='centro'>$nChamada</td>";
	echo "<td width='400px'>$nome</td>";
	echo "<td>$rm</td>";

	//Verificar se o aluno é dispensado da disciplina
	$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula AND codDisciplina=$codDisciplina";
	$rsDispensa = mysql_query($sqlDispensa);
	if (mysql_num_rows($rsDispensa)>0) {
		for ($i=0; $i < 44; $i++) { 
			echo "<td>D</td>";
		}
		continue;
	}

	//verificar se a matricula está ativiva ou houve cancelamento, transferencia, etc.
	if($status!="MA"){
		for ($i=0; $i<44; $i++){
			echo "<td>$status</td>";
		}
		continue;
	}

	echo "<td>$totaldefaltas</td>";


	//buscar mencoes avaliacoes
	$rsAvaliacoes = mysql_query($sqlAvaliacoes);
	$qtde_avaliacoes = 0;
	while ($rowE = mysql_fetch_array($rsAvaliacoes)) {
		$codAvaliacao = $rowE["codAvaliacao"];

		$sqlMencaoAvaliacao = "SELECT * FROM MencoesAvaliacoes WHERE codAvaliacao=$codAvaliacao AND codAluno=$codAluno";
		$rsMencaoAvaliacao = mysql_query($sqlMencaoAvaliacao);
		$mencaoAvaliacao = mysql_result($rsMencaoAvaliacao, 0, "mencao");
		if ($mencaoAvaliacao == "I"){
			echo "<td style='width:20px;color:red'class='centro bold'>$mencaoAvaliacao</td>";
		}else{
			echo "<td style='width:20px'class='centro'>$mencaoAvaliacao</td>";
		}
		$qtde_avaliacoes++;		
	}

	while ($qtde_avaliacoes<$colunas) {
		echo "<td class='centro'></td>";
		$qtde_avaliacoes++;
	}

	echo "<td class='centro'>$nChamada</td>";
	if ($semestre==0){
		$sqlMencaoEM = "SELECT * FROM Mencoes WHERE codDisciplina=$codDisciplina AND codAluno=$codAluno AND codEtapa=5";
		$sqlMencao = "SELECT * FROM Mencoes WHERE codDisciplina=$codDisciplina AND codAluno=$codAluno AND codEtapa=$codetapa";
		$rsMencaoEM = mysql_query($sqlMencaoEM);
		$rsMencao = mysql_query($sqlMencao);
		$mencaoI = mysql_result($rsMencaoEM, 0, "mencaoIntermediaria");
		$mencaoI2 = mysql_result($rsMencaoEM, 0, "mencaoFinal");
		$mencaoI3= mysql_result($rsMencao, 0, "mencaoIntermediaria");
		$mencaoF = mysql_result($rsMencao, 0, "mencaoFinal");

		echo "<td class='centro'>$mencaoI</td>";
		echo "<td class='centro'>$mencaoI2</td>";
		echo "<td class='centro'>$mencaoI3</td>";
		echo "<td class='centro'>$mencaoF</td>";

	}else{
		$sqlMencao = "SELECT * FROM Mencoes WHERE codDisciplina=$codDisciplina AND codAluno=$codAluno AND codEtapa=$codetapa";
		$rsMencao = mysql_query($sqlMencao);
		$mencaoI = mysql_result($rsMencao, 0, "mencaoIntermediaria");
		$mencaoF = mysql_result($rsMencao, 0, "mencaoFinal");
		
		echo "<td class='centro'>$mencaoI</td>";
		echo "<td class='centro'>$mencaoF</td>";

	}
	echo "</tr>";
}
//echo $sqlMencao;
//completar as linhas para quebra de página
while ($qtde_aluno<40) {
	$n = $qtde_aluno + 1;
	echo "<tr>";
	echo "<td class='centro'>$n</td>";
	for ($i=0; $i < 46 ; $i++) { 
		echo "<td class='centro'> </td>";
	}
	
	echo "</tr>";
	$qtde_aluno++;
}

?>

</tbody>
</table>



<table class="relatorio espacado" style="page-break-before: always;">
	<colgroup>
	<col style="width: 34px;">
	<col style="width: 200px;">
	<col style="width: 92px;">
	<col style="width: 400px;">
	<col style="width: 375px;">
	<col style="width: 92px;">
	</colgroup><tbody><tr>
		<td colspan="4" class="centro maior bold">AVALIAÇÕES DA DISCIPLINA</td>
		<td colspan="2" class="centro maior bold">OBSERVAÇÕES DO PROFESSOR</td>
	</tr>
	<tr>
		<td class="centro maior">SIGLA</td>
		<td class="centro maior">TIPO</td>
		<td class="centro maior">DATA</td>
		<td class="centro maior">DESCRIÇÃO DA AVALIAÇÃO</td>
		<td colspan=2></td>
	</tr>
	<?php
		$rsAvaliacoes= mysql_query($sqlAvaliacoes);

		$qtde_avaliacoes=0;
		while ($row = mysql_fetch_array($rsAvaliacoes)) {
			echo "<tr><td class='centro maior' style='height: 3ex;'>";
			echo $row["sigla"];
			echo "<td class='maior' style='text-overflow: ellipsis;'>";
			echo ( $row["tipo"] );
			echo "</td><td style='text-overflow: ellipsis;' class='centro maior'>";
			echo $row["data"];
			echo "</td><td class='maior' style='text-overflow: ellipsis;'>";
			echo $row["descricao"];
			echo "</td><td colspan=2></td></tr>"; 
			$qtde_avaliacoes++;
		}

		while($qtde_avaliacoes<35){
			echo "<tr><td class='centro' style='height: 3ex;'><td style='text-overflow: ellipsis;'></td><td></td><td></td><td colspan=2></td></tr>"; 
			$qtde_avaliacoes++;
		}

	?>
	</tr>
</tbody></table>

<br><br>
Data da impressão: <?php echo date("d / m / Y"); ?>
<br><br><br>
<?php echo  "<div style='float:left;border-top:solid 1px;width:200px;white-space: nowrap ;'>" . (mysql_result($rsCabecalho, 0, "nomeProfessor")) . "</div>"; ?> 
<?php if (mysql_num_rows($rsCabecalho)>1) {
	echo "<div style='margin-left:400px;border-top: solid 1px;width:200px;white-space: nowrap ;'>". ( mysql_result($rsCabecalho, 1, "nomeProfessor")) . "</div>"; 
}?> 
	
</body></html>
