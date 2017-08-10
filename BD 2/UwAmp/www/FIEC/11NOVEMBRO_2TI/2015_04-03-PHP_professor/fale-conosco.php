<script src="js/mtel.js"></script>
<h3>Fale Conosco</h3>

<form name="formenvio" id="form" method="post">
    <label>Nome</label><br>
    <input type="text" name="txtnome" id="txtnome" 
           maxlength="40"  required><br><br>

    <label>Email</label><br>
    <input type="email" name="txtemail" ><br><br>

    <label>Telefone</label><br>
    <input type="text" name="txttel" 
           maxlength="14" onkeyup="mascara(this,mtel);"><br><br>

    <label>Destino</label><br>
    <select name="cbodestino" id="select">
        <option value="duvida@empresa.com">Dúvidas</option>
        <option value="contato@empresa.com">Sugestões</option>
        <option value="orc@empresa.com">Orçamento</option>
    </select><br><br>

    <label>Mensagem</label><br>
    <textarea name="txtmsg" rows="3" id="txt"
              cols="50">
    </textarea><br><br>

    <input type="submit" name="enviar" value="Enviar"
           id="enviar">

</form>
<?php
if (isset($_POST['enviar'])) {
    extract($_POST, EXTR_OVERWRITE);

    $mensagem = "Mensagem enviada em ";
    $mensagem .= date("d/m/Y");
    $mensagem .= "<br>Empresa XYZ";
    $mensagem .= "<br>Nome: ";
    $mensagem .= $txtnome;
    $mensagem .= "<br>Email: ";
    $mensagem .= $txtemail;
    $mensagem .= "<br>" . $txtmsg;

    $headers = "MIME-Version: 1.1\n";
    $headers .= "Content-type: text/html";
    $headers .= " charset=utf-8\n";
    $headers .= "From: $txtemail\n";
    $headers .= "Return-Path: $txtemail\n";
    $headers .= "Reply-To: $txtemail\n";
    /* 1º quem recebe?
     * 2º assunto
     * 3º mensagem
     * 4º informações ocultas
     * 5º quem enviou?
     */
    $envio = mail($cbodestino, 
            "Envio de mensagem do site", 
            $mensagem, $headers, $txtemail
    );
    
    if ($envio) {
        echo "Mensagem enviada com sucesso";
    } else {
        echo "Falha no envio";
    }
}
?>