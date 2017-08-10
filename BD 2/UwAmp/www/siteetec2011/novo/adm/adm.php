<?php

require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="ETEC Itu, Informatica, Informatica para Internet, WEB, Administracao, Meio Ambiente, Paisagismo, Hospedagem, Agenciamento de Viagem, Turismo, Escola Tecnica, Logistica, Integrado, Ensino Medio, Itu, Sao Paulo, Brasil, gratuito" />
<meta name="description" content="Site da ETEC Itu - cursos tecnicos gratuitos" />

<title>ETEC Itu - Martinho Di Ciero</title>

<link href="../css/index.css" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="../imagem/etec.ico" />

</head>

<body>
  <div class="main">
	<div class="content">
   		<div class="panel"><img src="../imagem/topo.png" alt="Topo" /></div>
      <!--Início do Menu Horizontal-->
            <div class="menu_horizontal">
                <?php //require_once "menuTeste.php"; ?>
            </div>
      <!--Fim do Menu Horizontal-->
      <div class="sidebar">
		<?php
			require_once '../class/Menu.php';
			@$menu = new Menu();
			@$menu->consultarAdm();
		?>
	
		</div>
      <!--<div>teste</div>!-->
      <div class="meio">
	  
	   <?php
			@$p = $_GET['p'];		
			if($p == "" || $p == "index" || $p == "index.php"){
				@require_once 'home.php';
			}else{
				@require_once $p;
			}
		?>
 			
    </div>
      <div class="propaganda">
          <?php
                require_once '../class/Banner.php';
                @$b = new Banner();
                @$b->carregarBanner("adm");
            ?>       
      </div>

    <div class="footer">
    <table width="750" align="center">
    	
    	<tr>
            <td colspan="2"><div align="center"><h3>Avenida Barata Ribeiro, 410 Vila Prudente de Moraes - Itu/SP</h3></div></td>
            <td class="alinhamento"> </td>
        </tr>
        <tr>
            <td>11 | 4024.1009 | 4025.3720 |Email: eteitu@uol.com.br</td>
            <td><div align="right">Copyright &copy; ETEC Itu | <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | </div></td>
            <td>&nbsp;<br /><br /><br /></td>   
        </tr>
    </table>
    </div>
  </div>
  
</body>
</html>

<?php

}
?>