	<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="../../jquery/jquery.easyui.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../jquery/themes/icon.css">
	<link type="text/css" href="../../jquery/css/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	
	<style type="text/css">
	.accordion .accordion-header{
		background:#fafafa;
	}
	.accordion .accordion-header-selected{
		background:url('../images/nav.png') center bottom no-repeat;
		height:35px;
		border:0;
	}
	.pitem{
		list-style-type:none;
		margin:0;
		padding:2px 0 10px 20px;
	}
	.pitem li{
		font-size:12px;
		line-height:18px;
	}
	.demo-c{
		width:740px;
		height:550px;
		float:right;
		background:#fff;
		border:1px solid #ccc;
		border-radius:5px;
		-moz-border-radius:5px;
		-webkit-border-radius: 5px;
	}
</style>
<style>
	.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
</style>
<script type="text/javascript">
	$(function(){
		$("#por_aluno").load("frame_ficha.php?por=aluno");
		$("#por_turma").load("frame_ficha.php?por=turma");
		
		var serie;
		$('#mm').accordion('select','Application');

		$("#treeTurmas").tree({
			onClick: function(id, text, checked, attributes, target){  

				var turma = $('#treeTurmas').tree('getSelected').text;
				//var turma = $(this).html();
				var array_turma = turma.split("#");
				var cod_turma = array_turma[2];
				
				
				var node = $('#treeTurmas').tree('getSelected');
				var busca = node.text.substring(0, 5);
				//var turma = node.text.substring(node.text.length - 2);

				if (busca == "Inter" ) $("#main_conselho").load("frame_conselho.php?etapa=I&turma="+cod_turma);
				if (busca == "2 Int" ) $("#main_conselho").load("frame_conselho.php?etapa=2&turma="+cod_turma);
				if (busca == "3 Int" ) $("#main_conselho").load("frame_conselho.php?etapa=3&turma="+cod_turma);
				if (busca =="Final" ) $("#main_conselho").load("frame_conselho.php?etapa=F&turma="+cod_turma);
				//alert(cod_turma);
				}  
		});

	});

</script>

<div class="easyui-layout" style="width:100%;height:600px;">

       <div region="west" split="true" title="Turmas" style="width:200px;">
		   <?php include "get_tree_turmas.php";?>
       </div>
       <div region="center" title="Ata do Conselho" style="background:#fafafa;overflow:hidden">
           <div id="main_conselho"></div>
       </div>
</div>
