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
	$( "#datepicker_ava<?php echo $index_data ?>" ).datepicker();
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

		$( "#dialog-confirm-ava" ).dialog({
				autoOpen: false,
				resizable: false,
				height:240,
				modal: true,
				buttons: {
					Confirmar: function() {
						var codavaliacao = $("#dialog-confirm-ava").attr("cod");
						var linha = "#linha" + codavaliacao;
						$.post("new_notas/apagar_avaliacao.php", {codAvaliacao: codavaliacao})
							.success(function(){
								$( this ).dialog( "close" );
								$("#linha_"+codavaliacao).hide('highlight' );


						})
						.error(function(){
							alert("Erro ao apagar avaliação");
						}); 
						$( this ).dialog( "close" );
					},
					Cancelar: function() {
						$( this ).dialog( "close" );
					}
				}
		});

		$(".apagarava").click(function(){
			var codavaliacao = $(this).attr("id");
			$("#dialog-confirm-ava").attr("cod", codavaliacao);
			$("#dialog-confirm-ava").dialog("open");
		});
		
		$(".gravarava").click(function(){
			$.post("new_notas/gravar_avaliacao.php", $("#favaliacao<?php echo $index_data?>").serialize())
				.success(function(){
					var selected = $( "#tabsavaliacoes" ).tabs( "option", "selected" );
					$("#tabsavaliacoes").tabs( "load" , selected);
			})
			.error(function(){
				$.messager.alert('Erro','Erro ao gravar avaliação');  
			}); 
			    
		});

		$(".cls_mostrar").click(function(){
			
			var codavaliacao = $(this).attr("id");
			        
					$.post("new_notas/mostrar_nota.php", {codAvaliacao: codavaliacao, mostrar:1})
					.success(function(){
						var selected = $( "#tabsavaliacoes" ).tabs( "option", "selected" );
						$("#tabsavaliacoes").tabs( "load" , selected);
					})
					.error(function(){
						alert('Erro','Erro ao alterar dados da avaliação');  
					}); 
			});  

		$(".cls_ocultar").click(function(){
			
			var codavaliacao = $(this).attr("id");
			        
					$.post("new_notas/mostrar_nota.php", {codAvaliacao: codavaliacao, mostrar:0})
					.success(function(){

						var selected = $( "#tabsavaliacoes" ).tabs( "option", "selected" );
						$("#tabsavaliacoes").tabs( "load" , selected);
					})
					.error(function(){
						alert('Erro','Erro ao alterar dados da avaliação');  
					}); 
			});  
				
		$(".editarava").click(function(){
			var codavaliacao = $(this).attr("id");
			var linha = "#linha_" + codavaliacao;
			var sigla = $(linha + " td").first().text();			
			var descricao = $(linha + " td").first().next().text();			
			var data = $(linha + " td").first().next().next().next().text();			
			$("#edit_cod").val(codavaliacao);
			$("#edit_sigla").val(sigla);
			$("#edit_descricao").val(descricao);
			$("#edit_data_ava").val(data);
			$( "#dialog-form-ava" ).dialog( "open" );
		});

		$( "#dialog-form-ava" ).dialog({
			autoOpen: false,
			height: 300,
			width: 850,
			modal: true,
			buttons: {
				"Salvar": function() {
					
					$.post("new_notas/alterar_avaliacao.php", $("#form-edit-ava").serialize())
					.success(function(){
						var selected = $( "#tabsavaliacoes" ).tabs( "option", "selected" );
						$("#tabsavaliacoes").tabs( "load" , selected);

					})
					.error(function(){
						alert('Erro ao alterar avaliação');  
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

<form id="favaliacao<?php echo $index_data ?>">
<input type=hidden name=codDisciplina value=<?php echo $codDisciplina?> />
<input type=hidden name=codTurma value=<?php echo $codTurma?> />
<table id="avaliacoes" class="table table-hover">
<thead>
  <tr class="ui-widget-header ">
    <th>Sigla</th>
    <th>Descrição</th>
    <th>Tipo</th>    
    <th>Data</th> 
    <th>Mostrar</th>       
    <th>Editar</th>    
    <th>Apagar</th>    
  </tr>
 </thead>
 <tbody>

<?php 
$sqlAvaliacoes = "SELECT * FROM Avaliacoes ".
				"WHERE codTurma=$codTurma ".
				"AND codDisciplina=$codDisciplina ".
				"";
$rsAvaliacoes = mysql_query($sqlAvaliacoes);

if (mysql_num_rows($rsAvaliacoes)<1){
	echo "<tr class='error'><td colspan=7>Nenhuma avaliação cadastrada</td></tr>";
}else{
	while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){
		$codAvaliacao = $rowAvaliacoes['codAvaliacao'];
		if ($rowAvaliacoes['mostrar']==0){
			$mostrar = "<a href='#' class='ui-icon ui-icon-circle-close cls_mostrar' id=$codAvaliacao></a>";
		}else{
			$mostrar = "<a href='#' class='ui-icon ui-icon-circle-check cls_ocultar' id=$codAvaliacao></a>";
		}
		echo "<tr id='linha_$codAvaliacao'>";
		echo "<td>".$rowAvaliacoes['sigla']."</td>";
		echo "<td>".($rowAvaliacoes['descricao'])."</td>";
		echo "<td>".$rowAvaliacoes['tipo']."</td>";
		echo "<td>".$rowAvaliacoes['data']."</td>";
		echo "<td align=center>".$mostrar."</td>";
		echo "<td align=center><a href='#' class='ui-icon ui-icon-pencil editarava' id=$codAvaliacao></a></td>";
		echo "<td align=center><a href='#' class='ui-icon ui-icon-trash apagarava' id=$codAvaliacao></a></td>";
		echo "</tr>";
	}
}
?>  	

  	<tr>
  		<td><input type=text name=sigla class="input-mini" maxlength="4"></td>
  		<td><input type=text name=descricao class="input-xxlarge"></td>
  		<td><select name=tipo id='tipo' class="input-medium">
  			<option>Conhecimentos</option>
  			<option>Habilidades</option>
  			<option>Atitudes</option>
  		</select></td>
  		<td><input type="text" name="data" class="input-small" id="datepicker_ava<?php echo $index_data?>" size=10></td>
  		<td><a href='#' class='ui-icon ui-icon-check gravarava'></a></td>
  		<td></td><td></td>
  	</tr>
  	</tbody>
</table>
<div class="alert alert-info">
  <strong>Dica!</strong> Para pertimitir que o aluno veja a nota no sistema, ative o campo mostrar.
</div>

</form>


<div id="dialog-confirm-ava" title="Apagar Avaliação" cod=0>
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		Se apagar a avaliação selecionada, as notas que foram digitadas para essa avaliação serão perdidas. Deseja continuar?</p>
</div>