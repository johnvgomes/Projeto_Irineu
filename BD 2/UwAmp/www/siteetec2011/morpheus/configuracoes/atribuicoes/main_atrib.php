
	<?php 
include '../../conexao/conn.php';
$codDisciplina = $_GET["materia"];
$turma = $_GET["turma"];
$codEtapa = $_GET["codetapa"];
$modulo = substr($turma, 0, 1);
$serie = substr($turma, 1, 1);


$rsCurso = mysql_query("SELECT * FROM Series WHERE serie='$serie'");
$codCurso = mysql_result($rsCurso, 0, "codCurso");
$result = mysql_query ( "select * FROM Disciplinas WHERE codDisciplina=$codDisciplina");
$disciplina = mysql_result($result, 0, "disciplina");
$sigla = mysql_result($result, 0, "sigla");

$serie = substr($turma, 1, 2);
$result = mysql_query ( "select codSerie FROM Series WHERE serie='$serie'");
$row = mysql_fetch_row($result);
$codSerie = $row[0];

?>
	
	<link type="text/css" href="../../jquery/css/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="../../jquery/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>

	<script>
	$(function() {
		$("#atribuidas").load("atribuidas.php?codDisciplina=<?php echo $codDisciplina?>&codSerie=<?php echo $codSerie?>&codEtapa=<?php echo $codEtapa?>");
		
		function log( message ) {
			$( "<div/>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}
		$( "#prof" ).autocomplete({
			
			source: "get_professores.php",
			select: function( event, ui ) {
				
				$.post('atribuir_disciplina.php',{
							codDisciplina:<?php echo $codDisciplina?>, 
							codProfessor:ui.item.id,
							codSerie:<?php echo $codSerie?>,
							codEtapa:<?php echo $codEtapa?>
							},
				function(result){
					if (result.success){
						log( ui.item ?
								"Selecionado: " + ui.item.value + " cod " + ui.item.id :
								"Nothing selected, input was " + this.value );	// reload the user data
						$("#atribuidas").load("atribuidas.php?codDisciplina=<?php echo $codDisciplina?>&codSerie=<?php echo $codSerie?>&codEtapa=<?php echo $codEtapa?>");
						$('#table_professores').datagrid('reload');
					} else {
						$.messager.show({	// show error message
							title: 'Erro',
							msg: result.msg
						});
					}
				},'json');
			}
		});

		
	});
	</script>


<div class="ui-widget" style="font-size:14">
Disciplina: <?php echo $sigla . " - " . $disciplina . " - ".  $turma?><br><br>
	<label for="prof">Adicionar professor: </label>
	<input id="prof" />
</div>

<div id="atribuidas"></div>



