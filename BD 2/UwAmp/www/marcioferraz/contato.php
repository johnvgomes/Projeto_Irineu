<div class="esquerda">
    <a href="<?php echo $url->getBase(); ?>home" title="Pagina Principal" >Página Inicial</a> >
    <span class="aumentar">Fale Conosco</span>

</div>
<div class="direita">
    <h3>Entre em contato</h3>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3665.0083280093427!2d-47.2784516!3d-23.2791471!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cf455b5c6f1b73%3A0x121ce283b1a33fc7!2sR.+T%C3%A9rcio+Paes+Leite%2C+153+-+Jardim+Aeroporto+I%2C+Itu+-+SP%2C+Rep%C3%BAblica+Federativa+do+Brasil!5e0!3m2!1spt-BR!2s!4v1407846997778" width="400" height="300" frameborder="0" style="border:0"></iframe>
</div>


<div class="col_w420 float_l">
    <div id="contact_form">


        <form method="post" name="contact" action="#" >

            <label for="author">Nome:</label> <input type="text" id="author" name="txtnome" class="required input_field" />
            <div class="cleaner_h10"></div>

            <label for="email">Email:</label> <input type="text" id="email" name="txtemail" class="validate-email required input_field" />
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

    $envio = mail("marcio.ferraz@etec.sp.gov.br", $txtassunto, $mensagem, $cabecalho, $txtemail);

    if ($envio) {
        echo "Mensagem enviada com sucesso. " . $txtnome . ", obrigado!";
    } else {
        echo "Erro no envio";
    }
}
?>




