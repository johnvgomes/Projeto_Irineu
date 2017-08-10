<?php 

include '../../conexao/conn.php';

$codDisciplina = $_GET["codDisciplina"];
$codSerie =   $_GET["codSerie"];
$codEtapa = $_GET["codEtapa"];

?>	

<script>
	$(function() {
		$( "input:button").button()
		.click(function() {
			var idatrib = $(this).attr('id');
	        $.post('apagar_atribuicao.php',{id:idatrib},function(result){
				if (result.success){
					$("#atribuidas").load("atribuidas.php?codDisciplina=<?php echo $codDisciplina?>&codSerie=<?php echo $codSerie?>&codEtapa=<?php echo $codEtapa?>");
					
				} else {
					alert( result.msg);
				}
			},'json');
		});	
	});
		
	</script><br>
	<div class="ui-widget" style="font-size:14">
		<h3>Professores: </h3>
<?php


$rsAtrib = mysql_query("SELECT Atribuicoes.*, Professores.nomeProfessor 
						FROM Atribuicoes 
						INNER JOIN Professores ON Atribuicoes.codProfessor=Professores.codProfessor 
						WHERE codDisciplina=$codDisciplina 
						AND codSerie=$codSerie
						AND codEtapa=$codEtapa");
echo mysql_error();
while ($row = mysql_fetch_array($rsAtrib))
{
	$id=$row["codAtribuicao"];
	echo "<br>";
	echo "<input id='$id' type='button' style='font-size:10' onclick='apagarAtribuida(1)' value='apagar'/> ";
	echo $row["nomeProfessor"];
}

?>

</div>
