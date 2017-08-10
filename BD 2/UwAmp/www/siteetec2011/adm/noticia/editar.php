<?php

include_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

include_once '../class/Noticia.php';
require_once '../class/Controles.php';
$n = new Noticia();
$co = new Controles();
$id = (int) $co->limparTexto($_GET['id']);
$array = $n->carregarID($id);
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
<form action="" method="post" name="frmcadPart" id="frmcadPart">
<table>
    <tr>
        <td colspan="2"><h3>Editar Not&iacute;cia</h3></td>
    </tr>
    <tr>
        <td>T&iacute;tulo:</td>
        <td>
            <input name="txttitulo" type="text" id="txttitulo" size="50" maxlength="70" value="<?php echo $array[1]; ?>" />
        </td>
    </tr>
    <tr>
        <td>Legenda:</td>
        <td>
            <input name="txtlegenda" type="text" id="txtlegenda" size="50" maxlength="70" value="<?php echo $array[6]; ?>" />
        </td>
    </tr>
    <tr>
        <td>Conte&uacute;do:</td>
        <td>
            <textarea name="txtconteudo" id="text" cols="50" rows="3">
                <?php echo $array[2]; ?>
            </textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="cadastrar" id="cadastrar" value="cadastrar" />
        </td>
    </tr>
</table>
    
</form>

<?php
    if (isset($_POST['cadastrar'])){
        $n->editar($id,$_POST['txttitulo'],$_POST['txtconteudo'],$_POST['txtlegenda']);
        //header('Location:?p=noticia/consultar.php');
        echo '<meta http-equiv="refresh" content="1;URL=?p=noticia/consultar.php">';
    }
}
?>