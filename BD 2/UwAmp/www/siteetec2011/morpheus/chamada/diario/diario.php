<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Diário de classe</title>
		<link rel="stylesheet" href="bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
<?php

//verificar se usuário está logado e se tem permissões
session_name('jcLogin');
session_start();

include '../../conexao/conn.php';

// pegar as etapas atuais
$rsEtapaAtual = mysql_query("SELECT codEtapa FROM Etapas WHERE atual=1 ORDER BY semestre");
$codEtapaEM = mysql_result($rsEtapaAtual, 0, 0);
$codEtapa = mysql_result($rsEtapaAtual, 1, 0);

//verificar se o curso é semestral ou anual
$rsPeriodicidade = mysql_query("SELECT * FROM Etapas WHERE codEtapa=$codEtapa");
if (mysql_result($rsPeriodicidade, 0, "semestre")==0) $periodicidade="anual"; else $periodicidade="semestral"; 

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
				WHERE Turmas.codEtapa=$codEtapa OR Turmas.codEtapa=$codEtapaEM
				ORDER BY modulo, serie";
			
		}else{

			//se for coordenador, mostrar as turmas dos cursos que ele coordena			
			$sqlTurmas = "SELECT Turmas.*, Series.* FROM Turmas 
					INNER JOIN Series ON Series.codSerie=Turmas.codSerie
					WHERE ";

			$contCurso=1;
			$rsCurso = mysql_query($sqlCurso);
			$sqlTurmas.="(";
			while($rCursos=mysql_fetch_array($rsCurso)){
				$codCurso = $rCursos["codCurso"];
				if ($contCurso==1) $sqlTurmas.=" Series.codCurso=$codCurso";
				else $sqlTurmas.=" OR Series.codCurso=$codCurso";
				$contCurso++;
			}
			$sqlTurmas.=")";
					
			$sqlTurmas .= " AND (Turmas.codEtapa=$codEtapa OR Turmas.codEtapa=$codEtapaEM) 
							ORDER BY modulo, serie";
		}
		//echo $sqlTurmas;
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

if (!isset($_POST["mes"])) exit();

switch ($mes) {
	case '1':
		$mes_extenso="Janeiro";
		break;
	case '2':
		$mes_extenso="Fevereiro";
		break;
	case '3':
		$mes_extenso="Março";
		break;
	case '4':
		$mes_extenso="Abril";
		break;
	case '5':
		$mes_extenso="Maio";
		break;
	case '6':
		$mes_extenso="Junho";
		break;
	case '7':
		$mes_extenso="Julho";
		break;
	case '8':
		$mes_extenso="Agosto";
		break;
	case '9':
		$mes_extenso="Setembro";
		break;
	case '10':
		$mes_extenso="Outubro";
		break;
	case '11':
		$mes_extenso="Novembro";
		break;
	case '12':
		$mes_extenso="Dezembro";
		break;
	
}

$sqlCabecalho = "SELECT Professores.nomeProfessor, Professores.assinatura, Periodos.descricaoPeriodo, Etapas.etapa, Disciplinas.disciplina, Cursos.habilitacao, concat(Turmas.modulo,Series.serie) as turma FROM Disciplinas
				INNER JOIN Cursos ON Disciplinas.codCurso=Cursos.codCurso
				INNER JOIN Series ON Series.codCurso=Cursos.codCurso
				INNER JOIN Turmas ON Turmas.codSerie=Series.codSerie
				INNER JOIN Etapas ON Etapas.codEtapa=Turmas.codEtapa
				INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
				INNER JOIN Atribuicoes ON  ( Atribuicoes.codDisciplina = Disciplinas.codDisciplina AND Atribuicoes.codSerie = Series.codSerie AND Atribuicoes.codEtapa=Turmas.codEtapa ) 
				INNER JOIN Professores ON Atribuicoes.codProfessor=Professores.codProfessor
				WHERE Disciplinas.codDisciplina=$codDisciplina
				AND Turmas.codTurma=$codTurma";

$rsCabecalho = mysql_query($sqlCabecalho);

$sqlAlunos = "SELECT Alunos.codAluno, Alunos.nomeAluno, Alunos.rg, Alunos.RM, Matriculas.nChamada, Matriculas.codMatricula, Matriculas.status FROM Alunos
			INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno
			WHERE Matriculas.codTurma=$codTurma
			ORDER BY nChamada" ;

$rsAlunos = mysql_query($sqlAlunos);

$sqlEncontros = "SELECT *, date_format(data,'%d') as dia, date_format(data, '%d/%m') as dataf FROM Encontros 
				WHERE codTurma=$codTurma 
				AND codDisciplina=$codDisciplina
				AND month(data)=$mes
				ORDER BY data";

$rsEncontros = mysql_query($sqlEncontros);




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
		<td colspan="2" rowspan="5"><img src="logo_diario.png" style="width: 220px;"></td>
		<td colspan="45" class="centro maior">CURSO: <?php echo ( mysql_result($rsCabecalho, 0, "habilitacao") ) ?></td>
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
		<td colspan="15">MES:</td>
		<td colspan="19">PERÍODO:</td>
		<td colspan="11">PROFESSOR:</td>
	</tr>
	<tr>
		<td colspan="15" class="centro maior"><?php echo $mes_extenso ?></td>
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
		<td class="centro bold">TF</td>

		<?php
			// cabeçalho de datas das aulas
			$qtde_aulas = 0;
			while ($row = mysql_fetch_array($rsEncontros)) {
				for ($i=0; $i < $row["qtdeAulas"] ; $i++) { 
					echo "<td style='max-width: 9px; vertical-align: center;'><span class='vertical'>";
					echo $row["dia"];
					echo "</span></td>";
					$qtde_aulas++;
				}
				
			}
			//preencher as celulas vazias
			while ($qtde_aulas<41) {
				echo "<td style='max-width: 9px; vertical-align: bottom;'><span class='vertical'></span></td>";
				$qtde_aulas++;
			}

		?>

		<td class="centro bold">Nº</td>
		<td class="centro bold">Total</td>
	</tr>

<?php
$qtde_aluno = 0;
while ($row = mysql_fetch_array($rsAlunos)) {
	$qtde_aluno++;
	$codAluno = $row["codAluno"];
	$nChamada = $row["nChamada"];
	$nome = utf8_encode($row["nomeAluno"]);
	$rm = $row["RM"];
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


	$sqlTotalFaltas = "SELECT count(codChamada) as faltas, Encontros.codDisciplina FROM Faltas
						INNER JOIN Aulas ON Aulas.codAula=Faltas.codAula
						INNER JOIN Encontros ON Encontros.codEncontro=Aulas.codEncontro
						INNER JOIN Turmas ON Turmas.codTurma=Encontros.codTurma
						WHERE codAluno=$codAluno
						AND Encontros.codTurma=$codTurma ";

	$rsTotalFaltas = mysql_query($sqlTotalFaltas);
	$totaldefaltas = mysql_result($rsTotalFaltas, 0 , "faltas");
	//se for turma do técnico multiplicar por 1.25
	if ($periodicidade=="semestral") $totaldefaltas = $totaldefaltas*1.25;

	echo "<td>$totaldefaltas</td>";


	//buscar encontros e presenças
	$rsEncontros = mysql_query($sqlEncontros);
	$total_faltas = 0;
	$qtde_aulas = 0;
	while ($rowE = mysql_fetch_array($rsEncontros)) {
		$codEncontro = $rowE["codEncontro"];

		$sqlAulas = "SELECT * FROM Aulas WHERE codEncontro=$codEncontro ";
		$rsAulas = mysql_query($sqlAulas);

		while ($rowA = mysql_fetch_array($rsAulas)) {
			$codAula = $rowA["codAula"];

			$sqlFalta = "SELECT * FROM Faltas WHERE codAula=$codAula AND codAluno=$codAluno";
			$rsFalta = mysql_query($sqlFalta);
			if (mysql_num_rows($rsFalta)>0) {
				echo "<td class='centro'>F</td>";
				$total_faltas++;
			}else{
				echo "<td class='centro'>.</td>";
			}
			$qtde_aulas++;
		}
		
	}

	while ($qtde_aulas<41) {
		echo "<td class='centro'></td>";
		$qtde_aulas++;
	}

	echo "<td class='centro'>$nChamada</td>";
	if ($total_faltas>0){
		echo "<td class='centro'>$total_faltas</td>";
	}else{
		echo "<td class='centro'></td>";
	}
	echo "</tr>";
}

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


<tr><td colspan=47>Legenda: TF=Total de Faltas; CM=Cancelamento de Matrícula; TM=Trancamento de Matrícula; MP=Mudança de Período; DM=Destrancamento de Matrícula; TE=Transferência de Escola; MAC=Matrícula por Avaliação de Competência; PV=Pedido de Vaga; D=Dispensa</td></tr>
</tbody>
</table>
<br class="quebraPagina">
<br class="quebraPagina">


<table class="relatorio espacado">
	<colgroup><col style="width: 34px;">
	<col style="width: 375px;">
	<col style="width: 92px;">
	<col style="width: 34px;">
	<col style="width: 375px;">
	<col style="width: 92px;">
	</colgroup><tbody><tr>
		<td colspan="3" class="centro maior">ATIVIDADES DESENVOLVIDAS</td>
		<td colspan="3" class="centro">OBSERVAÇÕES DO PROFESSOR</td>
	</tr>
	<tr>
		<td class="centro">DATA</td>
		<td class="centro">BASES TECNOLÓGICAS</td>
		<td class="centro">ASSINATURA</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php
		$rsEncontros= mysql_query($sqlEncontros);
		$rsCabecalho = mysql_query($sqlCabecalho);
		$qtde_aulas=0;
		while ($row = mysql_fetch_array($rsEncontros)) {
			echo "<tr><td class='centro' style='height: 3ex;'>";
			echo $row["dataf"];
			echo "<td style='text-overflow: ellipsis;'>";
			echo ( $row["conteudo"] );
			echo "<td>";
			//Melhor tirar, ai já é demais.
			//$assinatura1 = (mysql_result($rsCabecalho, 0, "assinatura"));
			//if ( strlen($assinatura1)>5 ) echo "<img src='../../assinaturas/$assinatura1'>"; 
			//if (mysql_num_rows($rsCabecalho)>1) {
			//	$assinatura2 = (mysql_result($rsCabecalho, 1, "assinatura"));
			//	if ( strlen($assinatura2)>5 ) echo "<img src='../../assinaturas/$assinatura2'>"; 
			//}
			echo "</td><td></td><td></td><td></td></tr>"; 
			$qtde_aulas++;
		}
		$sqlObservacoes = "SELECT *, date_format(data, '%d/%m') as dataf  FROM ObservacoesDiarios WHERE 
							codDisciplina=$codDisciplina
							AND codTurma=$codTurma
							AND mes=$mes";


		$rsObservacoes = mysql_query($sqlObservacoes);
		echo "<tr><td></td><td></td><td></td>";
		echo "<td colspan=3 class=centro>OBSERVAÇÕES DO COORDENADOR</td></tr>";	
		while ($row = mysql_fetch_array($rsObservacoes)){
			echo "<tr><td></td><td></td><td></td>";
			echo "<td class='centro' style='height: 3ex;'>";
			echo $row["dataf"];
			echo "</td><td>";
			echo $row["observacao"];
			echo "</td><td></td></tr>"; 
			$qtde_aulas++;
		}
		while($qtde_aulas<35){
			echo "<tr><td class='centro' style='height: 3ex;'><td style='text-overflow: ellipsis;'></td><td></td><td></td><td></td><td></td></tr>"; 
			$qtde_aulas++;
		}

	?>
	</tr>
</tbody></table>
<br><br>
___________________________<br>
Visto do Coordenador 

</body></html>
