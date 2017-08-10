<!DOCTYPE html> 
<html> 
<?php include "cabecalho.php"; ?>

<body> 

<div data-role="page">

	<div data-role="header">
		<a href="disciplinas.php" data-icon="arrow-l" data-theme="b">Voltar</a>
		<h1>IMC (1G)</h1>
		<a href="disciplinas.php" data-icon="gear" data-theme="b">Aval.</a>
	</div><!-- /header -->

	<div data-role="content">	
		<img src="http://etecia.com.br/morpheus/logo_morpheus_tmb.png" alt="logo Morpheus" />

		<h2>Menções da Avaliação - Prova Prática</h2>

		<?php for ($i=0; $i < 20 ; $i++) { ?>
		<div class="ui-grid-a">
			<div class="ui-block-a">
				<button data-theme="c">José <?php echo $i; ?></button>
			</div>
			<div class="ui-block-b">
				<select name="select-choice-a" id="select-choice-a" data-native-menu="false" tabindex="-1">
					<option data-placeholder="true">Menção</option>
					<option value="MB">MB</option>
					<option value="B">B</option>
					<option value="R">R</option>
					<option value="I">I</option>
				</select>	
			</div>
		</div><!-- /grid-a -->
		<?php } ?>
	</div><!-- /content -->
<br />
<br />
<br />
<br />

<?php include "rodape.php"; ?>

</div><!-- /page -->

</body>
</html>