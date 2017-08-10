<title>PHP 04/03/2015</title>
<meta charset="UTF-8">

<link href="css/estilo.css" type="text/css"
      rel="stylesheet">
<link href="css/footer.css" type="text/css"
      rel="stylesheet">
<link href="css/barranav.css" type="text/css"
      rel="stylesheet">
<link href="css/form.css" type="text/css"
      rel="stylesheet">

<meta name="description" 
      content="descrição do site">
<meta name="keywords" content="HTML,CSS,Site,JavaScript,PHP,
      Itu,Desenvolvimento,XHTML,manutenção, cartão,panfleto,corel,
      fireworks">
<meta name="author" content="Marcio Ferraz">
<link rel="shortcut icon" 
      href="imagem/icone.png">

<script language="JavaScript" src="js/hora.js"></script>
<script language="JavaScript" type="text/javascript" 
    src="js/MascaraValidacao.js"></script>

<?php
$hora = @date("H");

if ($hora >= 6 && $hora < 12) {
    echo '<link href="css/manha.css" type="text/css"
      rel="stylesheet">';
} else if ($hora >= 12 && $hora < 19) {
    echo '<link href="css/tarde.css" type="text/css"
      rel="stylesheet">';
} else if ($hora >= 19 && $hora <= 23) {
    echo '<link href="css/noite.css" type="text/css"
      rel="stylesheet">';
} else {
    echo '<link href="css/madrugada.css" type="text/css"
      rel="stylesheet">';
}
?>

<script type="text/javascript" src="editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode: "textareas",
        theme: "simple",
        plugins: "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
        // Theme options
        theme_advanced_buttons1: "newdocument,styleselect,formatselect,fontselect,fontsizeselect ,bold,italic,underline,strikethrough",
        theme_advanced_buttons2: "bullist,numlist,|,undo,redo,|,charmap,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,code,styleprops,|,media,image,advhr,|,fullscreen",
        theme_advanced_buttons3: "",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,
        // Example content CSS (should be your site CSS)
        content_css: "css/content.css",
        // Drop lists for link/image/media/template dialogs
        template_external_list_url: "lists/template_list.js",
        external_link_list_url: "lists/link_list.js",
        external_image_list_url: "lists/image_list.js",
        media_external_list_url: "lists/media_list.js",
        // Style formats
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        // Replace values for the template plugin
        template_replace_values: {
            username: "Some User",
            staffid: "991234"
        }
    });
</script>




