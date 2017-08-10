<?php // incluido no arquivo form_notas.php, compartilha algumas variaveis com ele ?>

<script type="text/javascript">
	$(function(){

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
			$.post("gravar_mencao_intermediaria.php", 
				{codaluno: codaluno, coddisciplina: <?php echo $codDisciplina ?>, mencao: mencao, codturma:<?php echo $codTurma?>})
	        .error(function() { alert("Erro ao gravar nota. Banco de Dados Indisponível"); }) 
        });

		$(".campo_mencaoF").change(function () {
			var codaluno = $(this).attr("codaluno");
			var mencao = $(this).find("option:selected").text();
			$.post("gravar_mencao_final.php", 
				{codaluno: codaluno, coddisciplina: <?php echo $codDisciplina ?>, mencao: mencao, codturma:<?php echo $codTurma?>})
	        .error(function() { alert("Erro ao gravar nota. Banco de Dados Indisponível"); }) 
        });

		$(".campo_mencao_avaliacao").change(function () {
			var codaluno = $(this).attr("codaluno");
			var codavaliacao = $(this).attr("codavaliacao");
	        var mencao = $(this).find("option:selected").text();
	        $.post("gravar_mencaoavaliacao.php", {codaluno: codaluno, codavaliacao: codavaliacao, mencao: mencao})
	        .error(function() { alert("Erro ao gravar nota. Banco de Dados Indisponível"); })	        
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

$sqlAlunos = "SELECT Matriculas.*, Alunos.nomeAluno, Alunos.codAluno FROM Matriculas ".
			"INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno ".
			"WHERE Matriculas.codTurma=$codTurma ".
			"ORDER BY nChamada";
$rsAlunos = mysql_query($sqlAlunos);

$sqlAvaliacoes = "SELECT * FROM Avaliacoes ".
				"WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina ORDER By date";
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
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
					<strong>Atenção:</strong> Cadastre pelo menos duas avaliações antes de digitar as menções</p>
				</div>
			</div>
	<?php 
	}

	?>
	<form id='fnotas' method='post'>
		<input type=hidden name=codTurma value=<?php echo $codTurma?> />
		<input type=hidden name=codDisciplina value=<?php echo $codDisciplina?> />
		<table class='ui-widget ui-widget-content'>
		<thead>
			<tr class='ui-widget-header '>
				<th>N.</th>
				<th>Nome</th>
				<?php
				$dataAnterior = "1990-01-01";
				$mostrou_MI = false;
				while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){
					$data = $rowAvaliacoes['date'];
					if ($dataAnterior < $dataEntrega1 && $dataEntrega1 < $data){
						echo "<th>MI<a href='#' class='ui-icon ui-icon-locked lock' id='mi'></a></th>";
						$mostrou_MI = true;
					}
					

					$codAvaliacao = $rowAvaliacoes['codAvaliacao'];
					$sigla = $rowAvaliacoes["sigla"];
					
					?>
					<th><?php echo $sigla ?>
					<a href='#' class="ui-icon ui-icon-locked lock" id=<?php echo $codAvaliacao ?>></a>
					</th>
				<?php
					$dataAnterior = $data;
				}
				if (!$mostrou_MI){
					echo "<th>MI<a href='#' class='ui-icon ui-icon-locked lock' id='mi'></a></th>";
				} 	
				echo "<th>MI<a href='#' class='ui-icon ui-icon-locked lock' id='mi'></a></th>";
			
				?>
				
				<th alt='Mencao Final'>MF<a href='#' class="ui-icon ui-icon-locked lock" id='mf'></a></th>
			</tr>
		</thead>
		<tbody>
			<?php
			while($rowAluno = mysql_fetch_array($rsAlunos)){
				$mencaoI="";
				$mencaoF="";
				//executar novamente para posicionar o cursor no ínicio
				$rsAvaliacoes = mysql_query($sqlAvaliacoes);
				$qtdeAvaliacoes = mysql_num_rows($rsAvaliacoes) + 2; //para considerar MI e MF
				$codAluno = $rowAluno["codAluno"];
				echo "<tr>";
				echo "<td>".$rowAluno["nChamada"]."</td>";
				echo "<td>".$rowAluno["nomeAluno"]."</td>";
				if ($rowAluno["status"]!="MA"){ //Se não for matrícula ativa desabilita a linha
					?>
					<td colspan=<?php echo $qtdeAvaliacoes?> style='background-color:#999999'>
						<?php echo $rowAluno["status"]?>
					</td>
					<?php
				}else{
					$dataAnterior = "1990-01-01";
					$mostrou_MI = false;
					while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){

					//mencao final ou intermediaria dependendo de qual foi habilitada na tabela Etapas
					$sqlMencoes = "SELECT * FROM Mencoes ".
									"WHERE codAluno=$codAluno ".
									"AND codDisciplina=$codDisciplina ".
									"AND codEtapa=$codEtapa";
					$rsMencoes = mysql_query($sqlMencoes);

					if (mysql_num_rows($rsMencoes)>0){
						$mencaoI = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
						$mencaoF = mysql_result($rsMencoes, 0, "mencaoFinal");
					}

						$data = $rowAvaliacoes['date'];
						
						if ($dataAnterior < $dataEntrega1 && $dataEntrega1 < $data){
							$mostrou_MI = true;
							if ($habilitaIntermediaria==1){
							?>
							<td> 	
								<select 
								  class="campo_mencaoI mi"
								  name=<?php echo "I".$codAluno?> 
								  codaluno=<?php echo $codAluno?> 
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
						
						}
					
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
					
					<!-- cria o select com a nota selecionada -->
					<td>
						<select 
						  class="campo_mencao_avaliacao <?php echo $codAvaliacao?>"
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
						$dataAnterior = $data;
					}// fim do while das avaliacoes

					if(!$mostrou_MI){
						if ($habilitaIntermediaria==1){
								?>
								<td> 	
									<select 
									  class="campo_mencaoI mi"
									  name=<?php echo "I".$codAluno?> 
									  codaluno=<?php echo $codAluno?> 
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
					}

					//Segunda menção intermediaria
						if ($habilitaIntermediaria==1){
								?>
								<td> 	
									<select 
									  class="campo_mencaoI mi"
									  name=<?php echo "I".$codAluno?> 
									  codaluno=<?php echo $codAluno?> 
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

					
					//campo menção final habilitado
					if ($habilitaFinal==1){
					?>
						<td>
						<select 
						  class="campo_mencaoF mf"
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
				?>	<p>Imprimir planilha</p>
					<p><a href="imprimir_mencoes.php?target=frente&codDisciplina=<?php echo $codDisciplina?>&codTurma=<?php echo $codTurma ?>" target='_blank' id='btn_imprimir_frente'>Frente</a>
					<a href="imprimir_mencoes.php?target=verso&codDisciplina=<?php echo $codDisciplina?>&codTurma=<?php echo $codTurma ?>" target='_blank' id='btn_imprimir_verso'>Verso</a></p>
			
				<?PHP
				
			}
			
		?>
