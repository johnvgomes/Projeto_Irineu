<?php
//diretorio das fotos
$diretorio = "../configuracoes/alunos/fotos/";
$diretorio_base = "configuracoes/alunos/fotos/";
?>
<style type="text/css">
#aula_data{
  
	-moz-transform: rotate(270deg);
	-webkit-transform: rotate(270deg);
	-ms-transform: rotate(270deg);
	-o-transform: rotate(270deg);
	transform: rotate(270deg);
	
	display: block;
	white-space: nowrap;
	overflow: hidden;
	
	padding: 0px 0px 0px 0px;
	margin-bottom: 10px;
}
.hover {
	
	background-color: #cecece;
}
   
</style>


<?php 

session_name('jcLogin');
session_start();

include "../conexao/conn.php";

$mes = $_SESSION["mes"];
$codTurma = $_GET['codturma'];
$codDisciplina = $_GET['coddisciplina'];

// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Etapas WHERE atual=1");
$codEtapa = mysql_result($rsEtapaAtual, 0);

 ?>

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
    
    	$("th").unbind('mouseenter mouseleave');

    	$( "input:submit" ).button().click(function (event){
    		var turma = $(this).attr('codturma');
    		var disciplina = $(this).attr('coddisciplina');
    		var url = "chamada/diario/diario.php?codturma=" + turma + "&coddisciplina=" + disciplina;
            window.open(url);
            event.preventDefault();
     
    	});

       
		$(".campo_falta").click(function () {
			var codaluno = $(this).attr("codaluno");
			var codaula = $(this).attr("codaula");
			var falta = $(this).is(":checked");

	        $.post("chamada/gravar_falta.php", {codaluno: codaluno, codaula: codaula, falta: falta})
	        .error(function() { alert("Erro ao gravar falta. Banco de Dados Indisponível"); })	        
        });

		
	});

</script>

<?php

$sqlAlunos = "SELECT Matriculas.*, Alunos.nomeAluno, Alunos.codAluno, Alunos.foto FROM Matriculas ".
			"INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno ".
			"WHERE Matriculas.codTurma=$codTurma ".
			"ORDER BY nChamada";
$rsAlunos = mysql_query($sqlAlunos);

$sqlAulas = "SELECT DATE_FORMAT(Encontros.data,'%d/%m') as data, Aulas.* 
				FROM Aulas 
				INNER JOIN Encontros ON Aulas.codEncontro=Encontros.codEncontro
				WHERE codTurma=$codTurma 
				AND codDisciplina=$codDisciplina
				AND month(data)=$mes";
$rsAulas = mysql_query($sqlAulas);

if (mysql_num_rows($rsAlunos)<1){
	
	?>
	
	<div class="alert alert-error">
		<h4>Erro:</h4>
		Nenhum aluno cadastrado na turma. Procure a secretaria.
	</div>
	
	
	<?php
	
}else{
	
	?>

	<form id='fchamada' method='post'>
		
		<input type=hidden name=codTurma value=<?php echo $codTurma?> />
		<input type=hidden name=codDisciplina value=<?php echo $codDisciplina?> />
		<table class='table table-hover'>
		<thead>
			<tr class='ui-widget-header '>
				<th>N.</th>
				<th>Nome</th>
				<th>Foto</th>
				<?php
				
				while ($rowAula = mysql_fetch_array($rsAulas)){
					$codAula = $rowAula['codAula'];
					$data = $rowAula["data"];
					?>
					<th height=60 style="text-align: center;"><span id='aula_data'><?php echo $data; ?></span></th>
				<?php
				}
				?>
				
			</tr>
		</thead>
		<tbody>
			<?php
			while($rowAluno = mysql_fetch_array($rsAlunos)){
				//executar novamente para posicionar o cursor no ínicio
				$rsAulas = mysql_query($sqlAulas);
				$qtdeAulas = mysql_num_rows($rsAulas);
				$codAluno = $rowAluno["codAluno"];
				echo "<tr onMouseOver='this.bgColor='yellow';'' onMouseOut='this.bgColor='white';'>";
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
					$ultimoIndice = 99;
					while ($rowAula = mysql_fetch_array($rsAulas)){
						$indice = $rowAula['indice'];
						$codAula = $rowAula['codAula'];
					
					//buscar na tabela faltas
					$sqlFaltas = "SELECT * FROM Faltas ".
											"WHERE codAluno=$codAluno ".
											"AND codAula=$codAula";
					$rsFaltas = mysql_query($sqlFaltas);
					
					//verifica se o aluno tem falta na aula
					if (mysql_num_rows($rsFaltas)<1) 
						$falta="checked=checked"; 
					else 
						$falta = "";
					?>
					
					<!-- campo da chamada -->
					<td style="text-align: center; <?php if($indice<$ultimoIndice) echo "border-left: solid 1px #dedede"?> ">
						<input class="campo_falta"  type=checkbox name=presenca <?php echo $falta ?> codaluno=<?php echo $codAluno?> codaula=<?php echo $codAula?> />
					</td>

					<?php
						$ultimoIndice = $indice;
					}// fim do while das aulas

					
					echo "</tr>";
				}//fim do if que verifica se o aluno tem matricula ativa
			}//fim do loop que percorre a lista de alunos
		}
			?>

		</tbody>
		</table>
	</form>

<a href="chamada/diario/diario.php?codturma=<?php echo $codTurma ?>&coddisciplina=<?php echo $codDisciplina ?>" target="_blank" class="btn"><i class="icon-print"></i> Imprimir diário</a>
