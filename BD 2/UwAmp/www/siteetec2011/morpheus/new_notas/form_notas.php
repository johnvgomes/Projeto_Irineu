<?php 

include "../conexao/conn.php";

//diretorio das fotos
$diretorio = "../configuracoes/alunos/fotos/";
$diretorio_base = "configuracoes/alunos/fotos/";

$codTurma = $_GET['codturma'];
$retorno = $_GET ['retorno'];
$codDisciplina = $_GET['coddisciplina'];

//verificar se o curso é anual ou semestral
$sqlEtapa = "SELECT Etapas.* FROM Turmas
				INNER JOIN Etapas ON Turmas.codEtapa=Etapas.codEtapa
				WHERE codTurma=$codTurma";

$rsEtapa = mysql_query($sqlEtapa);

$semestre = mysql_result($rsEtapa, 0, "semestre");
$codEtapa = mysql_result($rsEtapa, 0, "codEtapa");
$habilitaIntermediaria = mysql_result($rsEtapa, 0, "habilitaIntermediaria");
$habilitaFinal = mysql_result($rsEtapa, 0, "habilitaFinal");

?>
<style type="text/css">
.hover{
	background-color: #DDD;
}
.combo_vermelho{
	border-color: #F00;
}
</style>

<script type="text/javascript">
	$(function(){

		$(".foto").popover();

		$('tr').hover(
	        function () {
	            $(this).addClass('hover');
	        },
	        function () {
	            $(this).removeClass('hover');
	        }
    	);

		//botão imprimir
		$("#imprimir").click(function(){
			$("#dialogo_imprimir").dialog( "open" );
			$("#dialogo_imprimir").move(500,500);
			return false;
		});


		$( "#dialogo_imprimir" ).dialog({
			closed: true,
			height: 150,
			width: 200,
			top: 500,
			modal: true
		});

		$(".lock").toggleClass("ui-icon-unlocked");

		$(".campo_mencaoI").change(function () {
			var codaluno = $(this).attr("codaluno");
			var mencao = $(this).find("option:selected").text();
			var campo = $(this).attr("campo");
			
			$.post("new_notas/gravar_mencao_intermediaria.php", 
				{codaluno: codaluno, coddisciplina: <?php echo $codDisciplina ?>, mencao: mencao, codturma:<?php echo $codTurma?>, campo: campo, codEtapa: <?php echo $codEtapa?>})
	        .error(function() { alert("Erro ao gravar nota. Banco de Dados Indisponível"); }) 

	        //Deliberação 11
	        if (mencao == "I") {
	        	$(this).addClass("combo_vermelho");
	        	var codmatricula = $(this).attr("codmatricula");
	        	var coddisciplina = <?php echo $codDisciplina?>;
	        	$("#dialog-deliberacao").attr("codmatricula", codmatricula);
				$("#dialog-deliberacao").attr("coddisciplina", coddisciplina);
				$("#dialog-deliberacao").dialog("open");
	        }else{
	        	$(this).removeClass("combo_vermelho");
	        }
        });


		$(".campo_mencaoF").change(function () {
			var codaluno = $(this).attr("codaluno");
			var mencao = $(this).find("option:selected").text();
			$.post("new_notas/gravar_mencao_final.php", 
				{codaluno: codaluno, coddisciplina: <?php echo $codDisciplina ?>, mencao: mencao, codturma:<?php echo $codTurma?>, codEtapa: <?php echo $codEtapa?>})
	        .error(function() { alert("Erro ao gravar nota. Banco de Dados Indisponível"); }) 
	        if (mencao=="I") $(this).addClass("combo_vermelho"); else $(this).removeClass("combo_vermelho");  
        });

		$(".campo_mencao_avaliacao").change(function () {
			var codaluno = $(this).attr("codaluno");
			var codavaliacao = $(this).attr("codavaliacao");
	        var mencao = $(this).find("option:selected").text();
	        $.post("new_notas/gravar_mencaoavaliacao.php", {codaluno: codaluno, codavaliacao: codavaliacao, mencao: mencao, codEtapa: <?php echo $codEtapa?>})
	        .error(function() { alert("Erro ao gravar nota. Banco de Dados Indisponível"); })	
	        if (mencao=="I") $(this).addClass("combo_vermelho"); else $(this).removeClass("combo_vermelho");        
        });

		//botao que trava e habilita digitacao de nota
		$(".lock").click(function(){
        	$(this).toggleClass("ui-icon-unlocked");
        	var codavaliacao = "."+ $(this).attr("id");
        	if ($(codavaliacao).attr("disabled") == "disabled"){
        		$(codavaliacao).removeAttr("disabled");
        	}else{
        		$(codavaliacao).attr("disabled", "disabled");
        	}
        	
        });


	});

</script>

<?php

$sqlAlunos = "SELECT Matriculas.*, Alunos.nomeAluno, Alunos.codAluno, Alunos.foto FROM Matriculas ".
			"INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno ".
			"WHERE Matriculas.codTurma=$codTurma ".
			"ORDER BY nChamada";
$rsAlunos = mysql_query($sqlAlunos);

$sqlAvaliacoes = "SELECT * FROM Avaliacoes ".
				"WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina";
$rsAvaliacoes = mysql_query($sqlAvaliacoes);

if (mysql_num_rows($rsAlunos)<1){
	
	?>
	<div class="ui-widget">
		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
			<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
			<strong>Erro: </strong>Nenhum aluno cadastrado na turma. Procure a secretaria.</p>
		</div>
	</div>
	<?php
	
}else{
	if (mysql_num_rows($rsAvaliacoes)<2) {
?>
			<div class="alert alert-block">
  				<h4>Aten&ccedil;&atilde;o!</h4>
  				Cadastre pelo menos duas avaliações. Caso contr&aacute;rio n&atilde;o ser&aacute; poss&iacute;vel imprimir a planilha de notas.
			</div>
						
			
	<?php 
	}

	?>
	<form id='fnotas' method='post'>
		<input type=hidden name=codTurma value=<?php echo $codTurma?> />
		<input type=hidden name=codDisciplina value=<?php echo $codDisciplina?> />
		<table class='table table-hover'>
		<thead>
			<tr class='ui-widget-header '>
				<th>N.</th>
				<th>Nome</th>
				<th><a href='#' title="Foto">Foto</a><a href='#' class='ui-icon ui-icon-locked lock'></th>

				<?php
				while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){
					$codAvaliacao = $rowAvaliacoes['codAvaliacao'];
					$sigla = $rowAvaliacoes["sigla"];
					
					?>
					<th><?php echo $sigla; ?>
					<a href='#' class="ui-icon ui-icon-locked lock" id=<?php echo $codAvaliacao; ?>></a>
					</th>
				<?php
					}
				?>
				<th><a href='#' title="Frequência">F%</a><a href='#' class='ui-icon ui-icon-locked lock'></th>
				<th>MI<a href='#' class='ui-icon ui-icon-locked lock' id='mi'></a></th>
				<?php if ($semestre==0) { ?>
					<th>MI<a href='#' class='ui-icon ui-icon-locked lock' id='mi2'></a></th>
					<th>MI<a href='#' class='ui-icon ui-icon-locked lock' id='mi3'></a></th>
				<?php }?>				
				<th alt='Mencao Final' width="200">MF<a href='#' class="ui-icon ui-icon-locked lock" id='mf'></a></th>
				<th>D11</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while($rowAluno = mysql_fetch_array($rsAlunos)){
				$mencaoI="";
				$mencaoF="";
				$mencaoI2="";
				$mencaoI3="";
				//executar novamente para posicionar o cursor no ínicio
				$rsAvaliacoes = mysql_query($sqlAvaliacoes);
				$qtdeAvaliacoes = mysql_num_rows($rsAvaliacoes) + 2; //para considerar MI e MF
				$codAluno = $rowAluno["codAluno"];
				$codMatricula = $rowAluno["codMatricula"];
				echo "<tr>";
				echo "<td>".$rowAluno["nChamada"]."</td>";
				echo "<td style='white-space: nowrap'>".utf8_encode($rowAluno["nomeAluno"])."</td>";
				//Popover da foto do aluno se existir
					$foto = $rowAluno["foto"];
					if (file_exists($diretorio.$foto.".jpg")){
			  			$tag_foto = "<a href='#' class='icon icon-user foto' rel='popover' 
							data-content='<img src=\"".$diretorio_base.$foto.".jpg\" />'
							data-original-title='Foto'></a>";
			  		}elseif (file_exists($diretorio.$foto.".jpeg")){
			  			$tag_foto = "<a href='#' class='icon icon-user foto' rel='popover' 
							data-content='<img src=\"".$diretorio_base.$foto.".jpeg\" />'
							data-original-title='Foto'></a>";
			  		}else{
			  			$tag_foto = "";
			  		}
					echo "<td style='white-space: nowrap'>$tag_foto</td>";

				if ($rowAluno["status"]!="MA"){ //Se não for matrícula ativa desabilita a linha
					?>
					<td colspan=<?php echo $qtdeAvaliacoes?> style='background-color:#999999'>
						<?php echo $rowAluno["status"]?>
					</td>
					<?php
				}else{
					while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){

					$codAvaliacao = $rowAvaliacoes['codAvaliacao'];
					
					//buscar as notas das avaliacoes do aluno
					$sqlMencoesAvaliacoes = "SELECT mencao FROM MencoesAvaliacoes ".
											"WHERE codAluno=$codAluno ".
											"AND codAvaliacao=$codAvaliacao";
					$rsMencoesAvaliacoes = mysql_query($sqlMencoesAvaliacoes);
					
					//verifica se o aluno tem nota na avaliação
					if (mysql_num_rows($rsMencoesAvaliacoes)<1) 
						$mencao="NULL"; 
					else 
						$mencao = mysql_result($rsMencoesAvaliacoes, 0, "mencao");
					?>
					
					<?php if ($mencao == "I") $classe_combo = "combo_vermelho"; else $classe_combo = ""; ?>

					<td>
						<select 
						  class="input-mini campo_mencao_avaliacao <?php echo $codAvaliacao.' '.$classe_combo?>"
						  name=<?php echo $codAluno."_".$codAvaliacao?> 
						  codaluno=<?php echo $codAluno?> 
						  codavaliacao=<?php echo $codAvaliacao?>
						   >
							<?php
							if ($mencao=="NULL") echo "<option value='NULL'> </option>";
							if ($mencao=="MB") echo "<option selected=selected >MB</option>"; 
								else echo "<option>MB</option>"; 
							if ($mencao=="B") echo "<option selected=selected >B</option>"; 
								else echo "<option>B</option>"; 
							if ($mencao=="R") echo "<option selected=selected >R</option>"; 
								else echo "<option>R</option>"; 
							if ($mencao=="I") echo "<option selected=selected >I</option>"; 
								else echo "<option>I</option>"; 
							?>
						</select>
					</td>

					<?php
						
					}// fim do while das avaliacoes

					//Calcular a frequência com dados do diário eletrônico
					//Buscar aulas dadas

					$sqlAulasDadas = "SELECT SUM(qtdeAulas) as aulasDadas FROM Encontros 
											WHERE codTurma=$codTurma 
											AND codDisciplina=$codDisciplina";
											
					$rsAulasDadas = mysql_query($sqlAulasDadas);
					$total_aulas_dadas = mysql_result($rsAulasDadas, 0, "aulasDadas");
					if ($semestre!=0) $total_aulas_dadas = $total_aulas_dadas * 1.25;
					$total_aulas_dadas = number_format($total_aulas_dadas,1);

					//Pegar as faltas digitadas
						$sqlTotalFaltas = "SELECT count(codChamada) as faltas, Encontros.codDisciplina FROM Faltas
													INNER JOIN Aulas ON Aulas.codAula=Faltas.codAula
													INNER JOIN Encontros ON Encontros.codEncontro=Aulas.codEncontro
													INNER JOIN Turmas ON Turmas.codTurma=Encontros.codTurma
													INNER JOIN Disciplinas ON Disciplinas.codDisciplina = Encontros.codDisciplina
													WHERE codAluno=$codAluno
													AND Encontros.codTurma=$codTurma
													AND Disciplinas.codDisciplina=$codDisciplina";

						$rsTotalFaltas = mysql_query($sqlTotalFaltas);
						$total_faltas = mysql_result($rsTotalFaltas, 0 , "faltas");
						if ($semestre!=0) $total_faltas = $total_faltas * 1.25;
						$total_faltas = number_format($total_faltas, 1);

						//echo $sqlTotalFaltas."<br>";

					$freq_p = (1 - ($total_faltas / $total_aulas_dadas) )* 100; 	
					$freq_p = number_format($freq_p,2);
					$cor = ($freq_p<75)?"style='color:red'":"";
					echo "<td $cor>$freq_p</td>";


					//mencao final ou intermediaria dependendo de qual foi habilitada na tabela Etapas

					//se for ensino médio pega a menção da etapa anterior (5)
					if ($semestre==0) {
					$sqlMencoesEM = "SELECT * FROM Mencoes ".
									"WHERE codAluno=$codAluno ".
									"AND codDisciplina=$codDisciplina ".
									"AND codEtapa=5";
					$rsMencoesEM = mysql_query($sqlMencoesEM);
						
					}
					
					$sqlMencoes = "SELECT * FROM Mencoes ".
									"WHERE codAluno=$codAluno ".
									"AND codDisciplina=$codDisciplina ".
									"AND codEtapa=$codEtapa";
					
					$rsMencoes = mysql_query($sqlMencoes);

					if (mysql_num_rows($rsMencoes)>0){
						$mencaoI = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
						$mencaoF = mysql_result($rsMencoes, 0, "mencaoFinal");
					}
					if ($semestre == 0){
						$mencaoI1 = mysql_result($rsMencoesEM, 0, "mencaoIntermediaria");
						$mencaoI2 = mysql_result($rsMencoesEM, 0, "mencaoFinal");
						$mencaoI = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
						$mencaoF = mysql_result($rsMencoes, 0, "mencaoFinal");

						echo "<td>$mencaoI1</td>";
						echo "<td>$mencaoI2</td>";
						
						
					}


							if ($habilitaIntermediaria==1){
								if ($mencaoI == "I") $classe_combo = "combo_vermelho"; else $classe_combo = "";
							?>
							<td> 	
								<select 
								  class="input-mini campo_mencaoI mi <?php echo $classe_combo?>"
								  name=<?php echo "I".$codAluno?> 
								  codaluno=<?php echo $codAluno?> 
								  codmatricula=<?php echo $codMatricula?>
								  campo="mencaoIntermediaria"
								>
							<?php
				
								if ($mencaoI=="") echo "<option selected=selected value='NULL'> </option>"; 
									else echo "<option value='NULL'> </option>";
								if ($mencaoI=="MB") echo "<option selected=selected >MB</option>"; 
									else echo "<option>MB</option>"; 
								if ($mencaoI=="B") echo "<option selected=selected >B</option>"; 
									else echo "<option>B</option>"; 
								if ($mencaoI=="R") echo "<option selected=selected >R</option>"; 
									else echo "<option>R</option>"; 
								if ($mencaoI=="I") echo "<option selected=selected >I</option>"; 
									else echo "<option>I</option>"; 
								echo "</select></td>";


								
							}else{

							//campo mencao final habilitado
								
								echo "<td>$mencaoI</td>";

								
							}

					
					//campo menção intermediaria habilitado
					if ($habilitaFinal==1){
						if ($mencaoF == "I") $classe_combo = "combo_vermelho"; else $classe_combo = "";
					?>
						<td>
						<select 
						  class="input-mini campo_mencaoF mf <?php echo $classe_combo?>"
						  name=<?php echo "F".$codAluno?> 
						  codaluno=<?php echo $codAluno?> 
						>
						<?php	
						if ($mencaoF=="") echo "<option selected=selected value='NULL'> </option>"; 
							else echo "<option value='NULL'> </option>";
						if ($mencaoF=="MB") echo "<option selected=selected >MB</option>"; 
							else echo "<option>MB</option>"; 
						if ($mencaoF=="B") echo "<option selected=selected >B</option>"; 
							else echo "<option>B</option>"; 
						if ($mencaoF=="R") echo "<option selected=selected >R</option>"; 
							else echo "<option>R</option>"; 
						if ($mencaoF=="I") echo "<option selected=selected >I</option>"; 
							else echo "<option>I</option>"; 
						echo "</select></td>";
					}else{
						//MF desabilitado
						echo "<td>$mencaoF</td>";
					}
					echo "<td><a href='configuracoes/conselho/intermediario/editar_deliberacao.php?codMatricula=$codMatricula&codDisciplina=$codDisciplina&retorno=$retorno' class='ui-icon ui-icon-comment'></a></td>";
				echo "</tr>";
				}//fim do if que verifica se o aluno tem matricula ativa
			}//fim do loop que percorre a lista de alunos
		}
			?>

		</tbody>
		</table>
			</form>

		<?php	
			
			if (mysql_num_rows($rsAvaliacoes)>=2) {
				?>	<a href="new_notas/relatorio/mencoes.php?codturma=<?php echo $codTurma ?>&coddisciplina=<?php echo $codDisciplina ?>" target="_blank" class="btn"><i class="icon-print"></i> Imprimir Notas</a>
					
				<?PHP
				
			}
			
		?>


