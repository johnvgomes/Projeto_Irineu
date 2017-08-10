<html><head>
		<meta charset="utf-8">
		<title>ETECIA - Ata do Conselho Final</title>
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
.quebraPagina {
	page-break-after: always;
}
</style>

<table class="relatorio">
	<tr>
		<td colspan="2" rowspan="3" style="border:0px;"><img src="logoPaulaSouza.png" style="width: 300px;"></td>
		<td colspan="45" style="background-color:#DEDEDE;" class="centro maior">ATA DE REUNIÃO DO CONSELHO DE CLASSE FINAL - <?php echo mysql_result($rsCabecalho, 0, "etapa"); ?></td>
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
				$dia = extenso(2);
				$mes = mes_extenso(date("m"));
				$ano = extenso(date("Y"));
				echo "$pronome $dia de $mes de $ano realizou-se a reunião do Conselho de Classe Final da classe acima indicada, com a presença do diretor da ETEC, Coordenador de Área, Professores e Representantes de alunos, para decidir sobre promoção ou retenção dos alunos. No início da reunião foram apresentados os índices de desempenho da classe.";
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

		<td class='centro bold' style='width:200px'>Resumo das discussões sobre a situação escolar do aluno</td>
		<td class='centro bold' style='width:200px'>RESULTADO FINAL</td>
	
	</tr>";

echo $cabecalho;

$qtde_aluno = 0;
$situacao_final = "";
while ($row = mysql_fetch_array($rsAlunos)) {

	if ($qtde_aluno==25){
		echo "</table><br class='quebraPagina'><table class='relatorio'>";
		echo $cabecalho;
	}

	$qtde_aluno++;
	$codAluno = $row["codAluno"];
	$nChamada = $row["nChamada"];
	$nome = utf8_encode($row["nomeAluno"]);
	$rm = $row["RM"];
	$codMatricula = $row["codMatricula"];
	$status = $row["status"];
	echo "<tr style='height:20px;'><td class='centro'>$nChamada</td>";
	echo "<td width='300px'>$nome</td>";
	echo "<td>$rm</td>";

	
	//verificar se a matricula está ativiva ou houve cancelamento, transferencia, etc.
	if($status!="MA"){
		for ($i=0; $i<($qtde_disciplinas+3); $i++){
			echo "<td class='centro'>$status</td>";
		}
		echo "<td></td><td></td><td></td><td></td><td>$status</td>";	
		continue;
	}

	//se for do curso de informática pegar as faltas do sistema de diário eletrônico
		$sqlTotalFaltas = "SELECT count(codChamada) as faltas, Encontros.codDisciplina FROM Faltas
							INNER JOIN Aulas ON Aulas.codAula=Faltas.codAula
							INNER JOIN Encontros ON Encontros.codEncontro=Aulas.codEncontro
							INNER JOIN Turmas ON Turmas.codTurma=Encontros.codTurma
							WHERE codAluno=$codAluno
							AND Encontros.codTurma=$codTurma ";

		$rsTotalFaltas = mysql_query($sqlTotalFaltas);
		$total_faltas = mysql_result($rsTotalFaltas, 0 , "faltas");
		$total_faltas = $total_faltas * 1.25;
		$total_faltas = number_format($total_faltas, 2);

	$rsAulasDadas = mysql_query($sqlAulasDadas);
	$total_aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");

	 $total_aulas_dadas = 500; //forçar aulas dadas a pedido do Fausto
	//if ($total_faltas>$total_aulas_dadas) $total_faltas = $total_aulas_dadas;
	
	$freq_p = (1 - ($total_faltas / $total_aulas_dadas) )* 100; 	
	$freq_porc = number_format($freq_p, 2);
	$color = ($freq_porc<75) ? "red" : "" ;
	$total_aulas_dadas = number_format($total_aulas_dadas,2);

	echo "<td class='centro'>$total_aulas_dadas</td>";
	echo "<td class='centro'>$total_faltas</td>";
	echo "<td class='centro $color'>$freq_porc</td>";

	//buscar disciplinas e menções
	$rsDisciplina = mysql_query($sqlDisciplinas);
	$tem_I = false;
	$PP_count=0;
	while ($rowD = mysql_fetch_array($rsDisciplina)) {
		$codDisciplina = $rowD["codDisciplina"];
		$sigla = $rowD["sigla"];

		//Verificar se o aluno é dispensado da disciplina
		$sqlDispensa = "SELECT * FROM Dispensas WHERE codMatricula=$codMatricula AND codDisciplina=$codDisciplina";
		$rsDispensa = mysql_query($sqlDispensa);
		if (mysql_num_rows($rsDispensa)>0) {
			echo "<td class='centro'>D</td>";
			continue;
		}


		$sqlMencao = "SELECT * FROM Mencoes WHERE codDisciplina=$codDisciplina AND codAluno=$codAluno AND codEtapa=$codEtapa";
		$rsMencao = mysql_query($sqlMencao);
		$mencao = mysql_result($rsMencao, 0, "mencaoFinal");
		$color= "";
		if ($mencao=="I"){
			if ($PP_count==0) $situacao_final = "Promovido com PP em "; else $situacao_final.=", ";
			$situacao_final .= $sigla;
			$color = 'red';
			$tem_I = true;
			$PP_count++;
		}

		echo "<td class='centro $color'>$mencao</td>";
	}

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

	echo "<td class='centro'>$pp1</td>";
	echo "<td class='centro'>$pp2</td>";
	echo "<td class='centro'>$pp3</td>";

	//Resumo das discuções
	$sqlResumo = "SELECT * FROM DecisoesConselho WHERE codMatricula=$codMatricula";
  	$rsResumo = mysql_query($sqlResumo);
  	$resumo = mysql_result($rsResumo, 0, "resumo"); 	
	echo "<td>$resumo</td>";

	 //Definir situação final do aluno
	 $sqlArt52 = "SELECT * FROM SituacaoFinal WHERE codMatricula=$codMatricula";
	 $rsArt52 = mysql_query($sqlArt52);

	 	if($freq_p<75){
			$situacao_final="Retido por falta";
		}else{
		 	if(!$tem_I){ 
		 		$situacao_final="Promovido";
		 	}else{
		 		if ($PP_count > 3) $situacao_final = "Retido";
		 	}
	 	}
	 	//Situação gravada no banco precede qualquer outra
	 	if(mysql_num_rows($rsArt52)>0){
	 		$situacao_final=mysql_result($rsArt52, 0, "situacao");
	 	}

	 	if ($status!="MA") $situacao_final = $status;

	echo "<td>$situacao_final</td>";
	
	echo "</tr>";
}


?>
</tbody>
</table>
<p style="font-size:9px;">Nada mais havendo a ser tratado, a reunião foi encerrada e eu Fausto Henrique dos Santos Lima / Diretor de Serviços Acadêmicos, lavrei a presente ata que vai por mim assinada e por Ana Lucia Calaça / Diretora de Unidade e demais membros presentes.
<?php echo " São Paulo, 2 de $mes de ".date("Y")."</p>"; // forçando dia 19 a pedido do Fausto ?> 

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
			
			echo "<tr style='height:16px;'>";
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
<div style='font-size:8pt;margin-top:50px;float:left;margin-left:30px;border-top:solid 1px;width:140px;white-space: nowrap ;text-align:center;'> Representante(s) Dicente(s)</div> 
<div style='font-size:8pt;margin-top:50px;float:left;margin-left:30px;border-top:solid 1px;width:140px;white-space: nowrap ;text-align:center;'> Diretor de Serviços Acadêmicos<br>Fausto Henrique dos S. Lima</div> 
<div style='font-size:8pt;margin-top:50px;float:left;margin-left:30px;border-top:solid 1px;width:140px;white-space: nowrap ;text-align:center;'> Coordenadora Pedagógica<br>Solange Casella Albuquerque</div> 
<div style='font-size:8pt;margin-top:70px;float:left;margin-left:30px;border-top:solid 1px;width:150px;white-space: nowrap ;text-align:center;'> Coordenador de Área<br><?php echo $coordenador ?></div> 
<div style='font-size:8pt;margin-top:70px;float:left;margin-left:30px;border-top:solid 1px;width:150px;white-space: nowrap ;text-align:center;'> Diretora da Escola<br>Ana Lucia Calaça</div> 

</body></html>
