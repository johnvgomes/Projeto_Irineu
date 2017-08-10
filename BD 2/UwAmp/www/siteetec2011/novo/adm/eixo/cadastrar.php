<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){
?>

<script type="text/javascript" src="../editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "simple",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "newdocument,styleselect,formatselect,fontselect,fontsizeselect ,bold,italic,underline,strikethrough",
		theme_advanced_buttons2 : "bullist,numlist,|,undo,redo,|,charmap,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,code,styleprops,|,media,image,advhr,|,fullscreen",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<form action="" method="post" enctype="multipart/form-data">
                      <table width="400" border="0" cellspacing="5" cellpadding="1">
                        <tr>
                          <td colspan="2"><h3>Formul&aacute;rio de Cadastro de Eixo</h3></td>
                        </tr>
                        <tr>
                          <td>Eixo:</td>
                          <td><input name="txteixo" type="text" value="" maxlength="60"></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><input name="enviar" type="submit" value="enviar" /></td>
                        </tr>
                      </table>
                 </form>
<?php
//cadastrar.php salvo na pasta adm/eixo
if(!empty($_POST['txteixo']) && isset($_POST['enviar'])){
    //instanciando a class
    require_once '../class/Eixo.php';
    @$e = new Eixo();
    @$e->setEixo($_POST['txteixo']);
    @$e->cadastrar();
    header("Location:?p=eixo/consultar.php");
}else{
    echo 'Preencha todos os campos';
}

}
?>