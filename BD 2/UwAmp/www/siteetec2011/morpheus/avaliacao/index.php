<?php

//verificar se usuário está logado e se tem permissões
session_name('jcLogin');
session_start();

if(!$_SESSION['id'] || $_SESSION["tipo"]!="aluno"){
	?>
	<div class="ui-widget">
		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
			<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
			<strong>Acesso Negado: </strong>Você precisa estar logado como aluno para acessar essa página.
			<a href="http://etecia.com.br/morpheus">Fazer Login</a></p>
		</div>
	</div>
	<?php
	
	exit();
}


include "../conexao/conn.php";

// pegar as etapas atuais
	$rsEtapaAtual = mysql_query("SELECT codEtapa FROM Etapas WHERE atual=1 ORDER BY semestre");
	$codEtapaEM = mysql_result($rsEtapaAtual, 0, 0);
	$codEtapa = mysql_result($rsEtapaAtual, 1, 0);

//pegar aluno logado
$codAluno = $_SESSION['id'];

//pegar a ultima matricula do aluno no sistema
	$sqlMatriculas = "SELECT * FROM Matriculas WHERE codAluno=$codAluno ORDER BY codMatricula DESC LIMIT 1";
	$rsMatriculas = mysql_query($sqlMatriculas);
	$codMatricula = mysql_result($rsMatriculas, 0, "codMatricula");
	$codturma = mysql_result($rsMatriculas, 0, "codTurma");


$sqlAluno = "SELECT * FROM Alunos WHERE codAluno = $codAluno  ";
$rsAluno = mysql_query($sqlAluno);

$sqlMatricula = "SELECT Matriculas.*, Turmas.*, Series.*, Cursos.* FROM Matriculas 
				INNER JOIN Turmas ON Turmas.codTurma=Matriculas.codTurma
				INNER JOIN Series ON Series.codSerie=Turmas.codSerie
				INNER JOIN Cursos ON Series.codCurso=Cursos.codCurso
				WHERE Matriculas.codMatricula = $codMatricula";


$rsMatricula = mysql_query($sqlMatricula);

$codTurma = mysql_result($rsMatricula, 0, "codTurma");
$codCurso = mysql_result($rsMatricula, 0, "codCurso");
$codSerie = mysql_result($rsMatricula, 0, "codSerie");
$modulo = mysql_result($rsMatricula, 0, "modulo");
$curso = mysql_result($rsMatricula, 0, "habilitacao");
$turma = $modulo.mysql_result($rsMatricula, 0, "serie");
$nome = mysql_result($rsAluno, 0, "nomeAluno");

$sqlDisciplinas = "SELECT * FROM Disciplinas
					WHERE codCurso=$codCurso
					AND modulo=$modulo";
$rsDisciplinas = mysql_query($sqlDisciplinas);


?>

<html><head>
<meta charset="utf-8">
<title>ETECIA - Avaliação do Curso</title>
<link type="text/css" href="../includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../jquery/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="style.css">
		
<style type="text/css">
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 20px 50px 40px 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>
	</head>
	<body>
<p class="titulo centro">Avaliação do Curso</p>
<div id="esquerda">
	<div><strong>Curso:</strong> <?php echo utf8_decode($curso); ?></div>
	<div><strong>Aluno:</strong> <?php echo $nome ?></div>
</div>
<div id="direita">
	<div><strong>Turma:</strong> <?php echo $turma; ?></div>
	<div><strong>Status da Avaliação:</strong><div id="progressbar"></div><div id="porcentagem"></div></div>
</div>

<div id="corpo">
	<div id="accordion">
	
	<?php 
		$qtde_disciplinas = 0;
		$qtde_professores = 0;
		while ($row = mysql_fetch_array($rsDisciplinas)){
			$dois_professores = false;
			$qtde_disciplinas++;
			$codDisciplina = $row["codDisciplina"];
			$sqlAtribuicoes = "SELECT Atribuicoes.*, Professores.* FROM Atribuicoes
					INNER JOIN Professores ON Professores.codProfessor=Atribuicoes.codProfessor
					WHERE codDisciplina=$codDisciplina
					AND codEtapa=$codEtapa
					AND codSerie=$codSerie";
			$rsAtribuicoes = mysql_query($sqlAtribuicoes);
			$qtde_professores++;
			$professor1 = mysql_result($rsAtribuicoes, 0, "nomeProfessor");
			$codAtribuicao1 = mysql_result($rsAtribuicoes, 0, "codAtribuicao");
			if(mysql_num_rows($rsAtribuicoes)>1){
				$professor2 = mysql_result($rsAtribuicoes, 1, "nomeProfessor");
				$codAtribuicao2 = mysql_result($rsAtribuicoes, 1, "codAtribuicao");
				$dois_professores = true;
				$qtde_professores++;

			}

		
	?>

			<h3><a href='#'><?php echo $row["disciplina"] ?> </a></h3>
			<div>
				<div class='box'>
					<p><strong>Disciplina</strong></p>
					<div id="p1<?php echo $codDisciplina?>" class="radio_option" pergunta=1 coddisciplina=<?php echo $codDisciplina?>>
						O quê foi ensinado
						<input type="radio" id="p1I<?php echo $codDisciplina?>" name="p1_<?php echo $codDisciplina?>" value=2 >
							<label for="p1I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p1R<?php echo $codDisciplina?>" name="p1_<?php echo $codDisciplina?>" value=4>
							<label for="p1R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p1B<?php echo $codDisciplina?>" name="p1_<?php echo $codDisciplina?>" value=6>
							<label for="p1B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p1MB<?php echo $codDisciplina?>" name="p1_<?php echo $codDisciplina?>" value=8>
							<label for="p1MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div id="p2<?php echo $codDisciplina?>" class="radio_option" pergunta=2 coddisciplina=<?php echo $codDisciplina?>>
						O quê eu aprendi
						<input type="radio" id="p2I<?php echo $codDisciplina?>" name="p2_<?php echo $codDisciplina?>" value=2>
							<label for="p2I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p2R<?php echo $codDisciplina?>" name="p2_<?php echo $codDisciplina?>" value=4>
							<label for="p2R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p2B<?php echo $codDisciplina?>" name="p2_<?php echo $codDisciplina?>" value=6>
							<label for="p2B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p2MB<?php echo $codDisciplina?>" name="p2_<?php echo $codDisciplina?>" value=8>
							<label for="p2MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div id="p3<?php echo $codDisciplina?>" class="radio_option" pergunta=3 coddisciplina=<?php echo $codDisciplina?>>
						Recursos Utilizados
						<input type="radio" id="p3I<?php echo $codDisciplina?>" name="p3<?php echo $codDisciplina?>" value=2>
							<label for="p3I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p3R<?php echo $codDisciplina?>" name="p3<?php echo $codDisciplina?>" value=4>
							<label for="p3R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p3B<?php echo $codDisciplina?>" name="p3<?php echo $codDisciplina?>" value=6>
							<label for="p3B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p3MB<?php echo $codDisciplina?>" name="p3<?php echo $codDisciplina?>" value=8>
							<label for="p3MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div>
						Observações
						<textarea class="observacoes" contexto="disciplina" coddisciplina="<?php echo $codDisciplina?>" rows="6" ></textarea>
					</div>		
				</div>

				<div class="box">
					<p><strong><?php echo $professor1 ?></strong></p>
					<div id="p4<?php echo $codDisciplina?>" class="radio_option" pergunta=4 codatribuicao=<?php echo $codAtribuicao1?>>
						Sabe a Matéria
						<input type="radio" id="p4I<?php echo $codDisciplina?>" name="p4<?php echo $codDisciplina?>" value=2>
							<label for="p4I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p4R<?php echo $codDisciplina?>" name="p4<?php echo $codDisciplina?>" value=4>
							<label for="p4R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p4B<?php echo $codDisciplina?>" name="p4<?php echo $codDisciplina?>" value=6>
							<label for="p4B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p4MB<?php echo $codDisciplina?>" name="p4<?php echo $codDisciplina?>" value=8>
							<label for="p4MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div id="p5<?php echo $codDisciplina?>" class="radio_option" pergunta=5 codatribuicao=<?php echo $codAtribuicao1?>>
						Sabe ensinar
						<input type="radio" id="p5I<?php echo $codDisciplina?>" name="p5<?php echo $codDisciplina?>" value=2>
							<label for="p5I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p5R<?php echo $codDisciplina?>" name="p5<?php echo $codDisciplina?>" value=4>
							<label for="p5R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p5B<?php echo $codDisciplina?>" name="p5<?php echo $codDisciplina?>" value=6>
							<label for="p5B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p5MB<?php echo $codDisciplina?>" name="p5<?php echo $codDisciplina?>" value=8>
							<label for="p5MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div id="p6<?php echo $codDisciplina?>" class="radio_option" pergunta=6 codatribuicao=<?php echo $codAtribuicao1?>>
						Pontualidade e Dedicação
						<input type="radio" id="p6I<?php echo $codDisciplina?>" name="p6<?php echo $codDisciplina?>" value=2>
							<label for="p6I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p6R<?php echo $codDisciplina?>" name="p6<?php echo $codDisciplina?>" value=4>
							<label for="p6R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p6B<?php echo $codDisciplina?>" name="p6<?php echo $codDisciplina?>" value=6>
							<label for="p6B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p6MB<?php echo $codDisciplina?>" name="p6<?php echo $codDisciplina?>" value=8>
							<label for="p6MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div id="p7<?php echo $codDisciplina?>" class="radio_option" pergunta=7 codatribuicao=<?php echo $codAtribuicao1?>>
						Relacionamento com os alunos
						<input type="radio" id="p7I<?php echo $codDisciplina?>" name="p7<?php echo $codDisciplina?>" value=2>
							<label for="p7I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p7R<?php echo $codDisciplina?>" name="p7<?php echo $codDisciplina?>" value=4>
							<label for="p7R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p7B<?php echo $codDisciplina?>" name="p7<?php echo $codDisciplina?>" value=6>
							<label for="p7B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p7MB<?php echo $codDisciplina?>" name="p7<?php echo $codDisciplina?>" value=8>
							<label for="p7MB<?php echo $codDisciplina?>">MB</label>
					</div>
					<div>
						Observações
						<textarea class="observacoes" contexto="professor" codatribuicao="<?php echo $codAtribuicao1?>" rows="4" ></textarea>
					</div>		
				</div>

				<?php if ($dois_professores){ ?>
				<div class="box">
					<p><strong><?php echo $professor2 ?></strong></p>
					<div id="p8?php echo $codDisciplina?>" class="radio_option" pergunta=8 codatribuicao=<?php echo $codAtribuicao2?>>
						Sabe a Matéria
						<input type="radio" id="p8I<?php echo $codDisciplina?>" name="p8<?php echo $codDisciplina?>" value=2>
							<label for="p8I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p8R<?php echo $codDisciplina?>" name="p8<?php echo $codDisciplina?>" value=4>
							<label for="p8R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p8B<?php echo $codDisciplina?>" name="p8<?php echo $codDisciplina?>" value=6>
							<label for="p8B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p8MB<?php echo $codDisciplina?>" name="p8<?php echo $codDisciplina?>" value=8>
							<label for="p8MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div id="p9<?php echo $codDisciplina?>" class="radio_option" pergunta=9 codatribuicao=<?php echo $codAtribuicao2?>>
						Sabe ensinar
						<input type="radio" id="p9I<?php echo $codDisciplina?>" name="p9<?php echo $codDisciplina?>" value=2>
							<label for="p9I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p9R<?php echo $codDisciplina?>" name="p9<?php echo $codDisciplina?>" value=4>
							<label for="p9R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p9B<?php echo $codDisciplina?>" name="p9<?php echo $codDisciplina?>" value=6>
							<label for="p9B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p9MB<?php echo $codDisciplina?>" name="p9<?php echo $codDisciplina?>" value=8>
							<label for="p9MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div id="p10<?php echo $codDisciplina?>" class="radio_option" pergunta=10 codatribuicao=<?php echo $codAtribuicao2?>>
						Pontualidade e Dedicação
						<input type="radio" id="p10I<?php echo $codDisciplina?>" name="p10<?php echo $codDisciplina?>" value=2>
							<label for="p10I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p10R<?php echo $codDisciplina?>" name="p10<?php echo $codDisciplina?>" value=4>
							<label for="p10R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p10B<?php echo $codDisciplina?>" name="p10<?php echo $codDisciplina?>" value=6>
							<label for="p10B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p10MB<?php echo $codDisciplina?>" name="p10<?php echo $codDisciplina?>" value=8>
							<label for="p10MB<?php echo $codDisciplina?>">MB</label>
					</div>	
					<div id="p11<?php echo $codDisciplina?>" class="radio_option" pergunta=11 codatribuicao=<?php echo $codAtribuicao2?>>
						Relacionamento com os alunos
						<input type="radio" id="p11I<?php echo $codDisciplina?>" name="p11<?php echo $codDisciplina?>" value=2>
							<label for="p11I<?php echo $codDisciplina?>">I</label>
						<input type="radio" id="p11R<?php echo $codDisciplina?>" name="p11<?php echo $codDisciplina?>" value=4>
							<label for="p11R<?php echo $codDisciplina?>">R</label>
						<input type="radio" id="p11B<?php echo $codDisciplina?>" name="p11<?php echo $codDisciplina?>" value=6>
							<label for="p11B<?php echo $codDisciplina?>">B</label>
						<input type="radio" id="p11MB<?php echo $codDisciplina?>" name="p11<?php echo $codDisciplina?>" value=8>
							<label for="p11MB<?php echo $codDisciplina?>">MB</label>
					</div>
					<div>
						Observações
						<textarea class="observacoes" contexto="professor" codatribuicao="<?php echo $codAtribuicao2?>" rows="4" ></textarea>
						</div>		
				</div>
				<?php } ?>


			</div>

	<?php
		}

		$total_pontos = ($qtde_disciplinas*3) + ($qtde_professores*4);
		$unidade = 100 / $total_pontos;

	?>
	</div>
	<div><a href="encerrar.php?codmatricula=<?php echo $codMatricula ?>" class="btn btn-primary">Encerrar avaliação</a></div>
	

	<script type="text/javascript">
			$(function(){
				$( ".radio_option" ).buttonset();

				$( '.radio_option').change(function(){
					var pergunta = $(this).attr("pergunta");
					var coddisciplina = $(this).attr("coddisciplina");
					var codatribuicao = $(this).attr("codatribuicao");
					var resposta = 0;
                        
					$(this).children().each(function() {
						if ($(this).is(':checked'))
                      		resposta = $(this).val();
                    });

                
					$.post("gravar_resposta.php", {
						pergunta: pergunta, 
						codturma: <?php echo $codTurma ?>,
						coddisciplina: coddisciplina,
						codaluno: <?php echo $codAluno ?>,
						codatribuicao: codatribuicao,
						resposta: resposta}, function(result){
							var sit = result;

							if (sit==1){
								var value = $( "#progressbar" ).progressbar( "option", "value" );
								value = value + <?php echo $unidade ?>;
								$( "#progressbar").progressbar( "option", "value", value );
								$( "#porcentagem").html(Math.round(value) + "%");

								if (value >= 100 ) {
									alert("Você completou a avaliação.");
									window.open("encerrar.php?codmatricula=<?php echo $codMatricula ?>");
									
								} 

							}
							
						})

			        .error(function() { alert("Erro ao gravar resposta. Banco de Dados Indisponível"); })

				});

				$( '.observacoes').change(function(){
					var coddisciplina = $(this).attr("coddisciplina");
					var codatribuicao = $(this).attr("codatribuicao");
					var contexto = $(this).attr("contexto");

					var obs = $(this).val();
					                     
					$.post("gravar_resposta.php", {
						codturma: <?php echo $codTurma ?>,
						coddisciplina: coddisciplina,
						codaluno: <?php echo $codAluno ?>,
						codatribuicao: codatribuicao,
						contexto: contexto,
						tipo: 'obs',
						obs: obs})
			        .error(function() { alert("Erro ao gravar Observação. Banco de Dados Indisponível"); })		

				});


				// Accordion
				$("#accordion").accordion({ header: "h3", autoHeight: false, navigation: true });
	
				// Progressbar
				$("#progressbar").progressbar({
					value: 1 
				});

				
			});
		</script>