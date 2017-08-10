<?php

/*'<pre>';
print_r($_SESSION['id']);
die();*/
session_start();

include "conectar.php";

$con = new Conectar();


$url = "/tcc/cadastrar-queixa.php";

$queixa=utf8_decode($_POST['mensagem']);
$rua = utf8_decode($_POST['rua']);
$num = utf8_decode($_POST['num']);
$bairro = utf8_decode($_POST['bairro']);
$cidade = utf8_decode($_POST['cidade']);
$cep = utf8_decode($_POST['cep']);
$uf = utf8_decode($_POST['uf']);
$categoria = utf8_decode($_POST['categoria']);
$lat= utf8_decode($_POST['latitude']);
$log= utf8_decode($_POST['longitude']);
$id_usuario=utf8_decode($_SESSION['id']);
$status=utf8_decode("analise");



$insert = $con->prepare('INSERT INTO queixas (id_queixas,txt_queixas,txt_rua, txt_numero,txt_bairro, txt_cidade, txt_cep, txt_uf, txt_categoria,latitude, longitude, dateTime, id_usuario, status ) VALUES (null, :txt_queixas,:txt_rua, :txt_numero, :txt_bairro, :txt_cidade, :txt_cep, :txt_uf, :txt_categoria, :latitude, :longitude, now(),:id_user, :status )');

$insert->bindValue(":txt_queixas", $queixa);
$insert->bindValue(":txt_rua", $rua);
$insert->bindValue(":txt_numero", $num);
$insert->bindValue(":txt_bairro", $bairro);
$insert->bindValue(":txt_cidade", $cidade);
$insert->bindValue(":txt_cep", $cep);
$insert->bindValue(":txt_uf", $uf);
$insert->bindValue(":txt_categoria", $categoria);
$insert->bindValue(":latitude", $lat);
$insert->bindValue(":longitude", $log);
$insert->bindValue(":id_user",$id_usuario);
$insert->bindValue(":status",$status);

$tfbool =$insert->execute();

$idQueixa = $con->lastInsertId();

foreach($_POST['images'] as $key => $imagem){ // $key e $imagem pode ser qualquer nome, quando faz isso num foreach com um vetor, nesse lugar onde ta $key fica salvo a "chave" (index) do vetor, e na variaveel depos da seta (=>) salvo o valor daquela posição

	if(!empty($imagem)){

	    $sttm = $con->prepare('insert into fotos(id_queixas, name_foto) values (:idQueixa, :foto)');
	    $sttm->bindValue(':idQueixa', $idQueixa);
	    $sttm->bindValue(':foto', $imagem);
	    $sttm->execute();	
	}

}

if($tfbool == 1){
  header("Location:".$url."?msg=sucesso");
} else{
 header("Location:".$url."?msg=error");
}
?>