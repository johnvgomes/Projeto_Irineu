
<div class="direita">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3669.989396495698!2d-47.228868999999996!3d-23.097483999999998!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8b34b7fce5ac3%3A0x34bb4bcb22fc5f49!2sFIEC+%2F+CEPIN+-+Unidade+I!5e0!3m2!1spt-BR!2sbr!4v1415641153298" width="100%" height="400" frameborder="0" style="border:0"></iframe>
</div>
<h3>Fale Conosco</h3>
<div class="pgcontato">


    <div class="col_w420 float_l">
        <div id="contact_form">


            <form method="post" name="contact" action="#" >


                <label for="author">Nome:</label> <input type="text" id="author" name="txtnome" class="required input_field" />
                <div class="cleaner_h10"></div>

                <label for="email">Email:</label> <input type="text" id="email" name="txtemail" class="validate-email required input_field" />
                <div class="cleaner_h10"></div>
                
                <label for="destino">Destinatário:</label> 
                <select class="validate-email required input_field" name="destino">
                    <option>Escolha um email</option>
                    <option value="eteitudirecao1@uol.com.br">Direção</option>
                    <option value="eteitu@uol.com.br">Secretaria</option>
                    <option value="eteitu@uol.com.br">Vestibulinho</option>
                    <option value="dp@etecitu.com.br">RH</option>
                    <option value="eteitu@uol.com.br">Dúvidas Gerais</option>
                </select>
                <div class="cleaner_h10"></div>

                <label for="subject">Assunto:</label> <input type="text" name="txtassunto" id="subject" class="input_field" />
                <div class="cleaner_h10"></div>

                <label for="text">Mensagem:</label> <textarea id="text" name="txtmsg" rows="0" cols="0" class="required"></textarea>
                <div class="cleaner_h10"></div>

                <input type="submit" class="submit_btn float_l" name="btnenviar" id="submit" value="Enviar" />
                <input type="reset" class="submit_btn float_r" name="btnlimpar" id="reset" value="Limpar" />

            </form>

        </div>
    </div>
</div>
<?php
if (isset($_POST['btnenviar']) &&
        !empty($_POST['txtnome'])) {
    extract($_POST, EXTR_OVERWRITE);

    $mensagem = "Mensagem enviada em " . date("d/m/Y");
    $mensagem .= "<br>Nome: " . $txtnome;
    $mensagem .= "<br>E-mail: " . $txtemail;
    $mensagem .= "<br>Assunto: " . $txtassunto;
    $mensagem .= "<br>Mensagem: " . $txtmsg;

    $cabecalho = "MIME-Version: 1.1\n";
    $cabecalho .= "Content-type: text/html; charset=utf-8\n";
    $cabecalho .= "From: " . $txtemail . "\n";
    $cabecalho .= "Return-Path: " . $txtemail . "\n";
    $cabecalho .= "Reply-To: " . $txtemail . "\n";

    $envio = mail($destino, $txtassunto, $mensagem, $cabecalho, $txtemail);

    if ($envio) {
        echo "Mensagem enviada com sucesso. " . $txtnome . ", obrigado!";
    } else {
        echo "Erro no envio";
    }
}
?>




