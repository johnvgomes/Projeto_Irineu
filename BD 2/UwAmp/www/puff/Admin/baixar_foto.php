<?PHP

$ext_validas = "/(gif|bmp|png|jpg|jpeg)/i";
$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
$config = array();
$config["tamanho"] = 1068883;
$config["largura"] = 350;
$config["altura"] = 250;
$config["diretorio"] = "FOTOS/";


function nome($extensao)
{
	global $config;
	
		$temp = substr(md5(uniqid(time())),0,10);
		$imagem_nome = $temp . "." . $extensao;
		
		if (file_exists($config["diretorio"].$imagem_nome))
			{
			$imagem_nome = nome($extensao);
			}

	return $imagem_nome;
}

If ($arquivo)
{
	$erro = array();
	
	//if (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$",$arquivo["type"]))
	if (!preg_match($ext_validas,$arquivo["type"]))

	{
		$erro[] = "Formato de arquivo invalido ".$arquivo["type"]."! Aceitos (JPG, JPEG, BMP, GIF ou PNG)";
	}
	else
	{
		if($arquivo["size"] > $config["tamanho"])
		{
			$erro[] = "Arquivo muito grande ". $arquivo["size"] ." bytes, máximo " . $config["tamanho"] . " bytes";
		}
		
	$tamanhos = getimagesize($arquivo["tmp_name"]);
	
	If ($tamanhos[0] > $config["largura"])
	{
		$erro[] = "Largura ".$tamanhos[0]." pixels, maior que maximo permitido" . $config["largura"] . "pixels";
	}
	If ($tamanhos[1] > $config["altura"])
	{
		$erro[] = "Altura ".$tamanhos[1]."pixels, maior que maximo permitido" . $config["altura"] . "pixels";
	}
		
}
	
	if (!sizeof($erro))
	{
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",$arquivo["name"],$ext);
		
		$imagem_nome = nome($ext[1]);
		$imagem_dir  = $config["diretorio"] . $imagem_nome;
		move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
	}



}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>

<body>

<?PHP 

if  ($arquivo && !sizeof($erro))
	{
		echo "imagem enviada com sucesso";
	}		
	
else
{


?>	


<form action=""<?PHP echo $PHP_SELF ?>"" method="post" enctype="multipart/form-data" name="form1" id="form1">
Envie sua foto no Formatos GIF, JPEG, JPG, BMP ou PNG a imagem não deve ser maior do que <?PHP echo $config["tamanho"] ?> bytes e deve ter <?PHP echo $config["largura"] . " largura X ". $config["altura"] . " altura "  ?> , em pixels. <br />
  <table width="383" border="1" align="center">
 <?php 
 if(sizeof($erro))
 {
 echo "Ocorreram erros...";
 foreach($erro as $err)
 	{
 		echo " - " .$err ."<br>";
 	}
	echo "</br>";
 }
 ?>
    <tr>
      <td><div align="center"><span class="style1">Foto
      </span></div>        <span class="style1"><label>
        <div align="center">
          <input name="foto" type="file" id="foto" />
        </div>
        </label>
      </span></td>
    </tr>
    <tr>
      <td><label>
        <div align="center">
          <input type="submit" name="Submit" value="Enviar" />
        </div>
      </label></td>
    </tr>
  </table>
</form>
<?PHP } ?>
</body>
</html>
