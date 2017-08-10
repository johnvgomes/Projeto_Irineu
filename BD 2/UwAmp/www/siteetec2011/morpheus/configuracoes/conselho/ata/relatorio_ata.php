<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Ata do Conselho Intermediário</title>
		<link rel="stylesheet" href="bootstrap.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="../../../jquery/jquery-1.6.min.js"></script>
<?php

//verificar se usuário está logado e se tem permissões
session_name('jcLogin');
session_start();

include '../../../conexao/conn.php';
include "funcoes.php";

if(!$_SESSION['id']){
	echo "Você não tem autorização para acessar essa página";
	exit();
}

$codTurma = $_GET["codTurma"];

$sqlCabecalho = "SELECT Series.codSerie, Etapas.etapa, Etapas.codEtapa, Cursos.habilitacao, Cursos.codCurso, Turmas.modulo, concat(Turmas.modulo, Series.serie) as turma, Periodos.descricaoPeriodo FROM Turmas
					INNER JOIN Series ON Series.codSerie=Turmas.codSerie
					INNER JOIN Cursos ON Cursos.codCurso=Series.codCurso
					INNER JOIN Periodos ON Periodos.codPeriodo=Series.codPeriodo
					INNER JOIN Etapas ON Turmas.codEtapa=Etapas.codEtapa
					WHERE Turmas.codTurma=$codTurma";

$rsCabecalho = mysql_query($sqlCabecalho);

$sqlAlunos = "SELECT Alunos.codAluno, Alunos.nomeAluno, Alunos.RM, Matriculas.nChamada, Matriculas.codMatricula, Matriculas.status FROM Alunos
			INNER JOIN Matriculas ON Alunos.codAluno=Matriculas.codAluno
			WHERE Matriculas.codTurma=$codTurma
			ORDER BY nChamada" ;

$rsAlunos = mysql_query($sqlAlunos);

$codCurso = mysql_result($rsCabecalho, 0, "codCurso");
$modulo = mysql_result($rsCabecalho, 0, "modulo");
$codEtapa = mysql_result($rsCabecalho, 0, "codEtapa");
$codSerie = mysql_result($rsCabecalho, 0, "codSerie");

//verificar se o curso é semestral ou anual
$rsPeriodicidade = mysql_query("SELECT * FROM Etapas WHERE codEtapa=$codEtapa");
if (mysql_result($rsPeriodicidade, 0, "semestre")==0) $periodicidade="anual"; else $periodicidade="semestral"; 

$sqlDisciplinas = "SELECT * FROM Disciplinas WHERE codCurso=$codCurso AND modulo=$modulo";
$rsDisciplina = mysql_query($sqlDisciplinas);

$qtde_disciplinas = mysql_num_rows($rsDisciplina);

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
	<tr>
		<td colspan="2" rowspan="3" style="border:0px;"><img src="logo_relatorio.png" style="width: 220px;"></td>
		<td colspan="45" style="background-color:#DEDEDE;" class="centro maior">ATA DE REUNIÃO DO CONSELHO DE CLASSE INTERMEDIÁRIO - <?php echo mysql_result($rsCabecalho, 0, "etapa"); ?></td>
	</tr>
	<tr>
		<td colspan="<?php echo ($qtde_disciplinas+4)?>">CURSO:</td>
		<td colspan="3">CLASSE:</td>
		<td colspan="2">PERIODO:</td>
	</tr>

	<tr>
		<td colspan="<?php echo ($qtde_disciplinas+4)?>" class="centro maior"><?php echo mysql_result($rsCabecalho, 0, "habilitacao")?></td>
		<td colspan="3" class="centro maior"><?php echo mysql_result($rsCabecalho, 0, "turma")?></td>
		<td colspan="2" class="centro maior"><?php echo ( mysql_result($rsCabecalho, 0, "descricaoPeriodo") )?></td>
	</tr>
	<tr >
		<td colspan="47" style="border:0px;">
			<?php
				$pronome  = (date("d")>1) ? "Aos" : "Ao" ;
				//$dia = extenso(date("d"));
				$dia = extenso(12);
				$mes = mes_extenso(date("m"));
				$ano = extenso(date("Y"));
				echo "$pronome $dia de $mes de $ano realizou-se a reunião do Conselho de Classe Intermediário da classe acima indicada, com a presença do diretor da ETEC, Coordenador(a) do Curso, Professores e Representantes de alunos, para analisar o desempenho dos alunos e propor medidas de natureza didático-pedagógica para a recuperação dos alunos. Iniciando a reunião foram apresentados os índices de desempenho da classe";

			?>
		</td> 
	</tr>
	<tr>
		<td colspan="3" style="border:0px;"></td>
		<td colspan="3" class="centro">Frequência</td>
		<td class="centro" colspan="<?php echo $qtde_disciplinas?>">Menções / Componentes Curriculares</td>
	</tr>

<?php

$cabecalho = "<tr style='height:70px;'>
		<td class='centro bold' style='height:20px;'>Nº</td>
		<td class='centro bold'>NOME DO ALUNO</td>
		<td class='centro bold'>RM</td>
		<td class='centro bold vertical' style='width:25px;max-width:25px;'>AULAS DADAS</td>
		<td class='centro bold vertical' style='width:25px;'>FALTAS</td>
		<td class='centro bold vertical' style='width:25px;max-width:25px;'>%FREQ.</td>";

			// cabeçalho de disciplinas
			while ($row = mysql_fetch_array($rsDisciplina)) {
				$sigla = $row['sigla'];
				$cabecalho.= "<td style='width:15px; vertical-align: center;' class='vertical'>$sigla</td>";
			}

$cabecalho.= "<td class='centro bold' style='max-width:100px'>Progressão (ões) Parcial (ais) Pendente(s) 1o Módulo/Série</td>
		<td class='centro bold' style='max-width:100px'>Progressão (ões) Parcial (ais) Pendente(s) 2o Módulo/Série</td>
		<td class='centro bold' style='max-width:100px'>Progressão (ões) Parcial (ais) Pendente(s) 3o Módulo/Série</td>

		<td class='centro bold' style='width:200px'>Diagnóstico</td>
		<td class='centro bold' style='width:200px'>Providências da escola para recuperar as aprendizagens do aluno(a)</td>
	
	</tr>";

echo $cabecalho;

$qtde_aluno = 0;
while ($row = mysql_fetch_array($rsAlunos)) {

	if ($qtde_aluno==28){
		echo "</table><div class='quebraPagina'></div><table class='relatorio'>";
		echo $cabecalho;

	}

	$qtde_aluno++;
	$codAluno = $row["codAluno"];
	$nChamada = $row["nChamada"];
	$nome = utf8_encode($row["nomeAluno"]);
	$rm = $row["RM"];
	$codMatricula = $row["codMatricula"];
	$status = $row["status"];

	//Buscas as PPs do aluno no modulo 1
	$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
				INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
				INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
				INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
				WHERE Alunos.codAluno=$codAluno
				AND pendente=1
				AND modulo=1";
	$rsPP = mysql_query($sqlPP);
	$pp1 = "";
	$cont=0;
	while ($r=mysql_fetch_array($rsPP)){
		if ($cont>0) $pp1 .=", ";
		$pp1 .= $r["sigla"];
		$cont++;
	}
	//Buscas as PPs do aluno no modulo 2
	$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
				INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
				INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
				INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
				WHERE Alunos.codAluno=$codAluno
				AND pendente=1
				AND modulo=2";
	$rsPP = mysql_query($sqlPP);
	$pp2 = "";
	$cont=0;
	while ($r=mysql_fetch_array($rsPP)){
		if ($cont>0) $pp2 .=", ";
		$pp2 .= $r["sigla"];
		$cont++;
	}
	//Buscas as PPs do aluno no modulo 3
	$sqlPP = "SELECT Disciplinas.sigla FROM ProgressoesParciais
				INNER JOIN Disciplinas ON Disciplinas.codDisciplina=ProgressoesParciais.codDisciplina
				INNER JOIN Matriculas ON Matriculas.codMatricula=ProgressoesParciais.codMatricula
				INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno
				WHERE Alunos.codAluno=$codAluno
				AND pendente=1
				AND modulo=3";
	$rsPP = mysql_query($sqlPP);
	$pp3 = "";
	$cont=0;
	while ($r=mysql_fetch_array($rsPP)){
		if ($cont>0) $pp3 .=", ";
		$pp3 .= $r["sigla"];
		$cont++;
	}

	echo "<tr style='height:20px;'><td class='centro'>$nChamada</td>";
	echo "<td width='300px'>$nome</td>";
	echo "<td>$rm</td>";

	
	//verificar se a matricula está ativa ou houve cancelamento, transferencia, etc.
	if($status!="MA"){
		for ($i=0; $i<($qtde_disciplinas+3); $i++){
			echo "<td class='centro'>$status</td>";
		}
		echo "<td></td><td></td><td></td><td></td><td></td>";	
		continue;
	}

	//Definir criterio de disciplinas em que o aluno foi dispensado
	$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula";
	$rsDispensa = mysql_query($sqlDispensa);
	$where = "";
	while ($rDispensa = mysql_fetch_array($rsDispensa)){
		$where .= " AND Encontros.codDisciplina<>".$rDispensa["codDisciplina"];
	}

	$sqlTotalFaltas = "SELECT count(codChamada) as faltas, Encontros.codDisciplina FROM Faltas
						INNER JOIN Aulas ON Aulas.codAula=Faltas.codAula
						INNER JOIN Encontros ON Encontros.codEncontro=Aulas.codEncontro
						INNER JOIN Turmas ON Turmas.codTurma=Encontros.codTurma
						WHERE codAluno=$codAluno
						AND Encontros.codTurma=$codTurma 
						$where";

	$rsTotalFaltas = mysql_query($sqlTotalFaltas);
	$totaldefaltas = mysql_result($rsTotalFaltas, 0 , "faltas");

	//se for turma do técnico multiplicar por 1.25
	if ($periodicidade=="semestral") $totaldefaltas = $totaldefaltas*1.25;
		
	$totaldefaltas = number_format($totaldefaltas, 2);

	//somar as aulas em que o aluno não foi dispensado
	$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula";
	$rsDispensa = mysql_query($sqlDispensa);
	$where = "";
	while ($rDispensa = mysql_fetch_array($rsDispensa)){
		$where .= " AND codDisciplina<>".$rDispensa["codDisciplina"];
	}
	$sqlAulasDadas = "SELECT SUM(qtdeAulas) as aulasDadas FROM Encontros WHERE codTurma=$codTurma $where"; //se for informática busca do diário
	//echo $sqlAulasDadas;
	$rsAulasDadas = mysql_query($sqlAulasDadas);
	$total_aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");
	//se for turma do técnico multiplicar por 1.25
	if ($periodicidade=="semestral") $total_aulas_dadas = $total_aulas_dadas*1.25;
	$total_aulas_dadas = number_format($total_aulas_dadas,2);
	if ($totaldefaltas>$total_aulas_dadas) $totaldefaltas = $total_aulas_dadas;

	/* AQUELA FORÇADA BÁSICA FEITA 10 MINUTOS ANTES DO CONSELHO COMEÇAR
	   PORQUE OS PROFESSORES NÃO PREENCHERAM O DIÁRIO */
	   $total_aulas_dadas = 500; //Demais turmas
	   //if ( $codTurma == 84) $total_aulas_dadas = 333; //1C
	   //if ( $codTurma == 87) $total_aulas_dadas = 351; //2C
	   //if ( $codTurma == 85) $total_aulas_dadas = 360; //1D
	   //if ( $codTurma == 88) $total_aulas_dadas = 369; //1C

	
	$freq_p = (1 - ($totaldefaltas / $total_aulas_dadas) )* 100; 	
	$freq_porc = number_format($freq_p, 2);
	$color = ($freq_porc<75) ? "red" : "" ;

	echo "<td class='centro'>$total_aulas_dadas</td>";
	echo "<td class='centro'>$totaldefaltas</td>";
	echo "<td class='centro $color'>$freq_porc</td>";

	//buscar disciplinas e menções
	$rsDisciplina = mysql_query($sqlDisciplinas);
	$tem_I = false;
	while ($rowD = mysql_fetch_array($rsDisciplina)) {
		$codDisciplina = $rowD["codDisciplina"];

		//Verificar se o aluno é dispensado da disciplina
		$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula AND codDisciplina=$codDisciplina";
		$rsDispensa = mysql_query($sqlDispensa);
		if (mysql_num_rows($rsDispensa)>0) {
			echo "<td class='centro'>D</td>";
			continue;
		}


		$sqlMencao = "SELECT * FROM Mencoes WHERE codDisciplina=$codDisciplina AND codAluno=$codAluno AND codEtapa=$codEtapa";
		$rsMencao = mysql_query($sqlMencao);
		$mencao = mysql_result($rsMencao, 0, "mencaoIntermediaria");
		$color= "";
		if ($mencao=="I"){
			$color = 'red';
			$tem_I = true;
		}
		echo "<td class='centro $color'>$mencao</td>";
	}

	echo "<td>$pp1</td><td>$pp2</td><td>$pp3</td>";
	if ($tem_I){
		$sqlDificuldade = "SELECT DISTINCT Dificuldades.codDificuldade, Dificuldades.descricaoDificuldade FROM Deliberacao11Dificuldade 
							INNER JOIN Dificuldades ON Dificuldades.codDificuldade=Deliberacao11Dificuldade.codDificuldade
							WHERE codMatricula=$codMatricula";
		$rsDificuldade = mysql_query($sqlDificuldade);
		$sqlProvidencia = "SELECT DISTINCT Providencias.codProvidencia, Providencias.descricaoProvidencia FROM Deliberacao11Providencia 
						INNER JOIN Providencias ON Providencias.codProvidencia=Deliberacao11Providencia.codProvidencia
						WHERE codMatricula=$codMatricula";
		$rsProvidencia = mysql_query($sqlProvidencia);

		echo "<td>";
			$c = 0;
			while ($rowd = mysql_fetch_array($rsDificuldade)){
				echo ($c>0) ? ", " : "" ;
				echo ($rowd["codDificuldade"]);
				$c++;
			}
		echo "</td>";

		echo "<td>";
			$c = 0;
			while ($rowd = mysql_fetch_array($rsProvidencia)){
				echo ($c>0) ? ", " : "" ;
				echo ($rowd["codProvidencia"]);
				$c++;
			}
		echo "</td>";
	}else{
		echo "<td></td><td></td>";
	}
	
		

	echo "</tr>";
}


?>
</tbody>
</table>
<p style="font-size:9px;">Nada mais havendo a ser tratado, a reunião foi encerrada e eu Fausto Henrique dos Santos Lima / Diretor de Serviços Acadêmicos, lavrei a presente ata que vai por mim assinada e por Ana Lucia Calaça / Diretora de Unidade e demais membros presentes.
<?php echo " São Paulo, $dia de $mes de ".date("Y")."</p>"; // forçando dia 06 a pedido do Fausto ?> 

<table class="relatorio" style="float:left">
	<tr>
		<td colspan="2" class="centro maior">Componentes Curriculares</td>
		<td class="centro maior">Nomes dos Professores</td>
		<td class="centro maior" style="width:200px">Assinaturas</td>
	</tr>
	<?php

		$rsDisciplina = mysql_query($sqlDisciplinas);
		while ($row = mysql_fetch_array($rsDisciplina)){
			$codDisciplina = $row["codDisciplina"];
			$sqlProfessores = "SELECT DISTINCT Professores.nomeProfessor FROM Professores 
						INNER JOIN Atribuicoes ON Atribuicoes.codProfessor=Professores.codProfessor
						INNER JOIN Series ON Series.codSerie=Atribuicoes.codSerie
						INNER JOIN Turmas ON Turmas.codSerie=Series.codSerie
						WHERE codDisciplina=$codDisciplina AND Atribuicoes.codEtapa=$codEtapa AND Series.codSerie=$codSerie";
			$rsProfessores = mysql_query($sqlProfessores);
			
			echo "<tr style='height:18px;'>";
			echo "<td>".$row["numeroPlanoDeCurso"]."</td>";
			echo "<td>".$row["disciplina"]."</td>";
		
			echo "<td>";
			$c = 0;
			while ($rp = mysql_fetch_array($rsProfessores)){
				echo ($c>0)?" e ":"";
				echo $rp["nomeProfessor"];
				$c++;
			} 
			echo "</td>";
			echo "<td></td>";
			echo "</tr>";
		}

		$sqlCoordenador = "SELECT Professores.nomeProfessor FROM Professores
							INNER JOIN Cursos ON Cursos.codCoordenador=Professores.codProfessor
							WHERE codCurso=$codCurso ";
		$rsCoordenador = mysql_query($sqlCoordenador);
		$coordenador = mysql_result($rsCoordenador, 0, "nomeProfessor");

	?>
</table>
<div style='font-size:8pt;margin-top:50px;float:left;margin-left:30px;border-top:solid 1px;width:150px;white-space: nowrap ;text-align:center;'> Diretor de Serviços Acadêmicos<br>Fausto Henrique dos Santos Lima</div> 
<div style='font-size:8pt;margin-top:50px;float:left;margin-left:30px;border-top:solid 1px;width:150px;white-space: nowrap ;text-align:center;'> Coordenadora Pedagógica<br>Solange Casella Albuquerque</div> 
<div style='font-size:8pt;margin-top:70px;float:left;margin-left:30px;border-top:solid 1px;width:150px;white-space: nowrap ;text-align:center;'> Coordenador(a) do Curso<br><?php echo $coordenador ?></div> 
<div style='font-size:8pt;margin-top:70px;float:left;margin-left:30px;border-top:solid 1px;width:150px;white-space: nowrap ;text-align:center;'> Diretora da Escola<br>Ana Lucia Calaça</div> 

</body></html>
