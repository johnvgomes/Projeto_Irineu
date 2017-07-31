<title>CHECKIT-Comunidade</title>
<meta charset="UTF-8">
<link href="<?php echo $url->getBase(); ?>css/estilo.css" 
      type="text/css" rel="stylesheet">

<script language="JavaScript" type="text/javascript" 
        src="<?php echo $url->getBase(); ?>js/MascaraValidacao.js">
</script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" 
      href="<?php echo $url->getBase(); ?>css/styles.css">
<link rel="shortcut icon" href="../imagem/ICON CHECKIT/Logo/Logo_roxinho_P.png">  
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<script src="<?php echo $url->getBase(); ?>js/script.js"></script>

<script type="text/javascript" src="<?php echo $url->getBase(); ?>editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
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