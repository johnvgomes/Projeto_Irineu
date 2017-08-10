<link href="css/contato.css" rel="stylesheet" type="text/css" />

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

<form id="frm" name="frm" method="post" action="">
    <h3>Fale Conosco</h3>

    <label >Mensagem para:</label>
    <select name="caixa" id="select" required>
        <option value="marli.oliveir@etec.sp.gov.br" selected>D&uacute;vidas/Sugest&otilde;es</option>
        <option value="eteitu@uol.com.br">Secretaria Academica</option>
        <option value="eteitudirecao1@uol.com.br">Coordena&ccedil;&atilde;o Pedag&oacute;gica</option>
        <option value="op86@centropaulasouza.sp.gov.br">Diretoria Administrativa</option>
        <option value="dp@etecitu.com.br">Departamento Pessoal</option>
        <option value="eteitu@uol.com.br">Vestibulinho</option>
        <option value="eteitudirecao1@uol.com.br">Dire&ccedil;&atilde;o Geral</option>
        <option value="marcio.ferraz@etec.sp.gov.br">Sobre o site</option>
    </select>

    <br /><br />
    <label>Nome:</label>
    <input name="txtnome" type="text" id="txtnome" size="50" maxlength="70" />

    <label>E-mail:</label>
    <input name="txtemail" type="email" id="txtemail" size="50" maxlength="50" />

    <label>Escreva sua mensagem abaixo:</label><br />
    <textarea name="txtmsg" id="txtmsg" cols="50" rows></textarea>

    
    <input type="submit" name="btcad" value="Enviar" id="btcad" />
</form>

<?php
if(isset($_POST['btcad'])){
    if (empty($_POST['txtnome'])){
            echo "Informe seu nome";
    }elseif(empty($_POST['txtemail']) && strstr($_POST['txtemail'], '@')==false){
        echo "Preencha corretamente seu e-mail!";		
    }elseif(empty($_POST['txtmsg'])){
        echo "Preencha a mensagem";		
    }else{
        
        $email_remetente=$_POST['txtemail'];
        $to      = $_POST['caixa'];//para
        $subject = 'ETEC Itu - site';//assunto
        $message = "Mensagem enviada em ".date("d/m/Y").", Etec de Itu - dados seguem abaixo:<br />".
                "Nome: ".$_POST['txtnome']."<br />".
                "E-mail: ".$_POST['txtemail']."<br />".
                $_POST['txtmsg'];
        $headers = "MIME-Version: 1.1\n";
        $headers .= "Content-type: text/html; charset=utf-8\n";
        $headers .= "From: $email_remetente\n"; // remetente
        $headers .= "Return-Path: ".$_POST['txtemail']."\n"; // return-path
        $headers .= "Reply-To: ".$_POST['txtemail']."\n"; 
       
        $envio = mail($to, $subject, $message, $headers,"-f$email_remetente");

        if($envio)
             echo "<br />".$_POST['txtnome']." seu e-mail foi enviado com sucesso<br />
            Voce utilizou o email: " .$_POST['txtemail']."<br />";  
        else
            echo "A mensagem nao pode ser enviada";
    }
}
?>
