<?php
$targetFolder = './uploads/';


usleep(500000); // delay de 0.5seg, 'workaround' pq se selecionar mais de uma imagem tava fazendo upload muito rapido e ficando com o mesmo nome

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	//$targetFile = $targetFolder.$_FILES['Filedata']['name'];

	$fileTypes = array('jpg','jpeg','gif','png');
	$extensao = explode(".",$_FILES['Filedata']['name']);
	$extensao = end($extensao);
	$filename = time().rand(10000,99999).".".$extensao;
	$targetFile = $targetFolder.$filename;
	
	if (in_array($extensao,$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $filename;
	} else {
		echo '-1';
	}
}
?>