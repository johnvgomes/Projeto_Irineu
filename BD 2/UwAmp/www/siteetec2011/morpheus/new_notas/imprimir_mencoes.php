<?php 
include '../conexao/conn.php';
$codDisciplina = $_GET["codDisciplina"];
$codTurma = $_GET["codTurma"];
$nomeTabela = "tmpMencoesDisciplina" . $codDisciplina . "_Turma" . $codTurma;

//consultar as avaliações da disciplina selecionada
$rsAvaliacoes = mysql_query("select * from Avaliacoes WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina");

//apagar a tabela para criar uma atualizada
mysql_query("DROP TABLE $nomeTabela");
//criar a tabela com dados para essa disciplina
$sql = "CREATE TABLE $nomeTabela (";
$sql .= "codMencoesDisciplina int auto_increment not null primary key, ";
$sql .= "numero int, ";
$sql .= "nomeAluno varchar (300), ";
$sql .= "obs varchar (10), ";
$sql .= "curso varchar (100), ";
$sql .= "disciplina varchar (100), ";
$sql .= "professores varchar (200), ";

$cont = 0;
for ($i=0;$i<10;$i++){
	$sql .= "MencaoAvaliacao$cont varchar (2), ";
	$sql .= "DescricaoAvaliacao$cont varchar (300), ";
	$sql .= "TipoAvaliacao$cont varchar (100), ";
	$sql .= "DataAvaliacao$cont varchar (20), ";
	$sql .= "SiglaAvaliacao$cont varchar (20), ";
	$cont++;
}
$sql .= "mencaoIntermediaria varchar (10), ";
$sql .= "mencaoFinal varchar (10), ";

$sql .= "serie_modulo varchar (10), ";
$sql .= "semestre_ano varchar (50) ";
$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci";

mysql_query($sql);
//echo $sql."<br><br>".mysql_error()."</hr>";

//preecher tabela com os dados da disciplina
$rsDisciplina = mysql_query("select Disciplinas.disciplina, Cursos.habilitacao FROM Disciplinas INNER JOIN Cursos ON Disciplinas.codCurso=Cursos.codCurso WHERE codDisciplina=$codDisciplina");
$rsAvaliacoes = mysql_query("select * from Avaliacoes WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina");
$rsAlunos = mysql_query("select Matriculas.*, Alunos.nomeAluno, Alunos.codAluno from Matriculas INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno WHERE Matriculas.codTurma=$codTurma ORDER BY nomeAluno");
$rsTurma = mysql_query("select Turmas.modulo, Series.codSerie, Series.serie, Etapas.semestre, Etapas.ano from Turmas INNER JOIN Series ON Turmas.codSerie=Series.codSerie INNER JOIN Etapas ON Turmas.codEtapa=Etapas.codEtapa WHERE codTurma=$codTurma");
$codSerie = mysql_result($rsTurma, 0, "codSerie");
$rsProfessores = mysql_query("select Atribuicoes.codAtribuicao, nomeProfessor FROM Atribuicoes INNER JOIN Professores ON Atribuicoes.codProfessor=Professores.codProfessor WHERE codDisciplina=$codDisciplina AND codSerie=$codSerie");
$professores = "";
$qtde_prof = mysql_num_rows($rsProfessores);
while ($row = mysql_fetch_array($rsProfessores)){
	$qtde_prof--;
	$professores .= $row["nomeProfessor"];
	if ($qtde_prof>0) $professores .= " / ";
}
$n=0;
while ($row = mysql_fetch_array($rsAlunos)){
	$n++;
	$rsAvaliacoes = mysql_query("select * from Avaliacoes WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina");
	$codAluno = $row["codAluno"];
	$rsMencoes = mysql_query("select * from Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina");
	if (mysql_num_rows($rsMencoes)>0){
		$mencaoIntermediaria = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
		$mencaoFinal = mysql_result($rsMencoes, 0, "mencaoFinal");
	}else{
		$mencaoIntermediaria = "";
		$mencaoFinal = "";
	}
	$nomeAluno = $row["nomeAluno"];
	$obs = $row["status"];
	if ($obs == "MA") $obs="";
	$curso = mysql_result($rsDisciplina, 0, "habilitacao");
	$disciplina = mysql_result($rsDisciplina, 0, "disciplina");
	$sql = "INSERT INTO $nomeTabela VALUES ( ";
	$sql .= "0, $n, '$nomeAluno', '$obs', '$curso', '$disciplina', '$professores', ";
	for ($i=0;$i<10;$i++){
		$row = mysql_fetch_array($rsAvaliacoes);
		$codAvaliacao = $row["codAvaliacao"];
		$descricao = $row["descricao"];
		$tipo = $row["tipo"];
		$data = $row["data"];
		$sigla = $row["sigla"];
		if ($codAvaliacao!=""){
			$rsMencao = mysql_query("select mencao from MencoesAvaliacoes WHERE codAluno=$codAluno AND codAvaliacao=$codAvaliacao");
			//echo "<br>select mencao from MencoesAvaliacoes WHERE codAluno=$codAluno AND codAvaliacao=$codAvaliacao";
			if (mysql_num_rows($rsMencao)>0) $mencao = mysql_result($rsMencao, 0, "mencao"); else $mencao="";
		}else $mencao="";
		$sql .= "'$mencao' , '$descricao', '$tipo', '$data', '$sigla', ";
	}
	$serie_modulo = mysql_result($rsTurma, 0, "modulo")."º ".mysql_result($rsTurma, 0, "serie");
	$semestre_ano = mysql_result($rsTurma, 0, "semestre")."º /".mysql_result($rsTurma, 0, "ano");
	$sql .= "'$mencaoIntermediaria', '$mencaoFinal', '$serie_modulo', '$semestre_ano' ) ";
	mysql_query($sql);
	//echo $sql."<br><br>";
}

//exibir o relatório
if ($_GET["target"]=="frente"){
	header("location: ../relatorios/relatorio_mencoes.php?codDisciplina=$codDisciplina&codTurma=$codTurma");
}else{
	header("location: ../relatorios/relatorio_mencoes_verso.php?codDisciplina=$codDisciplina&codTurma=$codTurma");
}
	?>

?>