<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="ETEC Itu, Informatica, Informatica para Internet, WEB, Administracao, Meio Ambiente, Paisagismo, Hospedagem, Agenciamento de Viagem, Turismo, Escola Tecnica, Logistica, Integrado, Ensino Medio, Itu, Sao Paulo, Brasil, gratuito" />
<meta name="description" content="Site da ETEC Itu - cursos tecnicos gratuitos" />

<title>ETEC Itu - Martinho Di Ciero</title>

<link href="css/index.css" rel="stylesheet" type="text/css" />
<link href="menu_assets/styles.css" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="imagem/etec.ico" />

</head>

<body>
    <div class="panel"><img src="imagem/topo2.png" alt="Topo" /></div>
  <div class="main">
      
	<div class="content">
   		
      <!--Início do Menu Horizontal-->
            <div id='cssmenu'>
                <ul>
                    <li class='active'><a href='?p=home.php'><span>Home</span></a></li>
                    <li><a href='?p=curso.php'><span>Cursos</span></a></li>
                    <li><a href='?p=localizacao.php'><span>Localiza&ccedil;&atilde;o</span></a></li>
                    <li><a href='?p=noticia.php'><span>Not&iacute;cias</span></a></li>
                    <li><a href='?p=conta.php'><span>Presta&ccedil;&atilde;o de Contas</span></a></li>
                    <li class='last'><a href='?p=contato.php'><span>Fale Conosco</span></a></li>
                </ul>
            </div>
      <!--Fim do Menu Horizontal-->
      
      <div class="sidebar">
          <a href='?p=nota.php'>
              <img src="imagem/aluno.png" alt="Notas" border="0" />
          </a>
          <a href='arquivo/ppg.pdf' title='PPG - Plano Escolar' target='_blank'>
              <img src="imagem/ppg.png" alt="PPG" border="0" />
          </a>
          <a href="http://centropaulasouza.sp.gov.br" target="_blank">
            <img src="imagem/cps.png" alt="CEETEPS" border="0" />
          </a>
          <a href="http://cpscetec.com.br" target="_blank">
            <img src="imagem/ceteccap.png" alt="CEETEPS" border="0" />
          </a>
          <a href="https://recadastramentoanual.gestaopublica.sp.gov.br/recadastramentoanual/noauth/LoginPrepare.do" target="_blank">
            <img src="imagem/recadastramento.png" alt="Recadastramento" border="0" />
          </a>
          <a href="http://www.e-folha.sp.gov.br/" target="_blank">
            <img src="imagem/prodesp.png" alt="Prodesp" border="0" />
          </a>
          <a href="http://www.clickideia.com.br/" target="_blank">
            <img src="imagem/clickidea.png" alt="ClickIdeia" border="0" />
          </a>
      </div>
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
          <br />
          <?php
                require_once 'class/Banner.php';
                @$b = new Banner();
                @$b->carregarBanner("   ");
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

