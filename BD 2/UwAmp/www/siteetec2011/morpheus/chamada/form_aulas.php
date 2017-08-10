<?php 
include "../conexao/conn.php";

$codTurma = $_GET['codturma'];
$codDisciplina = $_GET['coddisciplina'];
$index_data = $codTurma.$codDisciplina;

// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Etapas WHERE atual=1");
$codEtapa = mysql_result($rsEtapaAtual, 0);

?>

<script type="text/javascript">
	$(function(){

	$( "#datepicker<?php echo $index_data ?>" ).datepicker();
	// CONFIGURAÇÃO DO DATEPICKER DO JQUERYUI PARA PT-BR
	$.datepicker.setDefaults({dateFormat: 'dd/mm/y',
                          dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                          dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                          dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                          monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro', 'Outubro','Novembro','Dezembro'],
                          monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set', 'Out','Nov','Dez'],
                          nextText: 'Próximo',
                          prevText: 'Anterior'
                         });

			
		$( "#dialog-confirm" ).dialog({
				autoOpen: false,
				resizable: false,
				height:240,
				modal: true,
				buttons: {
					Confirmar: function() {
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

		
		$(".apagaraula").click(function(){
			var codencontro = $(this).attr("id");
			$("#dialog-confirm").attr("cod", codencontro);
			$( "#dialog-confirm" ).dialog("open");
		
		});

		$(".editaraula").click(function(){
			var codencontro = $(this).attr("id");
			var linha = "#linha_" + codencontro;
			var data = $(linha + " td").first().text();			
			var conteudo = $(linha + " td").first().next().text();			
			$("#edit_cod").val(codencontro);
			$("#edit_data").val(data);
			$("#edit_conteudo").val(conteudo);
			$( "#dialog-form" ).dialog( "open" );
		});

		
		$(".gravaraula").click(function(){
			$.post("chamada/gravar_aula.php", $("#faula<?php echo $index_data?>").serialize())
				.success(function(){
					var selected = $( "#tabsconteudo" ).tabs( "option", "selected" );
					$("#tabsconteudo").tabs( "load" , selected);

				})
			.error(function(){
				alert('Erro ao gravar aula');  
			}); 
			    
		});

		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 850,
			modal: true,
			buttons: {
				"Salvar": function() {
					
					$.post("chamada/alterar_aula.php", $("#form-edit").serialize())
					.success(function(r){
						var selected = $( "#tabsconteudo" ).tabs( "option", "selected" );
						$("#tabsconteudo").tabs( "load" , selected);
						//alert(r);
					})
					.error(function(){
						alert('Erro ao alterar aula');  
					}); 
			
					$( this ).dialog( "close" );
					
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			}
			
		});


	});
</script>

<?php
//mostrar as observações do coordenador
$sqlObservacoes = "SELECT *, date_format(data, '%d/%m') as dataf FROM ObservacoesDiarios WHERE
					codDisciplina=$codDisciplina
					AND codTurma=$codTurma";
$rsObservacoes = mysql_query($sqlObservacoes);

while($row = mysql_fetch_array($rsObservacoes)){
?>
<div class="alert alert-error" data-alert="alert">
	<a class="close" data-dismiss="alert">×</a>
	Observação do Coordenador: 
	<?php echo $row["dataf"]." - ".$row["observacao"]; ?> 
</div>
<?php } ?>

<form id="faula<?php echo $index_data;?>">
<input type=hidden name=codDisciplina value=<?php echo $codDisciplina?> />
<input type=hidden name=codTurma value=<?php echo $codTurma?> />
<table id="aulas_<?php echo $index_data?>" class="table table-hover" style="width: 800px">
<thead>
  <tr class="ui-widget-header ">
    <th>Data</th>
    <th>Conteudo</th>
    <th>Aulas</th>    
    <th>Editar</th>    
    <th>Apagar</th>    
  </tr>
 </thead>
 <tbody>

<?php 
$sqlEncontros = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') as dia FROM Encontros ".
				"WHERE codTurma=$codTurma ".
				"AND codDisciplina=$codDisciplina ".
				"ORDER BY data";

$rsEncontros = mysql_query($sqlEncontros);

if (mysql_num_rows($rsEncontros)<1){
	echo "<tr class='error'><td colspan=5>Nenhuma aula cadastrada</td></tr>";
}else{
	while ($rowEncontros = mysql_fetch_array($rsEncontros)){
		$codEncontro = $rowEncontros['codEncontro'];
		echo "<tr id='linha_$codEncontro'>";
		echo "<td align='center'>".$rowEncontros['dia']."</td>";
		echo "<td>".($rowEncontros['conteudo'])."</td>";
		echo "<td align='center'>".$rowEncontros['qtdeAulas']."</td>";
		echo "<td align='center'><a href='#' class='ui-icon ui-icon-pencil editaraula' id=$codEncontro></a></td>";
		echo "<td align='center'><a href='#' class='ui-icon ui-icon-trash apagaraula' id=$codEncontro></a></td>";
		echo "</tr>";
	}
}

$hoje = date("d/m/y");
?>  	

  	<tr id="linha_novo<?php echo $coddisciplina?>">
  		<td align='center'><input type="text" placeholder="Data" class="input-small"  name="campo_data" id="datepicker<?php echo $index_data?>"></td>
  		<td><textarea name=conteudo rows=2 class="input-xxlarge"></textarea></td>
  		<td align='center'><input id='aulas' type=text name='aulas' size=1 maxlength=1 value=2 class="input-mini"></td>
  		<td align='center'><a href='#' class='ui-icon ui-icon-check gravaraula'></a></td>
  		<td></td>
  	</tr>
  	</tbody>
</table>
</form>

<a href="ptd/<?php echo $codDisciplina ?>.pdf" target="_blank" class="btn"><i class="icon-file"></i> Ver PTD</a>
<div id="dialog-confirm" title="Apagar Aula" cod=0>
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		Se apagar a aula selecionada, os dados da chamada dessa aula serão perdidos. Deseja continuar?</p>
</div>