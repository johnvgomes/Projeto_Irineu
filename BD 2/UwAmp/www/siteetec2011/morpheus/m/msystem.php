<!DOCTYPE html> 
<html> 
<?php include "cabecalho.php"; ?>

<body> 

<div data-role="page">

	<div data-role="header">
		<a href="disciplinas.php" data-icon="arrow-l" data-theme="b">Voltar</a>
		<h1>IMC (1G)</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<img src="http://etecia.com.br/morpheus/logo_morpheus_tmb.png" alt="logo Morpheus" />

		<h2>Chamada</h2>

		<div data-role="fieldcontain" style="margin: 10px;">
		    <fieldset data-role="controlgroup">
			   <label><input type="checkbox" name="checkbox-0" /> João</label>
			   <label><input type="checkbox" name="checkbox-1" /> Jose</label>
			   <label><input type="checkbox" name="checkbox-0" /> Pedro</label>
			   <?php for ($i=0;$i<20;$i++) { ?>
			   <label><input type="checkbox" name="checkbox-0" /> Marcos</label>
			   <?php } ?>
		    </fieldset>
		</div>	

		
	</div><!-- /content -->


<?php include "rodape.php"; ?>

</div><!-- /page -->

</body>
</html>