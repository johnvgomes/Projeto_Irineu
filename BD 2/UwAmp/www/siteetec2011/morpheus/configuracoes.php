<?php
session_name('jcLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
if ($_SESSION['perfil']<1) {
	header("location:index.php");
	exit();
}
?>

<?php
include "jquery.inc";

include "conexao/conn.php";

$sqlConfiguracoes = "SELECT valor FROM Configuracoes WHERE atributo='nome_escola'";
$rsConfiguracoes = mysql_query($sqlConfiguracoes);
$nome_escola = mysql_result($rsConfiguracoes, 0, "valor");
?>
<script>
	$(function() {
		$( "input:submit, a, button", ".config" ).button();
	});
</script>
<br>
<div class="ui-state-default" style="font-size: 20px">
<?php echo $nome_escola ?> - Configurações
</div>

<!-- Abas que carregam o conteúdo via Ajax -->
<script>
	$(function() {
		$( "#tabs" ).tabs({
			cache: true,
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html("Não foi possível carregar a página. ");
				}
			}
		});	
	});
</script>
<a href="login/logar.php?logoff=1">Sair</a>
<div id="tabs" style="height:700px">
	<ul>
		<li><a href="configuracoes/alunos">Alunos</a></li>
		<li><a href="configuracoes/cursos">Cursos</a></li>
		<li><a href="configuracoes/turmas">Turmas</a></li>
		<li><a href="configuracoes/periodos/">Períodos</a></li>
		<li><a href="configuracoes/etapas/">Etapas</a></li>
		<li><a href="configuracoes/series/">Séries</a></li>
		<li><a href="configuracoes/disciplinas/">Disciplinas</a></li>
		<li><a href="configuracoes/professores/">Professores</a></li>
		<li><a href="configuracoes/matriculas">Matrículas</a></li>
		<li><a href="configuracoes/atribuicoes">Atribuições</a></li>
		<li><a href="configuracoes/mencoes">Menções</a></li>
		<li><a href="configuracoes/faltas">Faltas</a></li>
		<li><a href="configuracoes/conselho">Conselho</a></li>
		<li><a href="configuracoes/pp">PP</a></li>
		<li><a href="configuracoes/estatisticas">Estatísticas</a></li>
	</ul>
</div>