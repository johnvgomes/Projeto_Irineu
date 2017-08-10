<?php 

$codTurma = $_GET['codturma'];
$codDisciplina = $_GET['coddisciplina'];

// pegar a etapa atual;
$rsEtapaAtual = mysql_query("SELECT * FROM Etapas WHERE atual=1");
$codEtapa = mysql_result($rsEtapaAtual, 0);

?>
<style type="text/css">
	body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 00px; margin-top: 0px}
	div#users-contain { width: 600px; margin: 20px 0; }
	div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
	div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: 0em 10px; text-align: left; }
</style>	
	
<div id=tudo>	

<script>
function update(){
	$("#tudo").load('frame_notas.php?codturma=<?php echo $codTurma?>&coddisciplina=<?php echo $codDisciplina?> #tudo', function() {
		  carregar();
	});
}

function carregar(){
	$("#msg").hide();

	$( "#dialogo_imprimir" ).dialog({
		autoOpen: false,
		height: 150,
		width: 200,
		modal: true
	});

	$( "#salvar" ).button({
        icons: {
            primary: "ui-icon-disk"
        },
        text: false
	})
	.click(function(){
		$.post("gravar_avaliacao.php", $("#favaliacao").serialize(),
				function(data){
					if (data.success){
						update();
						
					}else{
						alert (data.msg);
					}
				}, 
			"json");
	});

	$("#btn_imprimir").button({
        icons: {
            primary: "ui-icon-check"
        }
	}).click(function(){
		$("#dialogo_imprimir").dialog( "open" );
	});

	$("#btn_gravar").button({
        icons: {
            primary: "ui-icon-check"
        }
	})
	.click(function(){
		$.post("../notas/gravar_notas2.php", function(result) {
      		alert(result);
    	})
    	.success(function() { alert("second success"); })
    	.error(function() { alert("error" + result.error); })
    	.complete(function() { alert("complete"); 
    	},json);
	});

	$("#btn_imprimir_frente").button({
        icons: {
            primary: "ui-icon-print"
        }
	});
	$("#btn_imprimir_verso").button({
        icons: {
            primary: "ui-icon-print"
        }
	});
	
	$( ".apagarava" ).button({
        icons: {
            primary: "ui-icon-trash"
        },
        text: false
	})
	.click(function(){
		$.post("apagar_avaliacao.php", {codAvaliacao: $(this).attr('id')},
			function(data){
				if (data.success){
					update();
					
				}else{
					alert (data.msg);
				}
			}, 
		"json");
	});

	$( "#data" ).datepicker( $.datepicker.regional[ "pt-BR" ] );

}


	$(function() {
		carregar();
	});
</script>
<div id="mencoes">
<?php 

$rsAlunos = mysql_query("select Matriculas.*, Alunos.nomeAluno, Alunos.codAluno from Matriculas INNER JOIN Alunos ON Alunos.codAluno=Matriculas.codAluno WHERE Matriculas.codTurma=$codTurma ORDER BY nomeAluno");
$rsAvaliacoes = mysql_query("select Avaliacoes.sigla from Avaliacoes WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina");
$rsEtapa = mysql_query("select * from Etapas WHERE atual=1");
if (mysql_num_rows($rsAlunos)<1){
	echo "Nenhum aluno matriculado na turma";
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
	echo "<form id='fnotas' method='post'>";
	echo "<button id='btn_gravar'>Gravar</button>";
	echo "<input type=hidden name=codTurma value=$codTurma />";
	echo "<input type=hidden name=codDisciplina value=$codDisciplina />";
	echo "<table class='ui-widget ui-widget-content'>";
	echo "<thead><tr class='ui-widget-header '>";
	echo "<th>Nome</th>";
	while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){
		$sigla = $rowAvaliacoes["sigla"];
		echo "<th>$sigla</th>";
	}
	echo "<th>MI</th>";
	echo "<th alt='Mencao Final'>MF</th>";
	echo "</tr></thead><tbody>";
	
	while($rowAluno = mysql_fetch_array($rsAlunos)){
		$mencaoI="";
		$mencaoF="";
		$rsAvaliacoes = mysql_query("select Avaliacoes.sigla, Avaliacoes.codAvaliacao from Avaliacoes WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina");
		$qtdeAvaliacoes = mysql_num_rows($rsAvaliacoes) + 2;
		$codAluno = $rowAluno["codAluno"];
		echo "<tr><td>".$rowAluno["nomeAluno"]."</td>";
		if ($rowAluno["status"]!="MA"){
			echo "<td colspan=$qtdeAvaliacoes style='background-color:#999999'>".$rowAluno["status"]."</td>";
		}else{
			while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){
				$codAvaliacao = $rowAvaliacoes['codAvaliacao'];
				$rsMencoesAvaliacoes = mysql_query("select mencao from MencoesAvaliacoes WHERE codAluno=$codAluno AND codAvaliacao=$codAvaliacao");
				if (mysql_num_rows($rsMencoesAvaliacoes)<1) $mencao="NULL"; else $mencao = mysql_result($rsMencoesAvaliacoes, 0, "mencao");
				echo "<td><select name=".$codAluno."_"."$codAvaliacao>";
				if ($mencao=="NULL") echo "<option value='NULL'> </option>";
				if ($mencao=="MB") echo "<option selected=selected >MB</option>"; else echo "<option>MB</option>"; 
				if ($mencao=="B") echo "<option selected=selected >B</option>"; else echo "<option>B</option>"; 
				if ($mencao=="R") echo "<option selected=selected >R</option>"; else echo "<option>R</option>"; 
				if ($mencao=="I") echo "<option selected=selected >I</option>"; else echo "<option>I</option>"; 
				echo "</select></td>";
			}
			//mencao final ou intermediaria dependendo de qual foi habilitada na tabela Etapas
			$rsMencoes = mysql_query("SELECT * FROM Mencoes WHERE codAluno=$codAluno AND codDisciplina=$codDisciplina AND codEtapa=$codEtapa");
			if (mysql_num_rows($rsMencoes)>0){
				$mencaoI = mysql_result($rsMencoes, 0, "mencaoIntermediaria");
				$mencaoF = mysql_result($rsMencoes, 0, "mencaoFinal");
			}
			if (mysql_result($rsEtapa, 0, "habilitaIntermediaria")==1){
				echo "<td><select name=I$codAluno>";
				if ($mencaoI=="") echo "<option selected=selected value='NULL'> </option>"; else echo "<option value='NULL'> </option>";
				if ($mencaoI=="MB") echo "<option selected=selected >MB</option>"; else echo "<option>MB</option>"; 
				if ($mencaoI=="B") echo "<option selected=selected >B</option>"; else echo "<option>B</option>"; 
				if ($mencaoI=="R") echo "<option selected=selected >R</option>"; else echo "<option>R</option>"; 
				if ($mencaoI=="I") echo "<option selected=selected >I</option>"; else echo "<option>I</option>"; 
				echo "</select></td>";
				echo "<td>$mencaoF</td>";
			}elseif (mysql_result($rsEtapa, 0, "habilitaFinal")==1){
				echo "<td>$mencaoI</td>";
				echo "<td><select name=F$codAluno>";
				if ($mencaoF=="") echo "<option selected=selected value='NULL'> </option>"; else echo "<option value='NULL'> </option>";
				if ($mencaoF=="MB") echo "<option selected=selected >MB</option>"; else echo "<option>MB</option>"; 
				if ($mencaoF=="B") echo "<option selected=selected >B</option>"; else echo "<option>B</option>"; 
				if ($mencaoF=="R") echo "<option selected=selected >R</option>"; else echo "<option>R</option>"; 
				if ($mencaoF=="I") echo "<option selected=selected >I</option>"; else echo "<option>I</option>"; 
				echo "</select></td>";
			}else{
				echo "<td>$mencaoI</td>";
				echo "<td>$mencaoF</td>";
			}
		}
			echo "</tr>";
	}
	echo "</tbody></table>";
	if (mysql_num_rows($rsAvaliacoes)>=2) {
		echo "<a href=# id='btn_imprimir'>Imprimir</a>";
	}
	echo "</form>";

?>
</div>
<div class="ui-widget" id="msg" style="width:200px;position:absolute;top:0;">
				<div class="ui-state-highlight ui-corner-all" style="margin-top: 00px; padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
					<strong><div id="mensagem">Salvando...</div></strong></p>
				</div>
			</div>	

<div class="ui-widget" id="avaliacoes">
<form id="favaliacao">
<input type=hidden name=codDisciplina value=<?php echo $codDisciplina?> />
<input type=hidden name=codTurma value=<?php echo $codTurma?> />
<table id="avaliacoes" class="ui-widget ui-widget-content">
<thead>
  <tr class="ui-widget-header ">
    <th>Sigla</th>
    <th>Descrição</th>
    <th>Tipo</th>    
    <th>Data</th>    
    <th>Apagar</th>    
  </tr>
  </thead>
  <tbody>
<?php 
$rsAvaliacoes = mysql_query("select * from Avaliacoes WHERE codTurma=$codTurma AND codDisciplina=$codDisciplina");
if (mysql_num_rows($rsAvaliacoes)<1){
	echo "<td colspan=4>Nenhuma avaliação cadastrada</td>";
}else{
	while ($rowAvaliacoes = mysql_fetch_array($rsAvaliacoes)){
		echo "<tr>";
		echo "<td>".$rowAvaliacoes['sigla']."</td>";
		echo "<td>".$rowAvaliacoes['descricao']."</td>";
		echo "<td>".$rowAvaliacoes['tipo']."</td>";
		echo "<td>".$rowAvaliacoes['data']."</td>";
		echo "<td><input type=button class='apagarava' id=".$rowAvaliacoes['codAvaliacao']." value=x /></td>";
		echo "</tr>";
	}
}
?>  	

  	<tr>
  		<td><input type=text name=sigla size=4 maxlength="4"></td>
  		<td><input type=text name=descricao></td>
  		<td><select name=tipo id=tipo><option>Conhecimentos</option><option>Habilidades</option><option>Atitudes</option></select></td>
  		<td><input type=text name=data id=data size=10></td>
  		<td><input type=button id="salvar" value=ok /></td>
  	</tr>
  	</tbody>
</table>
</form>
</div>	
</div>
<div id="dialogo_imprimir" title="Imprimir Menções">
	<p>Impressão de planilha de menções. Escolha uma página para ser impressa.</p>
	<p><a href="imprimir_mencoes.php?target=frente&codDisciplina=<?php echo $codDisciplina?>&codTurma=<?php echo $codTurma ?>" target='_blank' id='btn_imprimir_frente'>Frente</a>
	<a href="imprimir_mencoes.php?target=verso&codDisciplina=<?php echo $codDisciplina?>&codTurma=<?php echo $codTurma ?>" target='_blank' id='btn_imprimir_verso'>Verso</a></p>
</div>
<?php }?>
