<?php
/*Esse script cria senha aleatórias para todos os professores que não são administradores e envia
para o e-mail cadastrado juntamente com o login para que façam acesso no sistema.
*/
include 'conexao/conn.php';

function send_mail($from,$to,$subject,$body)
{
	$headers = '';
	$headers .= "From: $from\n";
	$headers .= "Reply-to: $from\n";
	$headers .= "Return-Path: $from\n";
	$headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html;charset=UTF-8\n";
	$headers .= "Date: " . date('r', time()) . "\n";
	
	mail($to,$subject,$body,$headers);
}
if ($_GET["confirm"]==1){

	$sql = "SELECT * FROM Professores WHERE perfil=0";
	$rs = mysql_query($sql);
	while ($r = mysql_fetch_array($rs)){
		
		$email = $r["email"];
		$login = $r["login"];
		if ($email!=""){
			$pass = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$codprof = $r["codProfessor"];
			$sqlUpdate = "UPDATE Professores set senha=md5('$pass') WHERE codProfessor=$codprof";
			mysql_query($sqlUpdate);
			echo $sqlUpdate."<br>";
			echo mysql_error()."<br>";
			send_mail(	'henrique.mais@hotmail.com',
						$email,
						'Sistema de Notas',
						'Olá professor(a),<br><br>'.
						'Já está no ar o novo sistema de notas da Etec Irmã Agostina.<br>'.
						'Ele foi totalmente reformulado para facilitar a digitação de notas.<br>'.
						'Seguem seus dados de acesso:<br>'.
						'<b>Nome de usuário:</b> '.$login.
						'<br><b>Senha:</b> '.$pass.
						'<br><b>Site: </b>http://etecia.com.br'.
						'<br><br><i>Recomendamos o uso dos navegadores Chrome ou Firefox</i>'
						);

		}
	}
	 /*send_mail(	'morpheus@capeladosocorro.com.br',
						$_POST['email'],
						'Sistema Morpheus - Registro de senha',
						'Sua senha é: '.$pass);
						*/
}else{

?>

<form action="script_enviar_senha.php?confirm=1" method="post">
Confirma a redefinição de senha e envio de e-mail para todos os professores cadastrados?<br><br>
Essa ação não poderá ser desfeita.
<input type="submit" value="confirmar" />
</form>

<?php 
}
?>
