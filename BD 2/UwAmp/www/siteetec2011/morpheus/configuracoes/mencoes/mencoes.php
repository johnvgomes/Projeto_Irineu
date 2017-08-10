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
		$( "#permissoes").load('frame_permissoes.php');
		$("#treeTurmas").tree({
			onClick: function(id, text, checked, attributes, target){  
				var node = $('#treeTurmas').tree('getSelected');
				if (node.text.length==2 ) $("#main_mencoes").load("frame_mencoes.php?turma="+node.text);
				}  
		});


	});

</script>

<div class="easyui-layout" style="width:1100px;height:600px;">

        <div region="west" split="true" title="Turmas" style="width:200px;">
		   <?php include "get_tree_turmas.php"?>
        </div>
        <div region="center" title="Entrega de Menções" style="background:#fafafa;overflow:hidden">
            <div id="main_mencoes"></div>
        </div>
       
        <div id="permissoes" region="east" title="Permissões" split="true" style="width:400px;">
        
        </div>     
    </div>