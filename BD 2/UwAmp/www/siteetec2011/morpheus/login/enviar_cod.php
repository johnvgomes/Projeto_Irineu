<?php

$email = $_REQUEST['email'];


$sql = "SELECT * FROM Professores WHERE email='$email'";
include '../conexao/conn.php';

$result = @mysql_query($sql);

function send_mail($from,$to,$subject,$body)
{
/* Medida preventiva para evitar que outros domínios sejam remetente da sua mensagem. */
if (eregi('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
        $emailsender='sistema@etecia.com.br'; // Substitua essa linha pelo seu e-mail@seudominio
} else {
        $emailsender = "sistema@" . $_SERVER[HTTP_HOST];
        //    Na linha acima estamos forçando que o remetente seja 'webmaster@seudominio',
        // Você pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
}
 
/* Verifica qual éo sistema operacional do servidor para ajustar o cabeçalho de forma correta.  */
if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
else $quebra_linha = "\n"; //Se "nÃ£o for Windows"
 
// Passando os dados obtidos pelo formulário para as variáveis abaixo
$nomeremetente     = "Sistema de notas";
$emailremetente    = "sistema@etecia.com.br";
$emaildestinatario = $to;
$comcopia          = "";
$comcopiaoculta    = "joaocarloslima@me.com";
$assunto           = "Recuperação de senha";
$mensagem          = "";
 
 
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = $body;
 
 
/* Montando o cabeÃ§alho da mensagem */
$headers = "MIME-Version: 1.1" .$quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: " . $emailsender.$quebra_linha;
$headers .= "Cc: " . $comcopia . $quebra_linha;
$headers .= "Bcc: " . $comcopiaoculta . $quebra_linha;
$headers .= "Reply-To: " . $emailremetente . $quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
 
/* Enviando a mensagem */

//É obrigatório o uso do parâmetro -r (concatenação do "From na linha de envio"), aqui na Locaweb:

if(!mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
    //mail($emaildestinatario, $assunto, $mensagemHTML, $headers );
}
 

}

$sucess = false;
if (mysql_num_rows($result)>0){

	$r = mysql_fetch_array($result);

		$email = $r["email"];
		$login = $r["login"];
		$nome = $r["nomeProfessor"];
		$codprof = $r["codProfessor"];
		if ($email!=""){
			$pass = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$codprof = $r["codProfessor"];
			$sqlUpdate = "UPDATE Professores set senha=md5('$pass') WHERE codProfessor=$codprof";
			mysql_query($sqlUpdate);
			//echo $sqlUpdate."<br>";
			//echo mysql_error()."<br>";
			send_mail(	'robot@etecia.com.br',
						$email,
						'Sistema de Notas',
						'Ol&aacute; professor(a),<br><br>'.
						'Voc&ecirc; est&aacute; recebendo a sua nova senha para acesso ao sistema de notas.<br>'.
						'Voc&ecirc; pode alterar a sua senha se preferir.<br>'.
						'Seguem seus dados de acesso:<br>'.
						'<b>Nome de usu&aacute;rio:</b> '.$login.
						'<br><b>Senha:</b> '.$pass.
						'<br><b>Site: </b>http://etecia.com.br'.
						'<br><br><i>Recomendamos o uso dos navegadores Chrome ou Firefox</i>'
						);
			$msg = "Olá $nome. Foi enviada para o seu e-mail uma nova senha de acesso. Você pode alterar a senha nos campos abaixo. Para isso, utilize a senha enviada por e-mail.";
			$sucess  = true;

		}else{
			$msg = "Esse e-mail não está cadastrado no sistema." . $sql;
		}
	 /*send_mail(	'morpheus@capeladosocorro.com.br',
						$_POST['email'],
						'Sistema Morpheus - Registro de senha',
						'Sua senha é: '.$pass);
						*/
}else{
	$msg = "Esse e-mail não está cadastrado no sistema. Procure a secretaria para completar o seu cadastro.";
}


echo json_encode(array('msg'=>$msg, 'sucess'=>$sucess, 'cod'=>$codprof ));


?>

