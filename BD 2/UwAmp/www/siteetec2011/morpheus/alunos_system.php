<?php
session_name('jcLogin');
session_start();

if(!($_SESSION['id']) || ($_SESSION['tipo']!="aluno")){
	header("Location: ../index.php");
	exit;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-BR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>ETECIA – Morpheus</title>
	<link rel="shortcut icon" href="favicon.gif" type="image/x-icon">
	<link rel="stylesheet" id="wp-admin-css" href="http://etecia.com.br/portaletecia/wp-admin/css/wp-admin.css?ver=3.4.1" type="text/css" media="all">
	<link rel="stylesheet" id="colors-fresh-css" href="http://etecia.com.br/portaletecia/wp-admin/css/colors-fresh.css?ver=3.4.1" type="text/css" media="all">
	<link type="text/css" href="includes/jquery/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css" >
	<script type="text/javascript" src="includes/jquery/js/jquery.ui.datepicker-pt-BR.js"></script>
	<script type="text/javascript" src="includes/jquery/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="includes/jquery/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script type="text/javascript" src="includes/bootstrap/js/bootstrap-tooltip.js"></script>

</head>
<script type="text/javascript">
	$(function(){
		$('.indisponivel').css("color:red");


		$('#tabs').tabs();
		$("#tabsconteudo" ).tabs( "option", "cache", false );
		$("#tabschamada, #tabsconteudo, #tabsboletim, #tabsavaliacoes").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
		$("#tabschamada li, #tabsconteudo li, #tabsboletim li, #tabsavaliacoes li").removeClass('ui-corner-top').addClass('ui-corner-left');
		$("#tabschamada, #tabsconteudo, #tabsboletim, #tabsavaliacoes").tabs({
		      spinner: "",
		      select: function(event, ui) {
		      	$(ui.panel).html("<b>Carregando lista . . .</b>");
		        //var tabID = "#ui-tabs-" + (ui.index + 1);
		        //$(tabID).html("<b>Carregando lista . . .</b>");
		      }
		 });
		$('#radio_mes').buttonset().change(function(){
			//gravar o mes na seção e atualizar a aba da disciplina selecionada
			var mes = $("input:radio[name='mes']:checked").val()==undefined?"":$("input:radio[name='mes']:checked").val();
			$.post("chamada/gravar_mes.php", { mes: mes } );
			var selected = $( "#tabschamada" ).tabs( "option", "selected" );
			$("#tabschamada").tabs( "load" , selected);
			
		});


	});
</script>

<style type="text/css">
/* menu lateral
----------------------------------*/
.ui-tabs-vertical { width: 55em; border:0; }
.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 0px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 0px; border-right-width: 0px; }
.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 40em;}
</style>

<body style="top-margin:0px">

	<img src="logo_morpheus_tmb.png" style="float:left" >
	<p style="text-align: right;">
		Olá, <?php echo $_SESSION["usr"]; ?> <a href="login/logar.php?logoff=1">[Sair]</a></p>
	<div style="clear:both"></div>
		<?php if ($_SESSION["tipo"]=="aluno"){ ?>
			<div id="tabs">
				<ul>
					<li><a href="#notas">Notas</a></li>
					<li><a href="#frequencia">Frequência</a></li>
					<li><a href="#conteudos">Conteúdos</a></li>
					<li><a href="#perfil">Perfil</a></li>
					<li><a href="#avaliacao">Avaliação de Curso</a></li>
				</ul>
				<div id="notas"><?php require "alunos/index.php"; ?></div>
				<div id="frequencia"><?php require "alunos/frequencia.php"; ?></div>
				<div id="conteudos"><?php require "alunos/conteudos.php"; ?></div>
				<div id="perfil">Ops. Estamos fechados no momento. [faz tempo]</div>
				<div id="avaliacao"><?php include "avaliacao/index2.php" ?></div>
			</div>

		<?php } elseif ($_SESSION["tipo"]=="professor") { ?>
		
			<div id="tabs">
				<ul>
					<li><a href="#chamada">Chamada</a></li>
					<li><a href="#conteudos">Conteúdos</a></li>
					<li><a href="#avaliacoes">Avaliações</a></li>
					<li><a href="#notas">Notas</a></li>
					<li><a href="#avaliacao">Avaliação de Curso</a></li>
					<?php if ($_SESSION["perfil"]==1) echo "<li><a href='#secretaria'>Secretaria</a></li>"; ?>
				</ul>
				<div id="chamada"><?php include "chamada/chamada.php" ?></div>
				<div id="conteudos"><?php include "chamada/conteudos.php" ?></div>
				<div id="notas"><?php include "new_notas/index.php" ?></div>
				<div id="avaliacoes"><?php include "new_notas/avaliacoes.php" ?></div>
				<div id="avaliacao">Recurso indisponível</div>
				<?php if ($_SESSION["perfil"]==1){ ?>
					<div id="secretaria"><IFRAME frameBorder=0 height='800px' width='100%' marginHeight=0 marginWidth=0 src="configuracoes.php" BORDERCOLOR="#FFFFFF"></IFRAME></div>
				<?php } // se perfil = 1?>
			</div>
		<?php } // se tipo=professor?>
</body>