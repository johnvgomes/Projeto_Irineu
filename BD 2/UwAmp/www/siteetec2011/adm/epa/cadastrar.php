<?php


require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Eixo.php';
$e = new Eixo;
?>

<script type="text/javascript" src="editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
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

<form action="" method="post" name="form" id="form">
<table>
    <tr>
        <td colspan="2"><h3>Formulário de Cadastro de Oficina - EPA</h3></td>
    </tr>
    <tr>
        <td>T&iacute;tulo:</td>
        <td>
            <input name="txttitulo" type="text" id="txttitulo" size="50" maxlength="70" />
        </td>
    </tr>
    <tr>
        <td>Conte&uacute;do:</td>
        <td>
            <textarea name="txtconteudo" id="text" cols="50" rows="3"></textarea>
        </td>
    </tr>
    <tr>
        <td>Data:</td>
        <td>
            <input name="txtdata" type="text" id="txtdata" size="50" maxlength="20" />
        </td>
    </tr>
    <tr>
        <td>Horario:</td>
        <td>
            <input name="txthorario" type="text" id="txthorario" size="50" maxlength="20" />
        </td>
    </tr>
    <tr>
        <td>Eixo Tecnol&oacute;ligo:</td>
        <td>
            <select name="cbeixo" id="select">
                <?php $e->carregarEixo(); ?>
            </select>
        </td>
     </tr>
    <tr>
        <td>
            <input type="submit" name="cadastrar" id="cadastrar" value="cadastrar" />
        </td>
    </tr>
</table>
</form>

<?php

if(isset($_POST['cadastrar']) && !empty($_POST['txttitulo']) && !empty($_POST['txtconteudo'])){
    require_once '../class/Oficina.php';
    
    $o = new Oficina($_POST['txttitulo'], $_POST['txtconteudo']
            , $_POST['txtdata'], $_POST['txthorario'],            $_POST['cbeixo']);
    
    $o->cadastrar();

    echo "<h3>Cadastro efetuado com sucesso!</h3>";
}
}
?>