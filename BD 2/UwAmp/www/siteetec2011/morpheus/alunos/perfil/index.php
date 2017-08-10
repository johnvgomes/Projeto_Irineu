<?php 

echo "Ops. Estamos fechados no momento.";
exit();

session_name('jcLogin');
session_start();

if(!$_SESSION['id'] || $_SESSION["tipo"]!="aluno"){
        ?>
        <div class="ui-widget">
                <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
                        <strong>Acesso Negado: </strong>Você precisa estar logado como aluno para acessar essa página.
                        <a href="../index.php">Fazer Login</a></p>
                </div>
        </div>
        <?php
        
        exit();
}

$codAluno = $_SESSION["id"];

include "../../conexao/conn.php";

$sql = "SELECT * FROM Alunos WHERE codAluno=$codAluno";
$rsAluno = mysql_query($sql);


?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../../jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="../../jquery/jquery-1.6.min.js"></script>
<script type="text/javascript" src="../../jquery/jquery.easyui.min.js"></script>   
<link rel="stylesheet" type="text/css" href="../../jquery/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../jquery/themes/icon.css">

<link type="text/css" href="../jquery/css/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" />    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favico.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="keywords" content="Semantic forms, standards, webstandards, semantically, horizontal forms">
<meta name="author" content="Chris Ramakers @ Skyrocket.be">
<title>ETECIA - Atualização de Perfil de Aluno</title>
<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript">
        $(function(){

                function validarSenha(){
                        var status = true;
                        if($("#password2").val()!=$("#password1").val()) {
                                $("#erro1").show();
                                $("#pt2").addClass("error");
                                status = false;
                        }else{
                                $("#erro1").hide();
                                $("#pt2").removeClass("error");
                        }
                        if($("#password2").val().length<6 || $("#password2").val().length>15 || $("#password1").val().length<6 || $("#password1").val().length>15){
                                $("#erro2").show();
                                $("#pt2").addClass("error");
                                status = false;
                        }else{
                                $("#erro2").hide();
                                $("#pt2").removeClass("error");
                        }    
                        return status;
                }

                function validarEmail(){
                       var status = true;
                       var sEmail = $("#email").val();
                        // filtros
                        var emailFilter=/^.+@.+\..{2,}$/;
                        var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
                        // condição
                        if(!(emailFilter.test(sEmail))||sEmail.match(illegalChars)){
                                $("#erro3").show();
                                $("#pt3").addClass("error");
                                status = false;
                        }else{
                                $("#erro3").hide();
                                $("#pt3").removeClass("error");
                        } 
                        return status;
                }
                
                $("#password2").change(function(){
                        validarSenha();
                });

                $("#email").change(function(){
                        validarEmail();

                });

                $("#submitform").click(function(){
                        if(validarSenha() & validarEmail()) {
                               $.post("gravar_alunos.php", $("#theform").serialize() )
                                .error(function() { $.messager.alert("Erro", "Erro ao gravar dados", "error"); })
                                .success(function(){ 
                                        $.messager.alert("Sucesso", "Dados gravados com sucesso.", "info");

                                }); 

                        }
                                
                        

                });
                
        });

</script>

<!--[if IE]>
<style type="text/css">
#theform #pt4 {
        padding: 2em 1em 1em 1em;
        }
</style>
<![endif]-->

</head>

<body>
<h1>Atualizar perfil de aluno</h1>
 
<h2>Utilize o campo abaixo para atualizar os seus dados no sistema ETECIA.</h2>

<form id="theform" enctype="multipart/form-data" method="post">
        <input type="hidden" name="codaluno" value='<?php echo $codAluno; ?>'>
        <fieldset id="pt1">
                <legend><span>Step </span>1. <span>: Nome</span></legend>
                <h3>Confira o seu nome</h3>
                <label for="loginname">Nome completo</label>
                <input type="text" id="loginname" tabindex="1" value='<?php echo mysql_result($rsAluno, 0, "nomeAluno"); ?>' readonly="readonly">
        </fieldset>
        <fieldset id="pt2">
                <legend><span>Step </span>2. <span>: Password</span></legend>
                <h3>Altere a sua senha atual.</h3>
                <div class="help">A senha deve ter entre 6 e 15 caracteres.</div>
                <strong class="error" id="erro1" style="display:none">As senhas não conferem.</strong>
                <strong class="error" id="erro2" style="display:none">Tamanho da senha é inválido</strong>
                <label for="password1">Senha</label>
                <input type="password" id="password1" tabindex="2">
                <label for="password2">Confirmar Senha</label>
                <input name="password" type="password" id="password2" tabindex="3">
        </fieldset>
        <fieldset id="pt3">
                <legend><span>Step </span>3. <span>: Email details</span></legend>
                <h3>Informe o seu e-mail.</h3>
                <div class="help">Você deve informar um e-mail válido</div>
                <strong class="error" id="erro3" style="display:none">Email inválido.</strong>
                <label for="email">Email</label>
                <input name="email" type="text" id="email" tabindex="4" value="<?php echo mysql_result($rsAluno, 0, 'email') ?>">
                
        </fieldset>
        <fieldset id="pt4">
                <legend>Step 4  : Submit form</legend>
                <h3>Terms of Service</h3>
                <div id="disclaimer">Ao clicar em "Salvar" a sua senha será alterada.
                Essa ação é irreversível.</div>
                <input type="button" id="submitform" tabindex="6" value="Salvar »">
        </fieldset>
        <div id="copyright"></div>
</form>
</body></html>